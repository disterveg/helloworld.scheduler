<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use HelloWorld\Scheduler\Helpers\HlblockHelper;

$APPLICATION->SetAdditionalCSS('/bitrix/gadgets/helloworld/scheduler/styles.css');

?>
<?
if (!CModule::IncludeModule("helloworld.scheduler"))
    return false;

if (
    intval($arGadgetParams["ITEMS_COUNT"]) < 1
    || intval($arGadgetParams["ITEMS_COUNT"]) > 20
)
    $arGadgetParams["ITEMS_COUNT"] = 10;

if (strlen($arGadgetParams["SORT_BY"]) <= 0)
    $arGadgetParams["SORT_BY"] = "ID";

if (strlen($arGadgetParams["SORT_ORDER"]) <= 0)
    $arGadgetParams["SORT_ORDER"] = "DESC";

if (!is_array($arGadgetParams["ADDITIONAL_FIELDS"]) || count($arGadgetParams["ADDITIONAL_FIELDS"]) <= 0)
    $arGadgetParams["ADDITIONAL_FIELDS"] = array();

$helper = new HlblockHelper();

$arProp = [];
$dbRes = CUserTypeEntity::GetList(
    array('SORT' => 'ASC'),
    array('ENTITY_ID' => $helper->getEntityId('Appointments'), 'LANG' => 'ru')
);
$enumPropId = [];
while ($arRes = $dbRes->Fetch()) {
    $arProp[$arRes["FIELD_NAME"]] = $arRes["LIST_COLUMN_LABEL"];
}

$select = ['ID'];
$select = array_merge($select, $arGadgetParams["ADDITIONAL_FIELDS"]);

$appointmentsTable = $helper->getDataManager('Appointments');
$hlBlockId = $helper->getHlblockId('Appointments');
$dbIBlockElement = $appointmentsTable::getList(array(
    'select' => $select,
    'order' => [
        $arGadgetParams["SORT_BY"] => $arGadgetParams["SORT_ORDER"]
    ],
    'limit' => $arGadgetParams["ITEMS_COUNT"]
));
$cnt = 0;
while ($record = $dbIBlockElement->Fetch()) {
    ?>
    <div class="bx-gadgets-text">
        <div class="inner-text">
            <?
            foreach ($arGadgetParams["ADDITIONAL_FIELDS"] as $selectField) {
                switch ($selectField) {
                    case 'UF_FIO':
                        echo '<a href="/bitrix/admin/highloadblock_row_edit.php?ENTITY_ID=' . $hlBlockId . '&ID=' . $record['ID'] . '"><b>' . $record['UF_FIO'] . '</b></a><br>';
                        break;
                    default:
                        echo '<b>' . $arProp[$selectField] . '</b>: ' . $record[$selectField] . '<br>';
                        break;
                }
            }
            ?>
        </div>
    </div>
    <?
    $cnt++;
}

if($cnt > 0) {
    ?>
    <div class="all-link">
        <a href="/bitrix/admin/highloadblock_rows_list.php?ENTITY_ID=<?= $hlBlockId ?>"><?= GetMessage("GD_IBEL_NAME_ALL_ELEMENTS") ?></a>
    </div>
    <?
} else {?>
    <p style="color: #fff">Нет записей на прием</p>
<?}

