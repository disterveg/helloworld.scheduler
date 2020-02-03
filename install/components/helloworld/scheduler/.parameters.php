<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

/** @var array $arCurrentValues */

if (!\Bitrix\Main\Loader::includeModule('highloadblock')) {
    return;
}

if(!Loader::includeModule("helloworld.scheduler")) {
    return;
}

$helper = new HlblockHelper();

$arProp = [];
$dbRes = CUserTypeEntity::GetList(
    ['SORT' => 'ASC'],
    ['ENTITY_ID' => $helper->getEntityId('Appointments'), 'LANG' => 'ru']
);
$enumPropId = [];
while ($arRes = $dbRes->Fetch()) {
    $arProp[$arRes["FIELD_NAME"]] = "[".$arRes["ID"]."] ".$arRes["LIST_COLUMN_LABEL"];
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
        "PERIOD_END" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PERIOD_END"),
            "TYPE" => "STRING",
            "DEFAULT" => "9",
        ),
        "FILL_SIDEBAR" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("FILL_SIDEBAR"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        ),
        "NAME_CARD_IM" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("NAME_CARD_IM"),
            "TYPE" => "STRING",
            "DEFAULT" => "талон",
        ),
        "NAME_CARD_ROD" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("NAME_CARD_ROD"),
            "TYPE" => "STRING",
            "DEFAULT" => "талона",
        ),
        "NAME_CARD_MULTI" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("NAME_CARD_MULTI"),
            "TYPE" => "STRING",
            "DEFAULT" => "талонов",
        ),
        "NAME_CARD_NOT" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("NAME_CARD_NOT"),
            "TYPE" => "STRING",
            "DEFAULT" => "нет талонов",
        ),
        "LINK_PRIVACY" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("LINK_PRIVACY"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("LINK_PRIVACY_DEFAULT"),
        ),
        "FIRST_STEP" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("FIRST_STEP"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("FIRST_STEP_NAME"),
        ),
        "SECOND_STEP" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("SECOND_STEP"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("SECOND_STEP_NAME"),
        ),
        "THIRD_STEP" => array(
            "PARENT" => "SIGN",
            "NAME" => Loc::getMessage("THIRD_STEP"),
            "TYPE" => "STRING",
            "DEFAULT" => Loc::getMessage("THIRD_STEP_NAME"),
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
        "IS_FLEXSLIDER" => array(
            "PARENT" => "PLUGINS",
            "NAME" => Loc::getMessage("IS_FLEXSLIDER"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
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
