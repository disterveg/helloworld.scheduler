<?php

namespace HelloWorld\Scheduler\Demo;

use HelloWorld\Scheduler\HelperManager;

class DepartmentsData
{

    private static function demoData()
    {
        $data = [
            [
                'NAME' => 'Педиатрия',
                'SORT' => 500
            ],
            [
                'NAME' => 'Кардиология',
                'SORT' => 500
            ],
            [
                'NAME' => 'Терапия',
                'SORT' => 500
            ],
            [
                'NAME' => 'Хирургия',
                'SORT' => 500
            ],
        ];
        return $data;
    }

    /**
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function setDepartments()
    {
        $helper = self::getHelperManager();
        $cardsManager = $helper->Hlblock()->getDataManager('Departments');

        foreach (self::demoData() as $data) {
            $cardsManager::add(array(
                'UF_NAME' => $data['NAME'],
                'UF_SORT' => $data['SORT'],
            ));
        }
    }

    private static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}