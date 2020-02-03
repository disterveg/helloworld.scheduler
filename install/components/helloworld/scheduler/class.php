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
use Bitrix\Main\SystemException;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\Tools;

class Appointment extends CBitrixComponent
{
    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        if (!isset($arParams["CACHE_TIME"])) {
            $arParams["CACHE_TIME"] = 36000000;
        }

        return $arParams;
    }

    /**
     * Определение нужной страницы для вывода информации
     * @return string
     */
    private function getComponentPage()
    {
        $arDefaultVariableAliases404 = [];
        $arDefaultUrlTemplates404 = [
            "firststep"           => "",
            "secondstep"          => "second-step/",
            "thirdstep"           => "third-step/",
        ];
        $arComponentVariables[] = "second-step";
        $arComponentVariables[] = "third-step";

        $arVariables = [];

        $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates(
            $arDefaultUrlTemplates404,
            $this->arParams["SEF_URL_TEMPLATE"]
        );
        $arVariableAliases = CComponentEngine::makeComponentVariableAliases(
            $arDefaultVariableAliases404,
            $this->arParams["VARIABLE_ALIASES"]
        );

        $engine = new CComponentEngine($this);
        $componentPage = $engine->guessComponentPath(
            $this->arParams["SEF_FOLDER"],
            $arUrlTemplates,
            $arVariables
        );

        if (!$componentPage) {
            $componentPage = "firststep";
        }

        CComponentEngine::initComponentVariables(
            $componentPage,
            $arComponentVariables,
            $arVariableAliases,
            $arVariables
        );

        if (isset($arVariables["second-step"]) && strlen(trim($arVariables["second-step"])) > 0) {
            $componentPage = "secondstep";
        }

        if (isset($arVariables["third-step"]) && strlen(trim($arVariables["third-step"])) > 0) {
            $componentPage = "thirdstep";
        }

        $this->arResult = array_merge(
            $this->arResult,
            [
                "FOLDER"        => $this->arParams["SEF_FOLDER"],
                "URL_TEMPLATES" => $arUrlTemplates,
                "VARIABLES"     => $arVariables,
                "ALIASES"       => $arVariableAliases,
            ]
        );
        
        return $componentPage;
    }

    /**
     * Получаем опции модуля
     */
    private function getInfo()
    {
        $this->arResult['LEFT_COL_INFO'] = htmlspecialchars_decode(Option::get(Tools::getModuleName(), 'info_clients'));
        $this->arResult['RIGHT_COL_INFO'] = htmlspecialchars_decode(Option::get(Tools::getModuleName(), 'other_info'));
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

        if (!Loader::includeModule('helloworld.scheduler')) {
            throw new SystemException(Loc::getMessage('NO_MODULE'));
        }

        $componentPage = $this->getComponentPage();

        try {
            $this->getInfo();
            $this->includeComponentTemplate($componentPage);
        } catch (Exception $ex) {
            throw new SystemException($ex->getMessage(), $ex->getCode(), $ex->getFile(), $ex->getLine(), $ex);
        }
    }
}
