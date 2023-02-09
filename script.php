<?php

require 'vendor/autoload.php';

use Carbon\Carbon;
use Carbon\CarbonPeriod;

$csvArray = array_map('str_getcsv', file('demoData.csv'));

$quinquenniums = [
    ["01/01/1985","12/31/1989"],
    ["01/01/1990","12/31/1994"], 
    ["01/01/1995","12/31/1999"],
    ["01/01/2000","12/31/2004"],
    ["01/01/2005","12/31/2009"],
    ["01/01/2010","12/31/2014"],
    ["01/01/2015","12/31/2019"],
    ["01/01/2020","12/31/2021"]
];

$allQuinquenniumDates = [];

foreach ($quinquenniums as $quinquennium) {

    $start = new Carbon($quinquennium[0]);
    $end = new Carbon($quinquennium[1]);

    $allQuinquenniumDates[] = calculateQuinquenniumDates($start, $end); 

}

$arrayOfResults = [];

foreach ($csvArray as $key => $arr) {

    $start_date = new Carbon($arr[1]);
    $end_date = new Carbon($arr[2]);
    $allDates = calculateDiagnosisDates($start_date, $end_date);
    $matches = [];
    array_unshift($matches, $arr[0], $arr[1], $arr[2]);

    foreach ($allQuinquenniumDates as $dates) {

        $matches[] = sizeof(array_intersect($allDates, $dates));

    }

    $arrayOfResults[] = $matches;

}

$fp = fopen('outputData.csv', 'w');
  
foreach ($arrayOfResults as $results) {
    fputcsv($fp, $results);
}
  
fclose($fp);


function calculateQuinquenniumDates ($start_date, $end_date) {

    $allDates = [];

    $datesOfDiagnosis = CarbonPeriod::create($start_date, $end_date);

    foreach ($datesOfDiagnosis as $date) {
        $allDates[] = $date->format('d/m/Y');
    }

    return $allDates;

}

function calculateDiagnosisDates ($start_date, $end_date) {

    $allDates = [];

    $datesOfDiagnosis = CarbonPeriod::create($start_date, $end_date);

    foreach ($datesOfDiagnosis as $date) {
        $allDates[] = $date->format('d/m/Y');
    }

    array_pop($allDates);

    return $allDates;

}