<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
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
?>
<div class="spinner"></div>
<div class="visit_title date-select_title"><?= Loc::getMessage("TIME_CHOICE") ?></div>
<div class="time-select-container">
    <div class="time-description">
        <div class="doc-visit">
            <div class="visit-doc__img">
                <?if($arResult['DOCTOR_PHOTO']):?>
                    <img src="<?= $arResult['DOCTOR_PHOTO'] ?>"/>
                <?else:?>
                    <img src="<?= $templateFolder ?>/images/noimage.png"/>
                <?endif;?>
            </div>
            <span class="time-description_text" id="doctor-admission">
                <?= $arResult['DOCTOR_NAME'] ?>
            </span>
        </div>
        <div class="time-description_title"><?= Loc::getMessage("DATE") ?></div>
        <span class="time-description_text"
              id="date-admission"><?= $arParams["DATE"] ?> <?= $arParams["DAY"] ?></span>
        <div class="time-description_title"><?= Loc::getMessage("TYPE") ?></div>
        <span class="time-description_text"
              id="type-admission"><?= $arResult['NAME_DEPARTMENT'] ?></span>
    </div>

    <div class="time-admission">
        <?php foreach ($arResult['TIMES_VISIT'] as $time): ?>
            <div class="time-admission-block">
                <div class="card-block_time animate-click"
                     data-card-id="<?= $time['ID'] ?>"
                     data-time="<?php echo date_create($time['UF_DATE_TIME'])->Format('H:i') ?>"
                     data-staff="<?= $arResult["TICKETS"]['NAME'] ?>" data-doctor-id="<?= $time['UF_DOCTOR'] ?>"
                     data-section="<?= $time['UF_DEPARTMENT'] ?>">
                    <?php echo date_create($time['UF_DATE_TIME'])->Format('H:i') ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="clear-fix"></div>
</div>
<div class="container-button container-button_step-2">
    <a href="?first-step=Y"
       class="btn btn-default button-prev">
        <span class="mobile-button"><?= Loc::getMessage("PREV") ?></span>
    </a>
    <form action="<?= $arParams['SEF_FOLDER'] ?>?third-step=Y"
          class="form-second-step button-next"
          id="secondStepForm"
          method="post">
        <fieldset>
            <div class="wrapper-fields-form hidden">
                <input title="" type="text" name="DAY" value="<?= $arParams["DATE"] ?> <?= $arParams["DAY"] ?>">
                <input title="" type="text" name="TIME" value="<?//JS TIME?>">
                <input title="" type="text" name="CARD_ID" value="<?//JS ID?>">
                <input title="" type="text" name="DOCTOR" value="<?= $arResult['DOCTOR_NAME'] ?>">
                <input title="" type="text" name="DEPARTMENT" value="<?= $arResult['NAME_DEPARTMENT'] ?>">
            </div>
            <input class="btn btn-default button-next submit confirm-input" type="submit"
                   value="<?= Loc::getMessage("PERSONAL_DATA") ?>">
        </fieldset>
    </form>
</div>