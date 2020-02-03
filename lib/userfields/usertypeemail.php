<?php
namespace HelloWorld\Scheduler\UserFields;

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class UserTypeEmail extends \CUserTypeString
{
    public function getUserTypeDescription()
    {
        return [
            "USER_TYPE_ID" => "email",
            "CLASS_NAME" => __CLASS__,
            "DESCRIPTION" => Loc::GetMessage('USER_TYPE_EMAIL'),
            "BASE_TYPE" => \CUserTypeManager::BASE_TYPE_STRING
        ];
    }

    public function CheckFields($arUserField, $value)
    {
        $aMsg = \CUserTypeString::CheckFields($arUserField, $value);

        if ($arUserField['MANDATORY'] === 'Y' && !strlen($value)) {
            $aMsg[] = [
                "id"   => $arUserField["FIELD_NAME"],
                "text" => Loc::GetMessage("USER_TYPE_EMAIL_MANDATORY_ERROR",
                    [
                        "#FIELD_NAME#" => $arUserField["EDIT_FORM_LABEL"],
                    ]
                ),
            ];
        }

        $arEmails = explode(',', $value);
        foreach ($arEmails as $email) {
            $email = trim($email);
            if (function_exists('idn_to_ascii') && strpos($email, '@') !== false) {
                $parts = explode('@', $email);
                $email = reset($parts) . '@' . idn_to_ascii(next($parts));
            }

            if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                $aMsg[] = [
                    "id"   => $arUserField["FIELD_NAME"],
                    "text" => Loc::GetMessage("USER_TYPE_EMAIL_MATCH_ERROR",
                        [
                            "#FIELD_NAME#" => $arUserField["EDIT_FORM_LABEL"],
                        ]
                    ),
                ];
                break;
            }
        }

        return $aMsg;
    }
}