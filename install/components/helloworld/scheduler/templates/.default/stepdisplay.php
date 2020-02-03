<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\Tools;

?>
<div class="control-panel__block">
    <a href="<?= $arParams['SEF_URL_TEMPLATE'] ?>?first-step=Y" class="control-panel__link first">
        <div class="control-panel__item <?= !isset($arResult['VARIABLES']['second-step'])
        && !isset($arResult['VARIABLES']['third-step']) ? 'active' : '' ?> animate-click">
            <div class="control-panel__img">
                <?= Tools::showIconSvg("document", __DIR__. "/img/document.svg"); ?>
            </div>
            <div class="control-panel__name"><?= $arParams['FIRST_STEP'] ?></div>
        </div>
    </a>
    <a href="<?= $arParams['SEF_URL_TEMPLATE'] ?>?second-step=Y" class="control-panel__link second">
        <div class="control-panel__item <?= isset($arResult['VARIABLES']['second-step']) ? 'active' : '' ?> animate-click">
            <div class="control-panel__img">
                <?= Tools::showIconSvg("calendar", __DIR__. "/img/calendar.svg"); ?>
            </div>
            <div class="control-panel__name"><?= $arParams['SECOND_STEP'] ?></div>
        </div>
    </a>
    <a href="<?= $arParams['SEF_URL_TEMPLATE'] ?>?third-step=Y" class="control-panel__link third">
        <div class="control-panel__item <?= isset($arResult['VARIABLES']['third-step']) ? 'active' : '' ?> animate-click disabled-link">
            <div class="control-panel__img">
                <?= Tools::showIconSvg("form", __DIR__. "/img/form.svg"); ?>
            </div>
            <div class="control-panel__name"><?= $arParams['THIRD_STEP'] ?></div>
        </div>
    </a>
</div>
