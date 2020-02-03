<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расписание"); ?>

<?$APPLICATION->IncludeComponent(
    "helloworld:scheduler",
    ".default",
    array(
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "NAME_CARD_IM" => "талон",
        "NAME_CARD_ROD" => "талона",
        "NAME_CARD_MULTI" => "талонов",
        "NAME_CARD_NOT" => "нет талонов",
        "PERIOD_END" => "9",
        "PROPERTY_CODES" => array(
            0 => "UF_FIO",
            1 => "UF_YEAR",
            2 => "UF_PHONE",
            3 => "UF_DOCS",
            4 => "UF_MED_CARD",
            5 => "UF_EMAIL",
            6 => "",
        ),
        "PROPERTY_CODES_REQUIRED" => array(
            0 => "UF_FIO",
            1 => "UF_YEAR",
            2 => "UF_PHONE",
            3 => "UF_DOCS",
            4 => "UF_MED_CARD",
            5 => "UF_EMAIL",
            6 => "",
        ),
        "MESSAGE_SUCCESS" => "",
        "TITLE_SECTION" => "Запись на приём",
        "FILL_SIDEBAR" => "Y",
        "IS_FLEXSLIDER" => "Y",
        "IS_MASKED_INPUT" => "Y",
        "IS_VALIDATER" => "Y",
        "COMPONENT_TEMPLATE" => ".default",
        "LINK_PRIVACY" => "/include/licenses_detail.php",
        "SEF_URL_TEMPLATE" => "/scheduler/",
        "FIRST_STEP" => "Необходимые документы",
        "SECOND_STEP" => "Выбор врача, даты и времени",
        "THIRD_STEP" => "Отправка личных данных"
    ),
    false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>