<?php 
include"connection.php";
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));
$Day = date('d',strtotime($timestamp));

$date = new DateTime('now');
$date->modify('last day of this month');
$d=$date->format('Y-m-d');

$d=date('Y-m-d', strtotime($d));
$lastdate=date_create($d);
$ldate= $lastdate->format('Y-m-d');
//echo $ldate;
//$lastdate=date('Y-m-d',strtotime($date));
$interval = date_diff(date_create($Date), date_create($ldate));
$d= $interval->format('%R%a');
$int = (int)$d;
echo $int;
?>