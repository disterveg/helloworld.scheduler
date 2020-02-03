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

$component->includeComponentTemplate('formatdate');
$component->includeComponentTemplate('formatcardname');
?>
<div class="loader_spinner"></div>
<div class="maxwidth-screen">
    <?if($arResult["DATA"]):?>
    <div class="date-select date-select-container">
        <div class="table-container">
            <div class="doctor-slider" id="doctor-slider">
                <ul class="slides items">
                    <?php foreach ($arResult['PERIOD_TIME'] as $key => $item):
                        $day = ruDateFull("l", strtotime($item)); ?>
                        <li class="item doctor-slider_item">
                            <div class="date-of-week">
                                <p class="date-of-week__date">
                                    <?= $item ?>
                                </p>
                                <p class="date-of-week__day">
                                    <?= $day; ?>
                                </p>
                            </div>
                            <?php foreach ($arResult["DATA"] as $docId => $arItem) :
                                switch (count($arItem[$item])) {
                                    case 0:
                                        $className = 'item_disabled';
                                        break;
                                    case 1:
                                        $className = 'item_few';
                                        break;
                                    default:
                                        $className = 'item_enough';
                                        break;
                                }
                                ?>
                                <div id="<?= $key ?>"
                                     class="ticket <?= $className ?>"
                                     data-date="<?= $item ?>"
                                     data-specialist="<?= $docId ?>"
                                     data-section="<?= $arParams["DEPARTMENT_ID"] ?>"
                                     data-day="<?= $day ?>">
                                    <div class="ticket-block">
                                        <div class="scheduling-item animate-click">
                                        <h4 class="doctor-name">
                                            <?= $arResult['DOCTORS'][$docId] ?>
                                        </h4>
                                        <p class="card-block__count">
                                        <?= count($arItem[$item]) > 0 ?
                                            plural_form(
                                                count($arItem[$item]),
                                                array(
                                                    $arParams['NAME_CARD_IM'],
                                                    $arParams['NAME_CARD_ROD'],
                                                    $arParams['NAME_CARD_MULTI']
                                                )
                                            ) : $arParams['NAME_CARD_NOT'];
                                        ?>
                                        </p>
                                        <p class="card-block__times">
                                            <?if(count($arItem[$item]) > 0):?>
                                                <?= array_shift($arItem[$item])['UF_TIME'] ?>
                                                <?= !empty($arItem[$item]) ? '-' : '' ?>
                                                <?= array_pop($arItem[$item])['UF_TIME'] ?>
                                            <?endif;?>
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="maxwidth-screen">
        <div class="time-select" id="times">
            <div class="spinner"></div>
            <?php //AJAX?>
        </div>
    </div>
    <?else:?>
        <span class="error_msg"><?= Loc::getMessage('NO_DATA') ?></span>
    <?endif;?>



