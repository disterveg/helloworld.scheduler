<?php

namespace HelloWorld\Scheduler\Events;

use Bitrix\Main\Entity\Event;
use Bitrix\Main\Mail\Event as EmailEvent;
use Bitrix\Main\SiteTable;
use HelloWorld\Scheduler\HelperManager;

class OnAfterAddAppointments
{

    public static function onAfterAdd(Event $event)
    {
        $helper = self::getHelperManager();
        $id = $event->getParameter("id");
        $arFields = $event->getParameter("fields");
        $hlId = $helper->Hlblock()->getHlblockId('Appointments');

        $params = [
            'ELEMENT_ID' => $id,
            'CARD_ID'     => $arFields['UF_CARD_ID'],
            'HLBLOCK_ID' => $hlId,
            'UF_DATE' => $arFields['UF_DATE'],
            'UF_TIME' => $arFields['UF_TIME'],
            'UF_DOC_NAME' => $arFields['UF_DOC_NAME'],
            'UF_DEPARTMENT' => $arFields['UF_DEPARTMENT'],
            'UF_FIO' => $arFields['UF_FIO'],
            'UF_YEAR' => $arFields['UF_YEAR'],
            'UF_EMAIL' => $arFields['UF_EMAIL'],
            'UF_PHONE' => $arFields['UF_PHONE'],
        ];

        //\Bitrix\Main\Diag\Debug::dumpToFile(array('fields'=>$entity),"","logigi.txt");
        //\Bitrix\Main\Diag\Debug::dumpToFile(array('fields'=>$entityDataClass),"","logigi.txt");

        self::sendMessage($params);
    }

    private static function getHelperManager()
    {
        return HelperManager::getInstance();
    }

    private static function sendMessage($params)
    {
        $obSites = SiteTable::getList();
        $siteId = '';
        while ($arSite = $obSites->Fetch()) {
            $siteId = $arSite['LID'];
        }

        EmailEvent::send([
            'EVENT_NAME'    => 'NEW_RECORD_APPOINTMENT_WITH_A_DOCTOR',
            'LID'           => $siteId,
            'C_FIELDS'      => [
                'CARD_ID'    => $params['CARD_ID'],
                'ELEMENT_ID' => $params['ELEMENT_ID'],
                'HLBLOCK_ID' => $params['HLBLOCK_ID'],
                'UF_DATE' => $params['UF_DATE'],
                'UF_TIME' => $params['UF_TIME'],
                'UF_DOC_NAME' => $params['UF_DOC_NAME'],
                'UF_DEPARTMENT' => $params['UF_DEPARTMENT'],
                'UF_FIO' => $params['UF_FIO'],
                'UF_YEAR' => $params['UF_YEAR'],
                'UF_EMAIL' => $params['UF_EMAIL'],
                'UF_PHONE' => $params['UF_PHONE'],
            ],
        ]);
    }
}