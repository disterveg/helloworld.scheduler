<?php
/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;
use HelloWorld\scheduler\Module;

CModule::IncludeModule($mid);
CModule::IncludeModule('fileman');

Loc::loadMessages(__FILE__);

include_once 'lessc.inc.php';

$module_id = $mid;
$bReadOnly = !$USER->CanDoOperation('catalog_settings');

if (!$USER->CanDoOperation('catalog_read') && $bReadOnly) {
    return;
}

$params = [
    [
        'tab'     => [
            "DIV"   => "tab_base_settings",
            "TAB"   => Loc::getMessage('HELLOWORLD_SCHEDULER_TAB_BASE_SETTINGS'),
            "TITLE" => Loc::getMessage("HELLOWORLD_SCHEDULER_TAB_BASE_TITLE_SETTINGS"),
        ],
        'options' => [
            'enable_recaptcha' => [
                'title' => Loc::getMessage("HELLOWORLD_SCHEDULER_RECAPATCHA_ENABLE"),
                'field' => ['type' => "checkbox", 'params' => ['size' => 50]],
            ],
            'site_key' => [
                'title' => Loc::getMessage("HELLOWORLD_SCHEDULER_SITE_KEY"),
                'field' => ['type' => "text"],
            ],
            'secret_key' => [
                'title' => Loc::getMessage('HELLOWORLD_SCHEDULER_SECRET_KEY'),
                'field' => ['type' => "text"],
            ],
            'main_color' => [
                'title' => Loc::getMessage('HELLOWORLD_SCHEDULER_MAIN_COLOR'),
                'field' => ['type' => "text", 'params' => ['color_picker' => 'Y']],
            ],
            'other_info'  => [
                'title' => Loc::getMessage("HELLOWORLD_SCHEDULER_OTHER_INFO"),
                'field' => ['type' => "html"],
            ],
            'info_clients' => [
                'title' => Loc::getMessage("HELLOWORLD_SCHEDULER_INFO_CLIENTS"),
                'field' => ['type' => "html"],
            ],
        ],
    ],
    [
        'tab' => [
            'DIV'   => 'tab_permission',
            'TAB'   => Loc::getMessage('MAIN_TAB_RIGHTS'),
            "TITLE" => Loc::getMessage('MAIN_TAB_TITLE_RIGHTS'),
        ],
    ],
];

$aTabs = array_column($params, 'tab');
$tabControl = new CAdminTabControl("tabControl", $aTabs);

$context = \Bitrix\Main\Context::getCurrent();
$request = $context->getRequest();
if ($context->getServer()->getRequestMethod() == 'POST' && check_bitrix_sessid()) {
    foreach ($params as $tabData) {
        foreach ($tabData['options'] as $optionName => $optionValue) {
            if (array_key_exists('field', $optionValue)) {
                Module::setDbOption(
                    $optionName,
                    htmlspecialcharsbx($request->get($optionName))
                );
                if(!empty($request->get('main_color'))){
                    $less = new lessc;
                    $less->setVariables(array('bcolor' => $request->get('main_color')));
                    if (is_dir(rtrim($_SERVER['DOCUMENT_ROOT'],
                            DIRECTORY_SEPARATOR) . '/local/components/helloworld/scheduler/templates/.default')
                    ) {
                        $themeDirPath = $_SERVER['DOCUMENT_ROOT']
                            . '/local/components/helloworld/scheduler/templates/.default/';
                    } else {
                        $themeDirPath = $_SERVER['DOCUMENT_ROOT']
                            . '/bitrix/components/helloworld/scheduler/templates/.default/';
                    }
                    mkdir($themeDirPath, 0755, true);
                    $output = $less->compileFile(__DIR__.'/css/theme.less', $themeDirPath.'style.css');
                }
            } else {
                foreach ($optionValue['fields'] as $field) {
                    Module::setDbOption(
                        $field['name'],
                        htmlspecialcharsbx($request->get($field['name']))
                    );
                    if(!empty($request->get('main_color'))){
                        $less = new lessc;
                        $less->setVariables(array('bcolor' => $request->get('main_color')));
                        if (is_dir(rtrim($_SERVER['DOCUMENT_ROOT'],
                                DIRECTORY_SEPARATOR) . '/local/components/helloworld/scheduler/templates/.default')
                        ) {
                            $themeDirPath = $_SERVER['DOCUMENT_ROOT']
                                . '/local/components/helloworld/scheduler/templates/.default/';
                        } else {
                            $themeDirPath = $_SERVER['DOCUMENT_ROOT']
                                . '/bitrix/components/helloworld/scheduler/templates/.default/';
                        }
                        mkdir($themeDirPath, 0755, true);
                        $output = $less->compileFile(__DIR__.'/css/theme.less', $themeDirPath.'style.css');
                    }
                }
            }
        }
    }
    if(!empty($RestoreDefaults)) {
        Module::removeDbOption();
    }
}

