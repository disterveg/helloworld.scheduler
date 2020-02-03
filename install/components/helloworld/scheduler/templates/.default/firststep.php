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
            <? include_once("stepdisplay.php");?>
        </div>
        <div class="content-col">
            <div class="text text-container">
                <?if(isset($arResult['LEFT_COL_INFO'])):?>
                <div class="col-half">
                    <?= $arResult['LEFT_COL_INFO'] ?>
                </div>
                <?endif;?>
                <?if(isset($arResult['RIGHT_COL_INFO'])):?>
                <div class="col-half">
                    <?= $arResult['RIGHT_COL_INFO'] ?>
                </div>
                <?endif;?>
            </div>
            <div class="container-button">
                <a href="?second-step=Y" class="btn btn-default button-next"><?= $arParams['SECOND_STEP'] ?></a>
                <label class="agreement-check">
                    <input id='confirm-input' class="confirm-input" type="checkbox">
                    <span class="checkbox-custom"></span>
                    <span class="label-confirm"><?= Loc::getMessage("CONFIRM") ?></span>
                </label>
            </div>
        </div>
    </div>
</div>
