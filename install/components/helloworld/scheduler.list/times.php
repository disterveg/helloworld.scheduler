<?php
define('STOP_STATISTICS', true);
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main;
use Bitrix\Main\Loader;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

Loader::includeModule("highloadblock");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

$arParams = $request->get('PARAMETERS');

if (!check_bitrix_sessid() || !$request->isPost())
    return;

$arParams['TIMES'] = 'Y';
if ($arParams['DEPARTMENT_ID']) {
    $APPLICATION->IncludeComponent(
        'helloworld:scheduler.list',
        '',
        $arParams,
        false
    );
}
