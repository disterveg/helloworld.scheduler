<?php
namespace HelloWorld\Scheduler\MailTemplates;

use Bitrix\Main\SiteTable;

class NewRecordAppointmentWithADoctor {
    public static function createMailTemplate()
    {
        $obSites = SiteTable::getList();
        $siteId = [];
        while ($arSite = $obSites->Fetch()) {
            $siteId[] = $arSite['LID'];
        }

        $eventType = new \CEventType;
        $em = new \CEventMessage;
        $eventName = 'Новая запись на прием';
        $eName = 'NEW_RECORD_APPOINTMENT_WITH_A_DOCTOR';

        $message = [
            'ACTIVE' => 'Y',
            'EVENT_NAME' => $eName,
            'MESSAGE' => self::getMessageTemplate(),
            'EMAIL_FROM'  => "#DEFAULT_EMAIL_FROM#",
            'EMAIL_TO'    => "#DEFAULT_EMAIL_FROM#",
            'SUBJECT' => '#SITE_NAME#: Новая запись на прием №#ELEMENT_ID#',
            'BODY_TYPE'   => "html",
            'LID' => $siteId,
            //'SITE_TEMPLATE_ID' => 'mail',
        ];

        $eventType->Add([
            "LID"         => SITE_ID,
            "EVENT_NAME"  => $eName,
            "NAME"        => $eventName,
            "DESCRIPTION" => self::getDescription(),
        ]);

        $em->Add($message);
    }

    protected static function getMessageTemplate()
    {
        $message = "
                <p>Здравствуйте!</p>
                <br>
                <p>На сайте #SITE_NAME# создана новая запись на прием №#ELEMENT_ID#</p>
                <br>
                <p>Информация о записи:</p>
                <p>Номер талона: #CARD_ID#</p>
                <p>Дата приема: #UF_DATE#</p>
                <p>Время приема: #UF_TIME#</p>
                <p>Врач: #UF_DOC_NAME#</p>
                <p>Вид приема: #UF_DEPARTMENT#</p>
                <br>
                <p>Информация о клиенте:</p>
                <p>ФИО: #UF_FIO#</p>
                <p>Год рождения: #UF_YEAR#</p>
                <p>E-mail: #UF_EMAIL#</p>
                <p>Номер телефона: #UF_PHONE#</p>
                <br>
                <p>Подробную информацию вы можете узнать по адресу: <a href='http://#SERVER_NAME#/bitrix/admin/highloadblock_row_edit.php?ENTITY_ID=#HLBLOCK_ID#&ID=#ELEMENT_ID#'>http://#SERVER_NAME#/bitrix/admin/highloadblock_row_edit.php?ENTITY_ID=#HLBLOCK_ID#&ID=#ELEMENT_ID#</a>.</p>
                <p>Сообщение сгенерировано автоматически.</p>
            ";

        return $message;
    }

    protected static function getDescription()
    {
        return "
        #ELEMENT_ID# - Номер записи на прием
        #CARD_ID# - Номер талона
        #HLBLOCK_ID# - ID highload-блока
        #UF_DATE# - Дата приема
        #UF_TIME# - Время приема
        #UF_DOC_NAME# - Врач
        #UF_DEPARTMENT# - Вид приема
        #UF_FIO# - ФИО
        #UF_YEAR# - Год рождения
        #UF_EMAIL# - E-mail
        #UF_PHONE# - Номер телефона";
    }
}