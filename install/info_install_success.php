<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!check_bitrix_sessid()) {
    return;
}
?>
<form action="/scheduler/">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="submit" value="<?= Loc::getMessage('HELLOWORLD_SCHEDULER_SITE'); ?>">
</form>
<br>
<form action="<?= $APPLICATION->getCurPage(); ?>">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="submit" value="<?= Loc::getMessage('HELLOWORLD_SCHEDULER_RETURN_MODULES'); ?>">
</form>
