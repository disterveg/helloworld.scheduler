<?php
if (!empty($arResult['DOCTOR_PHOTO'])) {
    $arResult['DOCTOR_PHOTO'] = CFile::ResizeImageGet(
        $arResult['DOCTOR_PHOTO'],
        array("width" => 60, "height" => 60),
        BX_RESIZE_IMAGE_EXACT,
        true
    )['src'];
}