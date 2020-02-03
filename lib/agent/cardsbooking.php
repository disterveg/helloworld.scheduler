<?php

namespace HelloWorld\Scheduler\Agent;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use CEventLog;
use DateTime;
use HelloWorld\Scheduler\Helpers\HlblockHelper;

class CardsBooking
{
    const TIME_BOOKED = '10';

    /**
     * @return string
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    public static function CheckBookingCards()
    {
        $helper = self::getHelper();
        $timeUnbooked = new DateTime();
        $timeUnbooked->modify('+ ' . self::TIME_BOOKED . ' minutes');
        $timeUnbooked->format("d.m.Y H:i:s");
        $result = $helper->getElements(
            'Cards',
            array(
                'select' => [
                    'ID'
                ],
                'order' => [
                    'UF_DATE_TIME' => 'ASC'
                ],
                'filter' => [
                    'UF_BOOKED' => '1',
                    '>UF_DATE_BOOKED' => new \Bitrix\Main\Type\DateTime($timeUnbooked)
                ]
            )
        );
        $cards = [];
        while ($arRow = $result->Fetch()) {
            $cards[] = $arRow;
            $helper->updateElement(
                'Cards',
                $arRow['ID'],
                [
                    'UF_BOOKED' => '0',
                    'UF_DATE_BOOKED' => ''
                ]
            );
        }

        return "HelloWorld\Scheduler\Agent\CardsBooking::CheckBookingCards();";
    }

    /**
     * @return HlblockHelper
     * @throws \HelloWorld\Scheduler\Exceptions\HelperException
     */
    private static function getHelper()
    {
        return new HlblockHelper();
    }
}