<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;

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
?>
<div class="maxwidth-screen">
    <div class="wrapper__content">
        <div class="control-panel">
            <? include_once("stepdisplay.php"); ?>
        </div>
        <div class="content-col">
            <?
            $APPLICATION->IncludeComponent(
                "helloworld:scheduler.list",
                "",
                array(
                    "NAME_CARD_IM" => $arParams['NAME_CARD_IM'],
                    "NAME_CARD_ROD" => $arParams['NAME_CARD_ROD'],
                    "NAME_CARD_MULTI" => $arParams['NAME_CARD_MULTI'],
                    "NAME_CARD_NOT" => $arParams['NAME_CARD_NOT'],
                    "PERIOD_END" => $arParams['PERIOD_END'],
                    "SEF_URL_TEMPLATES" => $arParams['SEF_URL_TEMPLATE'],
                    "IS_FLEXSLIDER" => $arParams['IS_FLEXSLIDER'],
                ),
                $component
            ); ?>
        </div>
    </div>
</div>





