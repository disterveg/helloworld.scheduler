<?php

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;
use HelloWorld\Scheduler\HlBlocks;
use HelloWorld\Scheduler\Demo;
use HelloWorld\Scheduler\Helpers\HlblockHelper;
use HelloWorld\Scheduler\MailTemplates;

Loc::loadMessages(__FILE__);

Class helloworld_scheduler extends CModule
{
    var $MODULE_ID;
    var $MODULE_NAME;
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_DESCRIPTION;
    var $PARTNER_NAME;
    var $PARTNER_URI;
    var $SOLUTION_NAME;
    var $MODULE_PATH;
    var $SHOW_SUPER_ADMIN_GROUP_RIGHTS;
    var $MODULE_GROUP_RIGHTS;

    public function __construct()
    {
        $this->MODULE_ID = 'helloworld.scheduler';
        $this->setVersionData();

        $this->MODULE_NAME = Loc::GetMessage("HELLOWORLD_SCHEDULER_MODULE_NAME");
        $this->MODULE_DESCRIPTION = Loc::GetMessage("HELLOWORLD_SCHEDULER_MODULE_DESCRIPTION");

        $this->PARTNER_NAME = Loc::GetMessage("HELLOWORLD_SCHEDULER_PARTNER_NAME");
        $this->PARTNER_URI = Loc::GetMessage("HELLOWORLD_SCHEDULER_PARTNER_URI");

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/install/index.php"));
        $this->MODULE_PATH = $path;

        $this->SHOW_SUPER_ADMIN_GROUP_RIGHTS = 'Y';
        $this->MODULE_GROUP_RIGHTS = 'Y';
    }

    private function setVersionData()
    {
        $arModuleVersion = [];
        include(__DIR__ . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
    }

    public function installEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandler(
            "",
            "AppointmentsOnAfterAdd",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\Events\OnAfterAddAppointments::class,
            "onAfterAdd"
        );
        $eventManager->registerEventHandler(
            "",
            "AppointmentsOnAfterUpdate",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\Events\onAfterUpdateAppointments::class,
            "onAfterUpdate"
        );
        $eventManager->registerEventHandler(
            "main",
            "OnUserTypeBuildList",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\UserFields\UserTypeEmail::class,
            'getUserTypeDescription'
        );
    }

    public function installHlBlocks()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $hlIdDepartments = HlBlocks\DepartmentsTable::createHlDepartments();
            $hlIdDoctors = HlBlocks\DoctorsTable::createHlDoctors($hlIdDepartments);
            $hlIdCards = HlBlocks\CardsTable::createHlCards($hlIdDepartments, $hlIdDoctors);
            HlBlocks\AppointmentsTable::createHlAppointments($hlIdCards);
        }
    }

    public function installDemo()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            Demo\DepartmentsData::setDepartments();
            Demo\DoctorsData::setDoctors();
            Demo\CardData::setCards();
        }
    }

    public function installFiles()
    {
        CopyDirFiles($this->MODULE_PATH . "/install/site/", $_SERVER["DOCUMENT_ROOT"], true, true);
    }

    public function installComponents()
    {
        CopyDirFiles($this->MODULE_PATH . "/install/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
    }

    public function createMailTemplates()
    {
        MailTemplates\NewRecordAppointmentWithADoctor::createMailTemplate();
        MailTemplates\UpdateRecordAppointmentWithADoctor::createMailTemplate();
    }

    public function installGadgets()
    {
        CopyDirFiles(__DIR__ . "/gadgets", $_SERVER["DOCUMENT_ROOT"] . "/bitrix/gadgets", true, true);

        $arUserOptions = CUserOptions::GetOption("intranet", "~gadgets_admin_index", false, false);
        $addGadget = [
            'SCHEDULER@111111111' =>
                [
                    'COLUMN' => 0,
                    'ROW' => 0,
                    'HIDE' => 'N',
                    'SETTINGS' => [
                        'TITLE_STD' => Loc::GetMessage("HELLOWORLD_SCHEDULER_TITLE_GD"),
                        'SORT_BY' => 'ID',
                        'SORT_ORDER' => 'DESC',
                        'ADDITIONAL_FIELDS' => ['UF_FIO', 'UF_PHONE', 'UF_DEPARTMENT', 'UF_DOC_NAME', 'UF_TIME', 'UF_DATE' ],
                        'ITEMS_COUNT' => 3
                    ]
                ]
        ];

        $UserOptions = array_merge(reset($arUserOptions)['GADGETS'], $addGadget);
        $arUserOptions[0]['GADGETS'] = $UserOptions;
        CUserOptions::SetOption("intranet", "~gadgets_admin_index", $arUserOptions, false, false);
    }

    public function InstallDB()
    {
        CAgent::AddAgent(
            "HelloWorld\Scheduler\Agent\CardsBooking::CheckBookingCards();",
            $this->MODULE_ID,
            "N",
            300,
            "",
            "Y"
        );
        return true;
    }

    public function UnInstallDB()
    {
        CAgent::RemoveAgent('HelloWorld\Scheduler\Agent\CardsBooking::CheckBookingCards();', $this->MODULE_ID);
    }

    public function uninstallHlBlocks()
    {
        if (Loader::includeModule($this->MODULE_ID))
        {
            $helper = new HlblockHelper();

            $hlIdDepartments = $helper->getHlblockId('Departments');
            $hlIdDoctors = $helper->getHlblockId('Doctors');
            $hlIdCards = $helper->getHlblockId('Cards');
            $hlIdAppointments = $helper->getHlblockId('Appointments');

            $helper->deleteHlblock($hlIdDepartments);
            $helper->deleteHlblock($hlIdDoctors);
            $helper->deleteHlblock($hlIdCards);
            $helper->deleteHlblock($hlIdAppointments);
        }
    }

    public function uninstallFiles()
    {
        DeleteDirFilesEx("/scheduler/");
    }

    public function uninstallComponents()
    {
        DeleteDirFilesEx("/bitrix/components/" . $this->PARTNER_NAME);
    }

    public function uninstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler(
            "",
            "AppointmentsOnAfterAdd",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\Events\OnAfterAddAppointments::class,
            "onAfterAdd"
        );
        $eventManager->unRegisterEventHandler(
            "",
            "AppointmentsOnAfterUpdate",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\Events\onAfterUpdateAppointments::class,
            "onAfterUpdate"
        );
        $eventManager->unRegisterEventHandler(
            "main",
            "OnUserTypeBuildList",
            $this->MODULE_ID,
            \HelloWorld\Scheduler\UserFields\UserTypeEmail::class,
            'getUserTypeDescription'
        );
    }

    public function deleteMailTemplates()
    {
        MailTemplates\DeleteMailTemplate::deleteMailTemplate('NEW_RECORD_APPOINTMENT_WITH_A_DOCTOR');
        MailTemplates\DeleteMailTemplate::deleteMailTemplate('UPDATE_RECORD_APPOINTMENT_WITH_A_DOCTOR');
    }

    public function uninstallGadgets()
    {
        DeleteDirFilesEx("/bitrix/gadgets/" . $this->PARTNER_NAME);
    }

    public function DoInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        $this->installEvents();
        $this->installHlBlocks();
        $this->installDemo();
        $this->installFiles();
        $this->installComponents();
        $this->createMailTemplates();
        $this->installGadgets();
        $this->InstallDB();

        global $APPLICATION;
        $APPLICATION->includeAdminFile(
            Loc::getMessage('HELLOWORLD_SCHEDULER_SUCCESS_DESCRIPTION'),
            __DIR__.'/info_install_success.php'
        );

        return true;
    }

    public function DoUninstall()
    {
        $this->uninstallHlBlocks();
        $this->uninstallFiles();
        $this->uninstallComponents();
        $this->uninstallEvents();
        $this->deleteMailTemplates();
        $this->uninstallGadgets();
        $this->UnInstallDB();

        UnRegisterModule($this->MODULE_ID);
    }
}
