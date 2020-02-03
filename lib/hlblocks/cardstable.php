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
 * Class CardsTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> UF_DATE_TIME datetime optional
 * <li> UF_DOCTOR int optional
 * <li> UF_DEPARTMENT int optional
 * <li> UF_PATIENT string optional
 * <li> UF_RECORD int optional
 * <li> UF_SOFT_ID string optional
 * </ul>
 *
 * @package Bitrix\Cards
 **/
class CardsTable
{
    /**
     * @param array $hlIdDepartments
     * @param array $hlIdDoctors
     * @return array
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function createHlCards(array $hlIdDepartments, array $hlIdDoctors)
    {
        $helper = self::getHelperManager();
        $hlblockId = $helper->Hlblock()->saveHlblock(array (
            'NAME' => 'Cards',
            'TABLE_NAME' => 'hl_cards',
            'LANG' =>
                array (
                    'en' =>
                        array (
                            'NAME' => 'Cards',
                        ),
                    'ru' =>
                        array (
                            'NAME' => 'Талоны',
                        ),
                ),
        ));
        $hlFieldId = $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_DATE_TIME',
            'USER_TYPE_ID' => 'datetime',
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
                    'DEFAULT_VALUE' =>
                        array (
                            'TYPE' => 'FIXED',
                            'VALUE' => false,
                        ),
                    'USE_SECOND' => 'N',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Date and time of visit',
                    'ru' => 'Дата и время приема',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Date and time of visit',
                    'ru' => 'Дата и время приема',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Date and time of visit',
                    'ru' => 'Дата и время приема',
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
                    'DEFAULT_VALUE' => 1,
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
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_BOOKED',
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
                    'en' => 'Reservation',
                    'ru' => 'Зарезервирована',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Reservation',
                    'ru' => 'Зарезервирована',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Reservation',
                    'ru' => 'Зарезервирована',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Reservation',
                    'ru' => 'Зарезервирована',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Reservation',
                    'ru' => 'Зарезервирована',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_DATE_BOOKED',
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
                    'en' => 'Date reservation',
                    'ru' => 'Дата резервирования',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Date reservation',
                    'ru' => 'Дата резервирования',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Date reservation',
                    'ru' => 'Дата резервирования',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Date reservation',
                    'ru' => 'Дата резервирования',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Date booked',
                    'ru' => 'Дата резервирования',
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
                    'DEFAULT_VALUE' => 1,
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
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'Active',
                    'ru' => 'Активность',
                ),
        ));
        $helper->Hlblock()->saveField($hlblockId, array (
            'FIELD_NAME' => 'UF_DOCTOR',
            'USER_TYPE_ID' => 'hlblock',
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
                    'DISPLAY' => 'LIST',
                    'LIST_HEIGHT' => 5,
                    'HLBLOCK_ID' => $hlIdDoctors['HLBLOCK_ID'],
                    'HLFIELD_ID' => $hlIdDoctors['HLFIELD_ID'],
                    'DEFAULT_VALUE' => 0,
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Doctor',
                    'ru' => 'Врач',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Doctor',
                    'ru' => 'Врач',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Doctor',
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
            'FIELD_NAME' => 'UF_DEPARTMENT',
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
                    'HLBLOCK_ID' => $hlIdDepartments['HLBLOCK_ID'],
                    'HLFIELD_ID' => $hlIdDepartments['HLFIELD_ID'],
                    'DEFAULT_VALUE' => 0,
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => 'Отделение',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => 'Отделение',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Departments',
                    'ru' => 'Отделение',
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
            'FIELD_NAME' => 'UF_PATIENT',
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
                    'en' => 'Patient',
                    'ru' => 'Пациент',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Patient',
                    'ru' => 'Пациент',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Patient',
                    'ru' => 'Пациент',
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
            'FIELD_NAME' => 'UF_RECORD',
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
                    'en' => 'Patient record',
                    'ru' => 'Пациент записан',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'Patient record',
                    'ru' => 'Пациент записан',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'Patient record',
                    'ru' => 'Пациент записан',
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
            'FIELD_NAME' => 'UF_SOFT_ID',
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
                    'DEFAULT_VALUE' => '',
                ),
            'EDIT_FORM_LABEL' =>
                array (
                    'en' => 'External ID',
                    'ru' => 'Внешний ID',
                ),
            'LIST_COLUMN_LABEL' =>
                array (
                    'en' => 'External ID',
                    'ru' => 'Внешний ID',
                ),
            'LIST_FILTER_LABEL' =>
                array (
                    'en' => 'External ID',
                    'ru' => 'Внешний ID',
                ),
            'ERROR_MESSAGE' =>
                array (
                    'en' => 'External ID',
                    'ru' => 'Внешний ID',
                ),
            'HELP_MESSAGE' =>
                array (
                    'en' => 'External ID',
                    'ru' => 'Внешний ID',
                ),
        ));

        $arReturnRef = [
            'HLBLOCK_ID' => $hlblockId,
            'HLFIELD_ID' => $hlFieldId
        ];

        return $arReturnRef;
    }

    public static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}

/*$MESS["CARDS_ENTITY_ID_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_DATE_TIME_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_DOCTOR_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_DEPARTMENT_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_PATIENT_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_RECORD_FIELD"] = "";
$MESS["CARDS_ENTITY_UF_SOFT_ID_FIELD"] = "";*/
