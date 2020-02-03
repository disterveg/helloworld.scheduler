<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
/** Bitrix vars */
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */

/** @var CBitrixComponent $component */

use Bitrix\Main\Localization\Loc;

/**
 * Лэнговые фразы для календаря
 * @return string
 */
function ruDateFull()
{
    $translate = array(
        "am" => Loc::getMessage("TRANSLATE_am"),
        "pm" => Loc::getMessage("TRANSLATE_pm"),
        "AM" => Loc::getMessage("TRANSLATE_AM"),
        "PM" => Loc::getMessage("TRANSLATE_PM"),
        "Monday" => Loc::getMessage("TRANSLATE_Monday"),
        "Mon" => Loc::getMessage("TRANSLATE_Mon"),
        "Tuesday" => Loc::getMessage("TRANSLATE_Tuesday"),
        "Tue" => Loc::getMessage("TRANSLATE_Tue"),
        "Wednesday" => Loc::getMessage("TRANSLATE_Wednesday"),
        "Wed" => Loc::getMessage("TRANSLATE_Wed"),
        "Thursday" => Loc::getMessage("TRANSLATE_Thursday"),
        "Thu" => Loc::getMessage("TRANSLATE_Thu"),
        "Friday" => Loc::getMessage("TRANSLATE_Friday"),
        "Fri" => Loc::getMessage("TRANSLATE_Fri"),
        "Saturday" => Loc::getMessage("TRANSLATE_Saturday"),
        "Sat" => Loc::getMessage("TRANSLATE_Sat"),
        "Sunday" => Loc::getMessage("TRANSLATE_Sunday"),
        "Sun" => Loc::getMessage("TRANSLATE_Sun"),
        "January" => Loc::getMessage("TRANSLATE_January"),
        "Jan" => Loc::getMessage("TRANSLATE_Jan"),
        "February" => Loc::getMessage("TRANSLATE_February"),
        "Feb" => Loc::getMessage("TRANSLATE_Feb"),
        "March" => Loc::getMessage("TRANSLATE_March"),
        "Mar" => Loc::getMessage("TRANSLATE_Mar"),
        "April" => Loc::getMessage("TRANSLATE_April"),
        "Apr" => Loc::getMessage("TRANSLATE_Apr"),
        "May" => Loc::getMessage("TRANSLATE_May"),
        "June" => Loc::getMessage("TRANSLATE_June"),
        "Jun" => Loc::getMessage("TRANSLATE_Jun"),
        "July" => Loc::getMessage("TRANSLATE_July"),
        "Jul" => Loc::getMessage("TRANSLATE_Jul"),
        "August" => Loc::getMessage("TRANSLATE_August"),
        "Aug" => Loc::getMessage("TRANSLATE_Aug"),
        "September" => Loc::getMessage("TRANSLATE_September"),
        "Sep" => Loc::getMessage("TRANSLATE_Sep"),
        "October" => Loc::getMessage("TRANSLATE_October"),
        "Oct" => Loc::getMessage("TRANSLATE_Oct"),
        "November" => Loc::getMessage("TRANSLATE_November"),
        "Nov" => Loc::getMessage("TRANSLATE_Nov"),
        "December" => Loc::getMessage("TRANSLATE_December"),
        "Dec" => Loc::getMessage("TRANSLATE_Dec"),
        "st" => Loc::getMessage("TRANSLATE_st"),
        "nd" => Loc::getMessage("TRANSLATE_nd"),
        "rd" => Loc::getMessage("TRANSLATE_rd"),
        "th" => Loc::getMessage("TRANSLATE_th"),
    );
    if (func_num_args() > 1) {
        $timestamp = func_get_arg(1);
        return strtr(date(func_get_arg(0), $timestamp), $translate);
    } else {
        return strtr(date(func_get_arg(0)), $translate);
    }
}