$urlParams = [
    'mid'  => $mid,
    'lang' => LANGUAGE_ID,
];
$formActionUrl = $APPLICATION->GetCurPage() . '?' . http_build_query($urlParams);
$MOD_RIGHT = $APPLICATION->GetGroupRight($mid);
?>
<form method="post" action="<?php echo $formActionUrl ?>">
    <?php
    echo bitrix_sessid_post();
    $tabControl->Begin();
    foreach ($params as $tabData) {
        $tabControl->BeginNextTab();
        $groups = $tabData['groups'] ?? ['' => array_keys($tabData['options'])];
        foreach ($groups as $title => $options) {
            if ($title) { ?>
                <tr class="heading">
                    <td colspan="3"><b><?php echo $title ?></b></td>
                </tr>
            <?php }

            foreach ($options as $optionKey => $optionName) {
                if ($optionKey === 'custom_header') {
                    ?><tr><?
                    foreach ($optionName as $name) {
                        ?>
                        <td>
                            <label>
                                <?php echo $name ?>
                            </label>
                        </td>
                        <?
                    }
                    ?></tr><?
                }
                $option = $tabData['options'][$optionName];
                if (array_key_exists('field', $option)) {
                    $field = $option['field'];
                    $value = Module::getDbOption($optionName);
                    $params = [
                        'type="' . $field['type'] . '"',
                        'id="' . $optionName . '"',
                        'name="' . $optionName . '"',
                    ];
                    foreach ($field['params'] as $paramName => $paramValue) {
                        $params[] = is_int($paramName) ? $paramValue : "{$paramName}=\"{$paramValue}\"";
                    }
                    $hintTagAttr = null;
                    if (isset($option['hint'])) {
                        $hintTagAttr = 'title="' . $option['hint'] . '"';
                        $params[] = $hintTagAttr;
                        $hintTagAttr .= ' ' . $hintTagAttr;
                    }

                    if (in_array($field['type'], ['text', 'number', 'checkbox'])) {
                        if ($field['type'] === 'checkbox' && $value) {
                            $params[] = 'checked';
                        }
                        if (empty($value) && $field['type'] === 'checkbox') {
                            $value = 1;
                        }
                        $params[] = 'value="' . $value . '"';
                    }
                    ?>
                    <?php if ($option['note_top']): ?>
                        <tr>
                            <td colspan="2" align="center">
                                <div class="adm-info-message-wrap" align="center">
                                    <div class="adm-info-message">
                                        <?=$option['note_top']; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                    <tr>
                        <td width="40%">
                            <label for="<?php echo $optionName ?>"<?php echo $hintTagAttr ?>>
                                <?php echo $option['title'] ?>
                            </label>:
                        </td>
                        <td colspan="2" width="60%">
                            <?php if (in_array($field['type'], ['text', 'number', 'checkbox'])) { ?>
                                <input <?php echo implode(' ', $params) ?>>
                                <?if($field['params']['color_picker'] == 'Y'):?>
                                <script type="text/javascript">
                                    function OnSelectBGColor(color, objColorPicker)
                                    {
                                        document.getElementById('main_color').value = color;
                                    }
                                </script>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.colorpicker",
                                    "",
                                    Array(
                                        "SHOW_BUTTON" => "Y",
                                        "ID" => "color_bg_picker",
                                        "NAME" => "Выбор цвета",
                                        "ONSELECT" => "OnSelectBGColor"
                                    ),
                                    $component, array("HIDE_ICONS" => "Y")
                                );?>
                                <?endif;?>
                            <?php } else if($field['type'] == 'html') {
                                CFileMan::AddHTMLEditorFrame(
                                    $optionName,
                                    $value,
                                    $optionName . "__TYPE",
                                    "html"
                                );
                            } ?>
                        </td>
                    </tr>
                    <?php if ($option['note_bottom']): ?>
                        <tr>
                            <td colspan="2" align="center">
                                <div class="adm-info-message-wrap" align="center">
                                    <div class="adm-info-message">
                                        <?=$option['note_bottom']; ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endif;?>
                <?php } else {
                    if (array_key_exists('fields', $option)) {
                        ?>
                        <tr>
                            <td>
                                <label for="<?php echo $optionName ?>"<?php echo $hintTagAttr ?>>
                                    <?php echo $option['title'] ?>
                                </label>:
                            </td>

                            <?
                            $fields = $option['fields'];
                            foreach ($fields as $field) {
                                ?>
                                <td class="adm-detail-content-cell-r"><?
                                    $value = Module::getDbOption($field['name']);
                                    $params = [
                                        'type="' . $field['type'] . '"',
                                        'id="' . $field['name'] . '"',
                                        'name="' . $field['name'] . '"',
                                    ];
                                    foreach ($field['params'] as $paramName => $paramValue) {
                                        $params[] = is_int($paramName) ? $paramValue : "{$paramName}=\"{$paramValue}\"";
                                    }
                                    $hintTagAttr = null;
                                    if (isset($option['hint'])) {
                                        $hintTagAttr = 'title="' . $option['hint'] . '"';
                                        $params[] = $hintTagAttr;
                                        $hintTagAttr .= ' ' . $hintTagAttr;
                                    }
                                    if (in_array($field['type'], ['text', 'number', 'checkbox', 'html'])) {
                                        if($field['type'] == 'html') {
                                            CFileMan::AddHTMLEditorFrame(
                                                $optionName,
                                                $value,
                                                $optionName . "__TYPE",
                                                "html"
                                            );
                                        }
                                        if ($field['type'] === 'checkbox' && $value) {
                                            $params[] = 'checked';
                                        }
                                        if (empty($value) && $field['type'] === 'checkbox') {
                                            $value = 1;
                                        }
                                        $params[] = 'value="' . $value . '"';
                                    }
                                    ?>
                                    <?php if (in_array($field['type'], ['text', 'number', 'checkbox'])) { ?>
                                        <input <?php echo implode(' ', $params) ?>>
                                        <?if($field['params']['color_picker'] == 'Y'):?>
                                        <script type="text/javascript">
                                            function OnSelectBGColor(color, objColorPicker)
                                            {
                                                document.getElementById('main_color').value = color;
                                            }
                                        </script>
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:main.colorpicker",
                                            "",
                                            Array(
                                                "SHOW_BUTTON" => "Y",
                                                "ID" => "color_bg_picker",
                                                "NAME" => "Выбор цвета",
                                                "ONSELECT" => "OnSelectBGColor"
                                            ),
                                            $component, array("HIDE_ICONS" => "Y")
                                        );?>
                                        <?endif;?>
                                    <?php } else if($field['type'] == 'html') {
                                        CFileMan::AddHTMLEditorFrame(
                                            $optionName,
                                            $value,
                                            $optionName . "__TYPE",
                                            "html"
                                        );
                                    } ?>
                                </td>
                                <?
                            }
                            ?>
                        </tr>
                        <?
                    }
                }
            }
        }
    }?>
    <?require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/admin/group_rights.php');
    $tabControl->Buttons();
    ?>
    <input type="submit"
           name="Update"<?php echo ($MOD_RIGHT < 'W') ? " disabled" : null ?>
           value="<?php echo Loc::getMessage('MAIN_SAVE') ?>"
           class="adm-btn-save">
    <input type="reset" name="reset" value="<? echo Loc::getMessage("MAIN_RESET") ?>">
    <input type="submit" <?php echo ($MOD_RIGHT < 'W') ? " disabled" : null ?>
           name="RestoreDefaults" title="<?echo Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS")?>"
           OnClick="return confirm('<?echo AddSlashes(Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING"))?>')"
           value="<?echo Loc::getMessage("HELLOWORLD_SCHEDULER_DEFAULTS")?>">
    <?php
    echo bitrix_sessid_post();
    $tabControl->End();
    ?>
</form>
<div class="adm-info-message-wrap">
    <div class="adm-info-message">
        <?php echo Loc::getMessage('HELLOWORLD_SCHEDULER_LINK_RECAPTCHA') ?>
    </div>
</div>

