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
use Bitrix\Main\SystemException;
use Bitrix\Main\Page\Asset;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

//CJSCore::Init(array("jquery"));

Loader::includeModule("highloadblock");

/**
 * Class AppointmentList
 */
class AppointmentList extends CBitrixComponent
{
    private $errorMsg;

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        if (!isset($arParams["PERIOD_END"])) {
            $arParams["PERIOD_END"] = 10;
        }

        if(!isset($arParams['IS_FLEXSLIDER']) || $arParams['IS_FLEXSLIDER'] == 'Y')
        {
            Asset::getInstance()->addCss($this->__path.'/lib/css/flexslider.css');
            Asset::getInstance()->addJs($this->__path.'/lib/js/jquery.flexslider-min.js');
        }

        return $arParams;
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
     * Получаем отделения
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function getDepartments()
    {
        $helper = $this->getHelper();
        $result = $helper->getElements(
            'Departments',
            ['select' => [
                'ID',
                'UF_NAME'
            ],
            'order' => [
                'UF_SORT' => 'ASC'
            ]]
        );
        while ($arRow = $result->Fetch()) {
            $this->arResult["DEPARTMENTS"][] = $arRow;
        }

        if (empty($this->arResult["DEPARTMENTS"])) {
            $this->errorMsg = 'highload-блок «‎Отделения» пустой';
        }
    }

    /**
     * Получаем период для построения таблицы талонов к врачам
     * @throws Exception
     */
    private function getPeriodTime()
    {
        $end = new DateTime();
        $end->modify('+' . $this->arParams["PERIOD_END"] . ' day');

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod(new DateTime(), $interval, $end);
        foreach ($dateRange as $date) {
            $this->arResult['PERIOD_TIME'][] = $date->format("d.m.Y");
        }
    }

