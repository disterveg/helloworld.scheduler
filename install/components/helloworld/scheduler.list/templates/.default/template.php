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
<div class="visit_title"><?= Loc::getMessage("NEED_DEPARTMENT") ?></div>
<div class="maxwidth-screen">
    <div class="container-visit">
        <?php foreach ($arResult['DEPARTMENTS'] as $department): ?>
            <div class="department__item animate-click">
                <div class="visit_block" data-department="<?= $department['ID'] ?>">
                    <div class="visit_block-title"><?= $department['UF_NAME'] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div id="list">
    <div class="loader_spinner"></div>
    <? //AJAX ?>
</div>
<script type="text/javascript">
    componentParameters = <?= json_encode($arParams)?>;
</script>