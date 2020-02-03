<?php
/**
 * Created by PhpStorm.
 * User: radrigo
 * Date: 29.01.2020
 * Time: 13:38
 */

namespace HelloWorld\Scheduler;

use HelloWorld\Scheduler\HlBlocks\DepartmentsTable;
use HelloWorld\Scheduler\HlBlocks\DoctorsTable;
use HelloWorld\Scheduler\HlBlocks\CardsTable;
use HelloWorld\Scheduler\HlBlocks\AppointmentsTable;


class HlBlock
{
    function up() {
        $hlIdDepartments = DepartmentsTable::createHlDepartments();
        $hlIdDoctors = DoctorsTable::createHlDoctors($hlIdDepartments);
        $hlIdCards = CardsTable::createHlCards($hlIdDepartments, $hlIdDoctors);
        AppointmentsTable::createHlAppointments($hlIdCards);
    }
}