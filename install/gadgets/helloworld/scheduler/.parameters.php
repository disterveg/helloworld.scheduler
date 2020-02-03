<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

if (!Loader::includeModule('highloadblock')) {
    return;
}

if(!Loader::includeModule('helloworld.scheduler')) {
    return;
}

$arSortBy = array(
    "ID" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_BY_ID"),
    "UF_FIO" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_BY_NAME"),
    "UF_DATE_CREATE" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_BY_DATE_CREATE"),
);

$arSortOrder= array(
    "ASC" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_ORDER_ASC"),
    "DESC" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_ORDER_DESC")
);

$helper = new HlblockHelper();

$arProp = [];
$dbRes = CUserTypeEntity::GetList(
    array('SORT' => 'ASC'),
    array('ENTITY_ID' => $helper->getEntityId('Appointments'), 'LANG' => 'ru')
);
$enumPropId = [];
while ($arRes = $dbRes->Fetch()) {
    $arProp[$arRes["FIELD_NAME"]] = "[".$arRes["ID"]."] ".$arRes["LIST_COLUMN_LABEL"];
}



$arParameters["USER_PARAMETERS"]["SORT_BY"] = Array(
    "NAME" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_BY"),
    "TYPE" => "LIST",
    "VALUES" => $arSortBy,
    "MULTIPLE" => "N",
    "DEFAULT" => "ID"
);

$arParameters["USER_PARAMETERS"]["SORT_ORDER"] = Array(
    "NAME" => Loc::GetMessage("HELLOWORLD_SCHEDULER_SORT_ORDER"),
    "TYPE" => "LIST",
    "VALUES" => $arSortOrder,
    "MULTIPLE" => "N",
    "DEFAULT" => "DESC"
);

$arParameters["USER_PARAMETERS"]["ADDITIONAL_FIELDS"] = Array(
    "NAME" => Loc::GetMessage("HELLOWORLD_SCHEDULER_ADDITIONAL_FIELDS"),
    "TYPE" => "LIST",
    "VALUES" => $arProp,
    "MULTIPLE" => "Y",
    "DEFAULT" => array('UF_FIO', 'UF_PHONE', 'UF_DATE', 'UF_TIME', 'UF_DOC_NAME', 'UF_DEPARTMENT')
);

$arParameters["USER_PARAMETERS"]["ITEMS_COUNT"] = Array(
    "NAME" => Loc::GetMessage("HELLOWORLD_SCHEDULER_ITEMS_COUNT"),
    "TYPE" => "STRING",
    "DEFAULT" => "3"
);

?>