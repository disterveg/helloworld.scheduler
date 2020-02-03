<?php

namespace HelloWorld\Scheduler\Demo;

use HelloWorld\Scheduler\HelperManager;

class DoctorsData
{

    private static function demoData()
    {
        $data = [
            [
                'NAME' => 'Шатских Светлана Васильевна',
                'DEPARTMENT' => [
                    1
                ],
                'POST' => 'Главный врач',
                'QUALIFICATION' => 'Высшая категория'
            ],
            [
                'NAME' => 'Григорьева Виктория Владимировна',
                'DEPARTMENT' => [
                    1
                ],
                'POST' => 'Главный врач',
                'QUALIFICATION' => 'Высшая категория'
            ],
            [
                'NAME' => 'Владимирова Лена Георгьевна',
                'DEPARTMENT' => [
                    2,
                    3
                ],
                'POST' => 'Главный врач',
                'QUALIFICATION' => 'Высшая категория'
            ],
            [
                'NAME' => 'Васильева Людмила Георгьевна',
                'DEPARTMENT' => [
                    3
                ],
                'POST' => 'Главный врач',
                'QUALIFICATION' => 'Высшая категория'
            ],
            [
                'NAME' => 'Петрова Наталья Дмитриевна',
                'DEPARTMENT' => [
                    4
                ],
                'POST' => 'Главный врач',
                'QUALIFICATION' => 'Высшая категория'
            ],
        ];
        return $data;
    }

    /**
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function setDoctors()
    {
        $helper = self::getHelperManager();
        $cardsManager = $helper->Hlblock()->getDataManager('Doctors');

        foreach (self::demoData() as $data) {
            $cardsManager::add(array(
                'UF_NAME' => $data['NAME'],
                //'UF_DEPARTMENT' => $data['DEPARTMENT'],
                'UF_POST' => $data['POST'],
                'UF_QUALIFICATION' => $data['QUALIFICATION'],
            ));
        }
    }

    private static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}