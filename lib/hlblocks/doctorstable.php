<?php

namespace HelloWorld\Scheduler\HlBlocks;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main;
use HelloWorld\Scheduler\HelperManager;

Loc::loadMessages(__FILE__);

/**
 * Class DoctorsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_NAME string optional
 * <li> UF_DEPARTMENT string optional
 * <li> UF_IMG int optional
 * <li> UF_POST string optional
 * <li> UF_QUALIFICATION string optional
 * </ul>
 *
 * @package Bitrix\Doctors
 **/

class DoctorsTable
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'hl_docs';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return array(
            'ID' => array(
                'data_type' => 'integer',
                'primary' => true,
                'autocomplete' => true,
                'title' => Loc::getMessage('DOCTORS_ENTITY_ID_FIELD'),
            ),
            'UF_NAME' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
            ),
            'UF_DEPARTMENT' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
            ),
            'UF_IMG' => array(
                'data_type' => 'integer',
                'title' => Loc::getMessage('DOCTORS_ENTITY_UF_IMG_FIELD'),
            ),
            'UF_POST' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
            ),
            'UF_QUALIFICATION' => array(
                'data_type' => 'text',
                'title' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
            ),
        );
    }

    /**
     * @param array $arRefField
     * @return array
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function createHlDoctors (array $arRefField)
    {
        $helper = self::getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
            'NAME' => 'Doctors',
            'TABLE_NAME' => 'hl_doctors',
            'LANG' =>
                array (
                    'ru' =>
                        array (
                            'NAME' => 'Врачи',
                        ),
                    'en' =>
                        array (
                            'NAME' => 'Doctors',
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
                    'en' => 'Full name',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Full name',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Full name',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_NAME_FIELD'),
                ),
        ));
        /*$helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_DEPARTMENT',
            'USER_TYPE_ID' => 'hlblock',
            'XML_ID' => '',
            'SORT' => '100',
            'MULTIPLE' => 'Y',
            'MANDATORY' => 'N',
            'SHOW_FILTER' => 'N',
            'SHOW_IN_LIST' => 'Y',
            'EDIT_IN_LIST' => 'Y',
            'IS_SEARCHABLE' => 'N',
            'SETTINGS' =>
                array (
                    'DISPLAY' => 'LIST',
                    'LIST_HEIGHT' => 5,
                    'HLBLOCK_ID' => $arRefField['HLBLOCK_ID'],
                    'HLFIELD_ID' => $arRefField['HLFIELD_ID'],
                    'DEFAULT_VALUE' => 0,
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_DEPARTMENT_FIELD'),
                ),
        ));*/
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_IMG',
            'USER_TYPE_ID' => 'file',
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
                    'LIST_WIDTH' => 200,
                    'LIST_HEIGHT' => 200,
                    'MAX_SHOW_SIZE' => 0,
                    'MAX_ALLOWED_SIZE' => 0,
                    'EXTENSIONS' =>
                        array (
                            'jpg' => true,
                            'png' => true,
                        ),
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Photo',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_IMG_FIELD'),
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Photo',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_IMG_FIELD'),
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Photo',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_IMG_FIELD'),
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_IMG_FIELD'),
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_POST',
            'USER_TYPE_ID' => 'string',
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
                    'SIZE' => 50,
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 255,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Post',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Post',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Post',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_POST_FIELD'),
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => '',
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_QUALIFICATION',
            'USER_TYPE_ID' => 'string',
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
                    'ROWS' => 1,
                    'REGEXP' => '',
                    'MIN_LENGTH' => 0,
                    'MAX_LENGTH' => 255,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
                ),
            'ERROR_MESSAGE' =>
                array (
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
                ),
            'HELP_MESSAGE' =>
                array (
                    'ru' => Loc::getMessage('DOCTORS_ENTITY_UF_QUALIFICATION_FIELD'),
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