    /**
     * Получаем талоны со связкой
     * @param string $departId
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function getListCards($departId)
    {
        $helper = $this->getHelper();
        $result = $helper->getElements(
            'Cards',
            array(
                'select' => [
                    'ID',
                    'UF_DOCTOR',
                    'NAME' => 'DOCTOR.UF_NAME',
                    'PHOTO' => 'DOCTOR.UF_IMG',
                    'POST' => 'DOCTOR.UF_POST',
                    'QUALIFICATION' => 'DOCTOR.UF_QUALIFICATION',
                    'DEPARTMENT_NAME' => 'DEPARTMENT.UF_NAME',
                    'UF_DATE_TIME',
                ],
                'order' => [
                    'UF_DATE_TIME' => 'ASC'
                ],
                'filter' => [
                    'UF_DEPARTMENT' => $departId,
                    'UF_RECORD' => '0',
                    'UF_BOOKED' => '0'
                ],
                'runtime' => [
                    'DEPARTMENT' => [
                        'data_type' => $helper->getDataManager('Departments'),
                        'reference' => [
                            '=this.UF_DEPARTMENT' => 'ref.ID'
                        ],
                        'join_type' => 'inner'
                    ],
                    'DOCTOR' => [
                        'data_type' => $helper->getDataManager('Doctors'),
                        'reference' => [
                            '=this.UF_DOCTOR' => 'ref.ID'
                        ],
                        'join_type' => 'inner'
                    ],
                    'APPOINTMENT' => [
                        'data_type' => $helper->getDataManager('Appointments'),
                        'reference' => [
                            '=this.ID' => 'ref.UF_CARD_ID'
                        ],
                        'join_type' => 'left'
                    ],
                ],
            )
        );
        while ($arRow = $result->Fetch()) {
            $arRow['UF_DATE'] = $arRow['UF_DATE_TIME']->format('d.m.Y');
            $arRow['UF_TIME'] = $arRow['UF_DATE_TIME']->format('H:i:s');
            $this->arResult['DATA'][$arRow['UF_DOCTOR']][$arRow['UF_DATE']][] = $arRow;
            $this->arResult['DOCTORS'][$arRow['UF_DOCTOR']] = $arRow['NAME'];
            $this->arResult['DOCTOR_NAME'] = $arRow['UF_DOCTOR'];
        }
    }

    /**
     * Получаем время приема к врачу со связкой
     * @param string $date
     * @param string $docId
     * @param string $depId
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private function getTimesVisit($date, $docId, $depId)
    {
        $helper = $this->getHelper();
        $result = $helper->getElements(
            'Cards',
            array(
                'select' => [
                    'ID',
                    'UF_DOCTOR',
                    'UF_DATE_TIME',
                    'DOCTOR_NAME' => 'DOCTOR.UF_NAME',
                    'DOCTOR_PHOTO' => 'DOCTOR.UF_IMG',
                    'NAME_DEPARTMENT' => 'DEPARTMENT.UF_NAME',
                ],
                'order' => [
                    'UF_DATE_TIME' => 'ASC'
                ],
                'filter' => [
                    'UF_DOCTOR' => $docId,
                    'UF_DEPARTMENT' => $depId,
                    '>UF_DATE_TIME' => new \Bitrix\Main\Type\DateTime($date .
                        (new DateTime('today'))->modify('+ 1 minutes')->format('H:i:s')),
                    '<UF_DATE_TIME' => new \Bitrix\Main\Type\DateTime($date .
                        (new DateTime('midnight'))->modify('- 1 minutes')->format('H:i:s')),
                    'UF_RECORD' => '0',
                    'UF_BOOKED' => '0'
                ],
                'runtime' => [
                    'DOCTOR' => [
                        'data_type' => $helper->getDataManager('Doctors'),
                        'reference' => [
                            '=this.UF_DOCTOR' => 'ref.ID'
                        ],
                        'join_type' => 'inner'
                    ],
                    'APPOINTMENT' => [
                        'data_type' => $helper->getDataManager('Appointments'),
                        'reference' => [
                            '=this.ID' => 'ref.UF_CARD_ID'
                        ],
                        'join_type' => 'left'
                    ],
                    'DEPARTMENT' => [
                        'data_type' => $helper->getDataManager('Departments'),
                        'reference' => [
                            '=this.UF_DEPARTMENT' => 'ref.ID'
                        ],
                        'join_type' => 'inner'
                    ],
                ],
            )
        );
        while ($arRow = $result->Fetch()) {
            $this->arResult['TIMES_VISIT'][] = $arRow;
            $this->arResult['DOCTOR_NAME'] = $arRow['DOCTOR_NAME'];
            $this->arResult['DOCTOR_PHOTO'] = $arRow['DOCTOR_PHOTO'];
            $this->arResult['NAME_DEPARTMENT'] = $arRow['NAME_DEPARTMENT'];
        }
        if(empty($this->arResult['TIMES_VISIT'])) {
            $this->errorMsg = 'highload-блок «‎Отделения» пустой';
        }
    }

    /**
     * Путь до корневого каталога компонента
     */
    private function getComponentDir()
    {
        if (is_dir(rtrim($_SERVER['DOCUMENT_ROOT'],
                DIRECTORY_SEPARATOR) . '/local/components/helloworld/scheduler.list')
        ) {
            $this->arParams["COMPONENT_ROOT"] = '/local/components/helloworld/scheduler.list';
        } else {
            $this->arParams["COMPONENT_ROOT"] = '/bitrix/components/helloworld/scheduler.list';
        }
    }

    /**
     * Функция реализует весь жизненный цикл компонента
     * @throws Exception
     */
    public function executeComponent()
    {
        if (!Bitrix\Main\Loader::includeModule('iblock')) {
            return;
        }

        if(!Loader::includeModule("helloworld.scheduler")) {
            return;
        }

        try {
            $this->getComponentDir();
            if ($this->arParams["LIST"] == 'Y') {
                $this->getListCards($this->arParams["DEPARTMENT_ID"]);
                $this->getPeriodTime();
                $this->includeComponentTemplate('list');
            } elseif ($this->arParams["TIMES"] == 'Y') {
                $this->getTimesVisit(
                    $this->arParams["DATE"],
                    $this->arParams["DOCTOR_ID"],
                    $this->arParams["DEPARTMENT_ID"]
                );
                $this->includeComponentTemplate('times');
            } else {
                $this->getDepartments();
                $this->includeComponentTemplate();
            }

            throw new SystemException($this->errorMsg);

        } catch (SystemException $exception) {
            echo '<span class="error_text">' . $exception->getMessage() . '</span>';
        }
    }
}
