<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use HelloWorld\Scheduler\Tools;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

Loader::includeModule("highloadblock");

class AppointmentForm extends CBitrixComponent
{
    /**
     * Подготовка входных данных
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        if (!is_array($arParams["PROPERTY_CODE"])) {
            $arParams["PROPERTY_CODE"] = array();
        }
        foreach ($arParams["PROPERTY_CODE"] as $key =>$val) {
            if ($val === "") {
                unset($arParams["PROPERTY_CODE"][$key]);
            }
        }

        if (!is_array($arParams["PROPERTY_CODES_REQUIRED"])) {
            $arParams["PROPERTY_CODES_REQUIRED"] = array();
        }
        foreach ($arParams["PROPERTY_CODES_REQUIRED"] as $key => $val) {
            if ($val === "") {
                unset($arParams["PROPERTY_CODES_REQUIRED"][$key]);
            }
        }

        if(!isset($arParams['IS_MASKED_INPUT']) || $arParams['IS_MASKED_INPUT'] == 'Y')
        {
            Asset::getInstance()->addJs($this->__path.'/lib/js/jquery.maskedinput.min.js');
        }

        if(!isset($arParams['IS_VALIDATER']) || $arParams['IS_VALIDATER'] == 'Y')
        {
            Asset::getInstance()->addJs($this->__path.'/lib/js/jquery.validate.min.js');
        }

        if(Option::get(Tools::getModuleName(), 'enable_recaptcha') == 'Y')
        {
            Asset::getInstance()->addString(
                '<script src="https://www.google.com/recaptcha/api.js?render='
                . Option::get(Tools::getModuleName(), 'site_key') . '">
                </script>'
            );
        }
        return $arParams;
    }

    /**
     * Получаем поля с типом список
     * @return array
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function getEnumeration()
    {
        $this->arResult["PROPERTY_LIST"] = Tools::getHlUserFields();
        $propEnumId = [];
        foreach ($this->arResult["PROPERTY_LIST"] as $userField) {
            if($userField['USER_TYPE_ID'] == 'enumeration') {
                $propEnumId[] = $userField['ID'];
            }
        }
        return $propEnumId;
    }

    /**
     * Получаем значения полей типа список
     * @param array $propEnumId
     */
    private function getValuesEnumProp(array $propEnumId)
    {
        $obEnum = new CUserFieldEnum;
        $rsEnum = $obEnum->GetList(array(), array("USER_FIELD_ID" => $propEnumId));
        $propEnum = [];
        while($arEnum = $rsEnum->GetNext())
        {
            $propEnum[$arEnum['USER_FIELD_ID']][$arEnum['ID']] = $arEnum['VALUE'];
        }
        foreach ($this->arResult["PROPERTY_LIST"] as $key => $prop) {
            $this->arResult["PROPERTY_LIST"][$key]['ENUM_VALUES'] = $propEnum[$prop['ID']];
        }
    }

    /**
     * Отключаем елемент
     * @param $cardId
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function disabledItem($cardId)
    {
        $helper = $this->getHelper();
        $entityDataClassDep = $helper->getDataManager('Cards');

        $result = $entityDataClassDep::update(
            $cardId,
            [
                'UF_BOOKED' => '1',
                'UF_DATE_BOOKED' => date('d.m.Y H:i:s')
            ]
        );

        if (!$result->isSuccess()) {
            echo implode(', ', $result->getErrors()) . "<br />";
        }
    }

    /**
     * Проверяем запись
     * @param $cardId
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function checkAppointment($cardId)
    {
        $helper = $this->getHelper();
        $dataManager = $helper->getDataManager('Appointments');
        $res = $dataManager::getRow(['filter' => ['UF_CARD_ID' => $cardId]]);

        if(!empty($res)){
            LocalRedirect("/scheduler/?second-step=Y");
        }
    }

    /**
     * Путь до корневого каталога компонента
     */
    private function getComponentDir()
    {
        if (is_dir(rtrim($_SERVER['DOCUMENT_ROOT'],
                DIRECTORY_SEPARATOR) . '/local/components/helloworld/scheduler.form')
        ) {
            $this->arParams["COMPONENT_ROOT"] = '/local/components/helloworld/scheduler.form';
        } else {
            $this->arParams["COMPONENT_ROOT"] = '/bitrix/components/helloworld/scheduler.form';
        }
    }

    /**
     * @return HlblockHelper
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function getHelper()
    {
        return new HlblockHelper();
    }

    /**
     * Функция реализует весь жизненный цикл компонента
     * @throws Exception
     */
    public function executeComponent()
    {
        if (!Loader::includeModule('highloadblock')) {
            return;
        }

        if(!Loader::includeModule("helloworld.scheduler")) {
            return;
        }

        if($this->arParams['CARD_ID']){
            $this->disabledItem($this->arParams['CARD_ID']);
            $this->checkAppointment($this->arParams['CARD_ID']);
            $propsId = $this->getEnumeration();
            $this->getValuesEnumProp($propsId);
            $this->getComponentDir();
            $this->includeComponentTemplate();
        } else {
            LocalRedirect("/scheduler/?second-step=Y");
        }
    }
}
