<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;

if(!Loader::includeModule("helloworld.scheduler")) {
    return;
}

$arComponentParameters = array(
    "GROUPS" => array(
        "SIGN" => array(
            "SORT" => 110,
            "NAME" => Loc::getMessage("SIGN"),
        ),
        "PLUGINS" => array(
            "SORT" => 120,
            "NAME" => Loc::getMessage("PLUGINS"),
        ),
    ),
    "PARAMETERS" => array(
        "DATE_REG" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("DATE_REG"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "TIME_REG" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("TIME_REG"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "DOCTOR" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("DOCTOR"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "DOC_ID" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("DOC_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "CARD_ID" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("CARD_ID"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "DEPARTMENT" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("DEPARTMENT"),
            "TYPE" => "STRING",
            "DEFAULT" => '',
        ),
        "PROPERTY_CODES" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PROPERTY_CODES"),
            "TYPE" => "LIST",
            "VALUES" => $arProp,
            "DEFAULT" => '',
            "MULTIPLE" => "Y",
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PROPERTY_CODES_REQUIRED"),
            "TYPE" => "LIST",
            "VALUES" => $arProp,
            "DEFAULT" => '',
            "MULTIPLE" => "Y",
            "ADDITIONAL_VALUES" => "Y",
            "REFRESH" => "Y",
        ),
        "LINK_PRIVACY" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("LINK_PRIVACY"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("LINK_PRIVACY_DEFAULT"),
        ),
        "MESSAGE_SUCCESS" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("MESSAGE_SUCCESS"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("MESSAGE_SUCCESS_DEFAULT"),
        ),
        "SEF_URL_TEMPLATE" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("SEF_URL_TEMPLATES"),
            "TYPE" => "STRING",
            "DEFAULT" => "/scheduler/",
        ),
        "IS_MASKED_INPUT" => array(
            "PARENT" => "PLUGINS",
            "NAME" => Loc::getMessage("IS_MASKED_INPUT"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "IS_VALIDATER" => array(
            "PARENT" => "PLUGINS",
            "NAME" => Loc::getMessage("IS_VALIDATER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
    ),
);
