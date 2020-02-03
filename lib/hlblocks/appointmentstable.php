<?php

namespace HelloWorld\Scheduler\HlBlocks;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\LoaderException;
use CDBResult;
use HelloWorld\Scheduler\HelperManager;

Loc::loadMessages(__FILE__);

/**
 * Class AppointmentsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_FIO string optional
 * <li> UF_DATE_CREATE datetime optional
 * <li> UF_ACTIVE int optional
 * <li> UF_YEAR string optional
 * <li> UF_EMAIL string optional
 * <li> UF_PHONE string optional
 * <li> UF_DOCS int optional
 * <li> UF_DEPARTMENT string optional
 * <li> UF_DOC_NAME string optional
 * <li> UF_TIME string optional
 * <li> UF_DATE string optional
 * <li> UF_CARD_ID int optional
 * <li> UF_MED_CARD int optional
 * </ul>
 *
 * @package Bitrix\Appointments
 **/

class AppointmentsTable
{
    /**
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function createHlAppointments (array $arRefField)
    {
        $helper = self::getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
            'NAME' => 'Appointments',
            'TABLE_NAME' => 'hl_appointments',
            'LANG' =>
                array (
                    'ru' =>
                        array (
                            'NAME' => 'Записи на прием',
                        ),
                    'en' =>
                        array (
                            'NAME' => 'Appointments',
                        ),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_FIO',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '10',
            'MULTIPLE' => 'N',
            'MANDATORY' => 'Y',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'ФИО',
                    'ru' => 'ФИО',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'ФИО',
                    'ru' => 'ФИО',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'ФИО',
                    'ru' => 'ФИО',
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
            'FIELD_NAME' => 'UF_EMAIL',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '20',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'E-mail',
                    'ru' => 'E-mail',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_YEAR',
            'USER_TYPE_ID' => 'date',
            'XML_ID' => '',
            'SORT' => '30',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Birthday',
                    'ru' => 'Дата рождения',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Birthday',
                    'ru' => 'Дата рождения',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Birthday',
                    'ru' => 'Дата рождения',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Birthday',
                    'ru' => 'Дата рождения',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Birthday',
                    'ru' => 'Дата рождения',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_PHONE',
            'USER_TYPE_ID' => 'string',
            'XML_ID' => '',
            'SORT' => '40',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Phone number',
                    'ru' => 'Номер телефона',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Phone number',
                    'ru' => 'Номер телефона',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Phone number',
                    'ru' => 'Номер телефона',
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
            'FIELD_NAME' => 'UF_DOCS',
            'USER_TYPE_ID' => 'enumeration',
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
                    'CAPTION_NO_VALUE' => '',
                    'SHOW_NO_VALUE' => 'Y',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Documents',
                    'ru' => 'Документы на прием',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Documents',
                    'ru' => 'Документы на прием',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Documents',
                    'ru' => 'Документы на прием',
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
            'ENUM_VALUES' =>
                array (
                    0 =>
                        array (
                            'VALUE' => 'Паспорт(свидетельство о рождении)',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => '2f390392315af0c51a6c179341d68b7c',
                        ),
                    1 =>
                        array (
                            'VALUE' => 'Распечатанный Талон-приглашение',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => '6f84ad51b35f89f1892155ac7f01d2c1',
                        ),
                    2 =>
                        array (
                            'VALUE' => 'В случае приёма в рамках ДМС – полис ДМС',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => '37f2d941c3490c4ae3d1eef99a3cfe4f',
                        ),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_MED_CARD',
            'USER_TYPE_ID' => 'enumeration',
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
                    'DISPLAY' => 'LIST',
                    'LIST_HEIGHT' => 5,
                    'CAPTION_NO_VALUE' => '',
                    'SHOW_NO_VALUE' => 'Y',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Med card',
                    'ru' => 'Медицинская карта',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Med card',
                    'ru' => 'Медицинская карта',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Med card',
                    'ru' => 'Медицинская карта',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Med card',
                    'ru' => 'Медицинская карта',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Med card',
                    'ru' => 'Медицинская карта',
                ),
            'ENUM_VALUES' =>
                array (
                    0 =>
                        array (
                            'VALUE' => 'Заводил карту в диспансере',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => '7f73dc192e5b362e33c45f849d7f38ac',
                        ),
                    1 =>
                        array (
                            'VALUE' => 'Не заводил карту в диспансере',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => 'ef613151fa8d03eddaed3513286bd087',
                        ),
                    2 =>
                        array (
                            'VALUE' => 'Не помню',
                            'DEF' => 'N',
                            'SORT' => '500',
                            'XML_ID' => '6b5fe6f2b8f9edc6d12fe207fce59042',
                        ),
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_DATE_CREATE',
            'USER_TYPE_ID' => 'datetime',
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
                    'DEFAULT_VALUE' =>
                        array (
                            'TYPE' => 'NONE',
                            'VALUE' => '',
                        ),
                    'USE_SECOND' => 'Y',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Date create',
                    'ru' => 'Дата создания',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Date create',
                    'ru' => 'Дата создания',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Date create',
                    'ru' => 'Дата создания',
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
            'FIELD_NAME' => 'UF_ACTIVE',
            'USER_TYPE_ID' => 'boolean',
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
                    'DEFAULT_VALUE' => 0,
                    'DISPLAY' => 'CHECKBOX',
                    'LABEL' =>
                        array (
                            0 => '',
                            1 => '',
                        ),
                    'LABEL_CHECKBOX' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Accept',
                    'ru' => 'Подтверждена',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Accept',
                    'ru' => 'Подтверждена',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Accept',
                    'ru' => 'Подтверждена',
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
            'FIELD_NAME' => 'UF_DEPARTMENT',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Вид приема',
                    'ru' => 'Вид приема',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Вид приема',
                    'ru' => 'Вид приема',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Вид приема',
                    'ru' => 'Вид приема',
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
            'FIELD_NAME' => 'UF_DOC_NAME',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Doc',
                    'ru' => 'Врач',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Doc',
                    'ru' => 'Врач',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Doc',
                    'ru' => 'Врач',
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
            'FIELD_NAME' => 'UF_TIME',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Time visit',
                    'ru' => 'Время приема',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Time visit',
                    'ru' => 'Время приема',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Time visit',
                    'ru' => 'Время приема',
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
            'FIELD_NAME' => 'UF_DATE',
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
                    'MAX_LENGTH' => 0,
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Date visit',
                    'ru' => 'Дата приема',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Date visit',
                    'ru' => 'Дата приема',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Date visit',
                    'ru' => 'Дата приема',
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
            'FIELD_NAME' => 'UF_CARD_ID',
            'USER_TYPE_ID' => 'hlblock',
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
                    'DISPLAY' => 'LIST',
                    'LIST_HEIGHT' => 5,
                    'HLBLOCK_ID' => $arRefField['HLBLOCK_ID'],
                    'HLFIELD_ID' => $arRefField['HLFIELD_ID'],
                    'DEFAULT_VALUE' => 0,
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Card ID',
                    'ru' => 'ID талона',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Card ID',
                    'ru' => 'ID талона',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Card ID',
                    'ru' => 'ID талона',
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
    }

    public static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}
