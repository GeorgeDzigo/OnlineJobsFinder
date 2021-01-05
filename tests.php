<?php

// $month = DateTime::createFromFormat('!m', date('m'))->format('F');
// echo $month;

$Date = "2010-09-17";
$d = 'date("Y")-date("m")-date("d")';
echo date("d", strtotime($Date));
exit;

// echo date('Y-m-d', strtotime($date. ' + 30 days')) . "<br>";
// echo date('Y-m-d', strtotime($Date. ' + 2 days'));
?>