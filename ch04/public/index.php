<?php
declare(strict_types=1);

/*
 *  Include necessary files 
 */
include_once __DIR__ . '/../sys/core/init.inc.php';

/*
 *  Load the calendar for january 
 */
$cal = new Calendar($dbo, "2016-01-01 12:00:00");

if (is_object($cal)) {
    echo "<pre>" . var_dump($cal) . "</pre>";
}

?>