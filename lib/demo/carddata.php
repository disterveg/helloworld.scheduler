<?php

namespace HelloWorld\Scheduler\Demo;

use HelloWorld\Scheduler\HelperManager;

class CardData
{

    private static function demoData()
    {
        $data = [
            [
                'UF_DATE_TIME' => date('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 1,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => date('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'07:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'15:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'14:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'15:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'12:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'13:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'12:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'13:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'07:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'13:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'13:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 1,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+4 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+5 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 2,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+4 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+5 day')->format('d.m.Y').'12:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 2,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+1 day')->format('d.m.Y').'10:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 3,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+4 day')->format('d.m.Y').'12:00:00',
                'UF_DOCTOR' => 4,
                'UF_DEPARTMENT' => 3,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+5 day')->format('d.m.Y').'11:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+6 day')->format('d.m.Y').'12:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+7 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+7 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 1,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+2 day')->format('d.m.Y').'08:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
            [
                'UF_DATE_TIME' => (new \DateTime())->modify('+3 day')->format('d.m.Y').'09:00:00',
                'UF_DOCTOR' => 5,
                'UF_DEPARTMENT' => 4,
                'UF_RECORD' => 0,
                'UF_ACTIVE' => 1
            ],
        ];
        return $data;
    }

    /**
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function setCards()
    {
        $helper = self::getHelperManager();
        $cardsManager = $helper->Hlblock()->getDataManager('Cards');

        foreach (self::demoData() as $data) {
            $cardsManager::add(array(
                'UF_DATE_TIME' => $data['UF_DATE_TIME'],
                'UF_DOCTOR' => $data['UF_DOCTOR'],
                'UF_DEPARTMENT' => $data['UF_DEPARTMENT'],
                'UF_RECORD' => $data['UF_RECORD'],
                'UF_ACTIVE' => $data['UF_ACTIVE'],
            ));
        }
    }

    private static function getHelperManager()
    {
        return HelperManager::getInstance();
    }
}