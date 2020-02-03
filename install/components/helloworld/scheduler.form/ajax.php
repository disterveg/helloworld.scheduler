<?php

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;
use HelloWorld\Scheduler\Tools;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

Loader::includeModule("highloadblock");
Loader::includeModule("helloworld.scheduler");

$request = Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$request->addFilter(new \Bitrix\Main\Web\PostDecodeFilter);

if(Option::get(Tools::getModuleName(), 'enable_recaptcha') == 'Y'){
    if ($captcha = $request->get('g-recaptcha-response')) {
        $response = file_get_contents(
            "https://www.google.com/recaptcha/api/siteverify?secret="
            . Option::get(Tools::getModuleName(), 'secret_key')
            . "&response="
            . $captcha
            . "&remoteip="
            . $_SERVER['REMOTE_ADDR']
        );
        $response = json_decode($response);

        if ($response->success === false) {
            echo 'Response is false';
            die;
        }
    } else {
        echo 'Response not has captcha';
        die;
    }

    if ($response->success == true && $response->score <= 0.5) {
        echo 'If you is not bot then will write administrator site';
        die;
    }
}

if (!check_bitrix_sessid() || !$request->isPost()) {
    echo 'Check bitrix sessid is false';
    die;
}

$helper = new HlblockHelper();
$dataManager = $helper->getDataManager('Appointments');
$userFields = Tools::getHlUserFields();

$arrValues = [];
foreach ($userFields as $key => $userField) {
    if($userField['USER_TYPE_ID'] == 'enumeration' && $userField['MULTIPLE'] == 'Y') {
        $multiEnum = $request->get($key);
        $multiEnum = explode(',', $multiEnum);
        $arrValues[$key] = $multiEnum;
    } else {
        $arrValues[$key] = $request->get($key);
    }
}


$checkDouble = $dataManager::getRow(['filter' => ['UF_CARD_ID' => $arrValues['UF_CARD_ID']]]);
if(empty($checkDouble)){
    $result = $dataManager::add($arrValues);
}

if ($result->isSuccess()) {
    $helper->updateElement(
        'Cards',
        $request->get('UF_CARD_ID'),
        [
            'UF_PATIENT' => $request->get('UF_FIO'),
            'UF_RECORD' => '1',
            'UF_BOOKED' => '0',
            'UF_DATE_BOOKED' => ''
        ]
    );
    echo 'SUCCESS';
} else {
    echo implode(', ', $result->getErrors()) . "<br />";
}




