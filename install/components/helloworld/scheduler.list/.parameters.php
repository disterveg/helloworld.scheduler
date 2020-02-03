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
        "PERIOD_END" => array(
            "PARENT" => "BASE",
            "NAME" => Loc::getMessage("PERIOD_END"),
            "TYPE" => "STRING",
            "DEFAULT" => "9",
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
        )
        "CACHE_TIME"  =>  array("DEFAULT"=>36000000),
    ),
);
