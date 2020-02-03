<?php

namespace HelloWorld\Scheduler\HlBlocks;

use Bitrix\Main;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use HelloWorld\Scheduler\HelperManager;

Loc::loadMessages(__FILE__);

/**
 * Class DepartmentsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME string optional
 * </ul>
 *
 * @package Bitrix\Departments
 **/
class DepartmentsTable
{
    /**
     * @return bool|int|mixed
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function createHlDepartments()
    {
        $helper = self::getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
            'NAME' => 'Departments',
            'TABLE_NAME' => 'hl_departments',
            'LANG' =>
                array (
                    'ru' =>
                        array (
                            'NAME' => 'Отделения',
                        ),
                    'en' =>
                        array (
                            'NAME' => 'Departments',
                        ),
                ),
        ));
        $hlFieldId = $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_NAME',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'I',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array (
                    'SIZE' => 50,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 255,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Name',
                    'ru' => 'Название',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Name',
                    'ru' => 'Название',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Name',
                    'ru' => 'Название',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => '',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => '',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_SORT',
            'USER_TYPE_ID' => 'integer',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array (
                    'SIZE' => 20,
                    'MIN_VALUE' => 0,
                    'MAX_VALUE' => 0,
                    'DEFAULT_VALUE' => 500,
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Sort',
                    'ru' => 'Сортировка',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Sort',
                    'ru' => 'Сортировка',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Sort',
                    'ru' => 'Сортировка',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Sort',
                    'ru' => 'Сортировка',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Sort',
                    'ru' => 'Сортировка',
                ),
        ));

        $arReturnRef = [
            'HLBLOCK_ID' => $hlblockId,
            'HLFIELD_ID' =>$hlFieldId
        ];

        return $arReturnRef;
    }

    public static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}


//$MESS["DEPARTMENTS_ENTITY_ID_FIELD"] = "";
//$MESS["DEPARTMENTS_ENTITY_UF_NAME_FIELD"] = "";
