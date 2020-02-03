<?php
namespace HelloWorld\Scheduler\MailTemplates;

use Bitrix\Main\SiteTable;

class UpdateRecordAppointmentWithADoctor {
    public static function createMailTemplate()
    {
        $obSites = SiteTable::getList();
        $siteId = [];
        while ($arSite = $obSites->Fetch()) {
            $siteId[] = $arSite['LID'];
        }

        $eventType = new \CEventType;
        $em = new \CEventMessage;
        $eventName = 'Обновлена запись на прием';
        $eName = 'UPDATE_RECORD_APPOINTMENT_WITH_A_DOCTOR';

        $message = [
            'ACTIVE' => 'Y',
            'EVENT_NAME' => $eName,
            'MESSAGE' => self::getMessageTemplate(),
            'EMAIL_FROM'  => "#DEFAULT_EMAIL_FROM#",
            'EMAIL_TO'    => "#EMAIL_TO#",
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
                <p>Ваша запись на сайте #SITE_NAME# №#ELEMENT_ID# подтверждена.</p>
                <br>
                <p>Информация о записи:</p>
                <p>Номер талона: #CARD_ID#</p>
                <p>Дата приема: #UF_DATE#</p>
                <p>Время приема: #UF_TIME#</p>
                <p>Врач: #UF_DOC_NAME#</p>
                <p>Вид приема: #UF_DEPARTMENT#</p>
                <br>
                <p>Ваши данные:</p>
                <p>ФИО: #UF_FIO#</p>
                <p>Год рождения: #UF_YEAR#</p>
                <p>E-mail: #UF_EMAIL#</p>
                <p>Номер телефона: #UF_PHONE#</p>
                <br>
                <p>Сообщение сгенерировано автоматически.</p>
            ";

        return $message;
    }

    protected static function getDescription()
    {
        return "
        #EMAIL_TO# - Электронный почтовый адрес клиента
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