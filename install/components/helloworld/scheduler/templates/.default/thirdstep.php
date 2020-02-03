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

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter); ?>
<div class="maxwidth-screen">
    <div class="wrapper__content">
        <div class="control-panel">
            <? include_once("stepdisplay.php");?>
        </div>
        <div class="content-col">
            <?php
            $APPLICATION->IncludeComponent(
                "helloworld:scheduler.form",
                "",
                array(
                    "DATE_REG" => $request->get('DATE') . ' ' . $request->get('DAY'),
                    "TIME_REG" => $request->get('TIME'),
                    "DOCTOR" => $request->get('DOCTOR'),
                    "DOC_ID" => $request->get('DOC_ID'),
                    "CARD_ID" => $request->get('CARD_ID'),
                    "DEPARTMENT" => $request->get('DEPARTMENT'),
                    "PROPERTY_CODES" => $arParams['PROPERTY_CODES'],
                    "PROPERTY_CODES_REQUIRED" => $arParams['PROPERTY_CODES_REQUIRED'],
                    "MESSAGE_SUCCESS" => $arParams['MESSAGE_SUCCESS'],
                    "SEF_URL_TEMPLATES" => $arParams['SEF_URL_TEMPLATE'],
                    "IS_MASKED_INPUT" => $arParams['IS_MASKED_INPUT'],
                    "IS_VALIDATER" => $arParams['IS_VALIDATER'],
                    "LINK_PRIVACY" => $arParams['LINK_PRIVACY'],
                ),
                $component
            );?>
        </div>
    </div>
</div>

