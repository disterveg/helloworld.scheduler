<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc;

$arComponentDescription = array(
    "NAME" => Loc::getMessage("NAME_SCHEDULER"),
    "DESCRIPTION" => Loc::getMessage("DESCRIPTION_SCHEDULER"),
    "COMPLEX" => "Y",
    "SORT" => 10,
    "PATH" => array(
        "ID" => "helloworld",
        "NAME" => Loc::getMessage("COMPONENT_CREATER"),
        "CHILD" => array(
            "ID" => "scheduler",
            "NAME" => Loc::getMessage("NAME_SCHEDULER"),
            "SORT" => 10,
        ),
    ),
);

?>