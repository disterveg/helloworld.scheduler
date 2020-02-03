<?php
namespace HelloWorld\Scheduler\MailTemplates;


class DeleteMailTemplate {
    public static function deleteMailTemplate($eventName)
    {
        $em = new \CEventMessage;
        $eventType = new \CEventType;
        $arFilter = Array(
            "EVENT_NAME" => $eventName,
        );
        $rsMess = $em->GetList($by="site_id", $order="desc", $arFilter);
        $templateId = '';
        while($arMess = $rsMess->GetNext())
        {
            $templateId = $arMess['ID'];
        }

        $em->Delete($templateId);
        $eventType->Delete($eventName);
    }
}