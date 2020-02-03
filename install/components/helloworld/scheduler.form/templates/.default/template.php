<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
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
$this->setFrameMode(false);

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\Tools;
?>
<div class="third-step" id="third-step">
    <div class="maxwidth-screen">
        <div class="personal-info">
            <div class="visit_title personal-info_title"><?= Loc::getMessage("TITLE_FORM") ?></div>
            <div class="reviews__form">
                <div class="error__text"></div>
                <form class="iblock_add__form" name="appointment-add"
                      action="<?= $arParams["COMPONENT_ROOT"] ?>/ajax.php"
                      method="post"
                      enctype="multipart/form-data">
                    <?= bitrix_sessid_post() ?>
                    <input type="hidden" name="UF_CARD_ID" value="<?= $arParams['CARD_ID'] ?>">
                    <input type="hidden" name="UF_DATE_CREATE" value="<?= date('d.m.Y H:i:s') ?>">
                    <input type="hidden" name="UF_ACTIVE" value="0">
                    <input type="hidden" name="component_root" value="<?= $arParams["COMPONENT_ROOT"] ?>">
                    <?if(Option::get(Tools::getModuleName(), 'enable_recaptcha') == 'Y') {?>
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <input type="hidden" name="action" value="validate_captcha">
                        <input type="hidden" name="site_key" value="<?= Option::get(Tools::getModuleName(), 'site_key') ?>">
                    <?}?>
                    <?php if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])): ?>
                        <div class="wrapper-top-form">
                            <?php foreach ($arParams["PROPERTY_CODES"] as $field): ?>
                                <? if ($field == 'UF_DOCS')
                                    continue; ?>
                                <? if ($arResult["PROPERTY_LIST"][$field]): ?>
                                    <? switch ($arResult["PROPERTY_LIST"][$field]['USER_TYPE_ID']):
                                        case 'enumeration':
                                            ?>
                                            <div class="wrapper-field personal-info_block personal-info-quiz
                                            <?= $arResult["PROPERTY_LIST"][$field]['MULTIPLE'] == 'Y'
                                                ? 'multi-enumeration'
                                                : 'list' ?>">
                                                <div class="personal-info-quiz_title label-confirm">
                                                    <?= $arResult["PROPERTY_LIST"][$field]['LIST_COLUMN_LABEL'] ?>
                                                    <?= $arResult["PROPERTY_LIST"][$field]['MANDATORY'] == 'Y'
                                                    || in_array($field, $arParams['PROPERTY_CODES_REQUIRED'])
                                                        ? '<span class="starrequired">*</span>' : '' ?>
                                                </div>
                                                <?
                                                if ($arResult["PROPERTY_LIST"][$field]['MULTIPLE'] == 'Y'):?>
                                                    <input type="text" name="<?= $field ?>"
                                                           class="form-control field-multi-enum hidden" value="">
                                                <?endif; ?>
                                                <?php foreach ($arResult["PROPERTY_LIST"][$field]['ENUM_VALUES'] as $key => $val): ?>
                                                    <label>
                                                        <? if ($arResult["PROPERTY_LIST"][$field]['MULTIPLE'] == 'Y'): ?>
                                                            <input type="checkbox" name="item_<?= $key ?>"
                                                                   class="form-control <?= $arResult["PROPERTY_LIST"][$field]['MANDATORY'] == 'Y'
                                                                   || in_array($field, $arParams['PROPERTY_CODES_REQUIRED']) ? 'required' : '' ?> enum-checkboxes_<?= $field ?>"
                                                                   value="<?= $key ?>">
                                                        <? else: ?>
                                                            <input id="confirm-input_<?= $key ?>" name="<?= $field ?>"
                                                                   value="<?= $key ?>"
                                                                   class="personal-info-input custom-radio <?= $arResult["PROPERTY_LIST"][$field]['MANDATORY'] == 'Y'
                                                                   || in_array($field, $arParams['PROPERTY_CODES_REQUIRED'])
                                                                       ? 'required' : '' ?>"
                                                                   type="radio">
                                                        <? endif; ?>
                                                        <span class="<?= $arResult["PROPERTY_LIST"][$field]['MULTIPLE'] == 'Y' ? 'checkbox-custom' : 'radio-custom' ?>"></span>
                                                        <span class="label-confirm"><?= $val ?></span>
                                                    </label>
                                                <?php endforeach; ?>
                                            </div>
                                            <?
                                            break;
                                        default:
                                            ?>
                                            <div class="wrapper-field">
                                                <div class="label-full-name  <?= $field ?>">
                                                    <div class="label-confirm <?= $field ?>">
                                                        <?= $arResult["PROPERTY_LIST"][$field]['LIST_COLUMN_LABEL'] ?>
                                                        <?= $arResult["PROPERTY_LIST"][$field]['MANDATORY'] == 'Y'
                                                        || in_array($field, $arParams['PROPERTY_CODES_REQUIRED'])
                                                            ? '<span class="starrequired">*</span>' : '' ?>
                                                    </div>
                                                    <div class="td_item-rew">
                                                        <input id="<?= $field ?>"
                                                               class="personal-info-input <?= $arResult["PROPERTY_LIST"][$field]['MANDATORY'] == 'Y'
                                                               || in_array($field, $arParams['PROPERTY_CODES_REQUIRED'])
                                                                   ? 'required' : '' ?>"
                                                               type="text"
                                                            <? if ($field == 'UF_EMAIL'): ?>
                                                                placeholder="mail@mail.com"
                                                            <? endif; ?>
                                                               name="<?= $field ?>"
                                                               size="25"
                                                               value="">
                                                    </div>
                                                </div>
                                            </div>
                                        <? endswitch; ?>
                                <? endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <div class="clearfix"></div>
                        <div class="wrapper-bottom-form">
                            <div class="visit_title info-admission_title"><?= Loc::getMessage("YOUR_APPOINTMENT") ?></div>
                            <div class="info-admission">
                                <div class="col-info__visit">
                                    <div class="info-admission-container">
                                        <div class="time-description time-description_info">
                                            <div>
                                                <div class="time-description_title"><?= $arResult["PROPERTY_LIST"]['UF_DATE']['LIST_COLUMN_LABEL'] ?></div>
                                                <input class="time-description_text" name="UF_DATE"
                                                       id="date-admission"
                                                       value="<?= $arParams['DATE_REG'] ?>" readonly>
                                            </div>
                                            <div>
                                                <div class="time-description_title"><?= $arResult["PROPERTY_LIST"]['UF_TIME']['LIST_COLUMN_LABEL'] ?></div>
                                                <input class="time-description_text" name="UF_TIME"
                                                       id="time-admission"
                                                       value="<?= $arParams['TIME_REG'] ?>" readonly>
                                            </div>
                                            <div>
                                                <div class="time-description_title"><?= $arResult["PROPERTY_LIST"]['UF_DOC_NAME']['LIST_COLUMN_LABEL'] ?></div>
                                                <input class="time-description_text hidden" name="UF_DOC_NAME"
                                                       id="doctor-admission_record"
                                                       value="<?= $arParams['DOCTOR'] ?>" readonly>
                                                <div class="time-description_text"><?= $arParams['DOCTOR'] ?></div>
                                            </div>
                                            <div>
                                                <div class="time-description_title"><?= $arResult["PROPERTY_LIST"]['UF_DEPARTMENT']['LIST_COLUMN_LABEL'] ?></div>
                                                <input class="time-description_text hidden"
                                                       name="UF_DEPARTMENT" id="type-admission_record"
                                                       value="<?= $arParams['DEPARTMENT'] ?>" readonly>
                                                <div class="time-description_text"><?= $arParams['DEPARTMENT'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-confirmation-info">
                                    <div class="confirmation">
                                        <? if (in_array('UF_DOCS', $arParams['PROPERTY_CODES'])): ?>
                                            <div class="visit_title confirmation_title label-confirm">
                                                <?= Loc::getMessage("ACCEPT_APPOINTMENT") ?>
                                                <?= $arResult["PROPERTY_LIST"]['UF_DOCS']['MANDATORY'] == 'Y'
                                                || in_array('UF_DOCS', $arParams['PROPERTY_CODES_REQUIRED'])
                                                    ? '<span class="starrequired">*</span>' : '' ?>
                                            </div>
                                            <input type="text" name="UF_DOCS"
                                                   class="form-control field-multi-enum hidden" value="">
                                            <?php foreach ($arResult["PROPERTY_LIST"]['UF_DOCS']['ENUM_VALUES'] as $k => $val): ?>
                                                <label>
                                                    <input type="checkbox" name="doc_<?= $k ?>"
                                                           class="form-control <?= $arResult["PROPERTY_LIST"]['UF_DOCS']['MANDATORY'] == 'Y'
                                                           || in_array('UF_DOCS', $arParams['PROPERTY_CODES_REQUIRED'])
                                                               ? 'required' : '' ?> enum-checkboxes_UF_DOCS"
                                                           value="<?= $k ?>">
                                                    <span class="checkbox-custom"></span>
                                                    <span class="label-confirm text-link"><?= $val ?></span>
                                                </label>
                                            <?php endforeach; ?>
                                        <? endif; ?>
                                        <div class="confirmation_title visit_title privacy">
                                            <?= Loc::getMessage("PRIVACY_POLICY") ?>
                                            <span class="starrequired">*</span>
                                        </div>
                                        <div class="licences_block">
                                            <label>
                                                <input type="checkbox"
                                                       id="policy"
                                                       name="privacy"
                                                       class="form-control required privacy-policy"
                                                       value=""
                                                       aria-required="true">
                                                <span class="checkbox-custom"></span>
                                                <span class="label-confirm text-link">
                                                    <?= Loc::getMessage("AGREE") ?>
                                                        <? if (!empty($arParams['LINK_PRIVACY'])): ?>
                                                            <a href="<?= $arParams['LINK_PRIVACY'] ?>" target="_blank">
                                                        <? endif; ?>
                                                    <?= Loc::getMessage("POLICY") ?>
                                                        <? if (!empty($arParams['LINK_PRIVACY'])): ?>
                                                            </a>
                                                        <? endif; ?>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <div class="maxwidth-screen">
                        <div class="container-button container-button_step-2">
                            <a href="<?= $arParams['SEF_FOLDER'] ?>?second-step=Y"
                               class="btn btn-default confirm-button confirm-button__active button-prev">
                                <?= Loc::getMessage("SECOND_STEP") ?>
                            </a>
                            <input class="btn btn-default submit"
                                   type="submit"
                                   value="<?= Loc::getMessage("APPOINTMENT") ?>">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="success__form">
    <div class="check_mark">
        <div class="sa-icon sa-success animate">
            <span class="sa-line sa-tip animateSuccessTip"></span>
            <span class="sa-line sa-long animateSuccessLong"></span>
            <div class="sa-placeholder"></div>
            <div class="sa-fix"></div>
        </div>
    </div>
    <div class="content_mess">
        <? if (!empty($arParams["MESSAGE_SUCCESS"])): ?>
            <?= $arParams["MESSAGE_SUCCESS"] ?>
        <? else: ?>
            <?= Loc::getMessage("SUCCESS_MSG") ?>
        <? endif; ?>
    </div>
</div>



