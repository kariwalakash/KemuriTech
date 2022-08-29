<?php

require_once "Backend/upload.php";
require_once "Backend/findDates.php";
require_once "Backend/Utility.php";

$filename = $_FILES['file']['name'];
//echo $filename;

$location = "upload/" . $filename;
move_uploaded_file($_FILES['file']['tmp_name'], $location);

if ( !isset($_POST['share']) ) {
    echo "invalid input";
} else if ( !isset($_POST['startDate']) ) {
    echo "invalid input";
} else if ( !isset($_POST['endDate']) ) {
    echo "invalid input";
}

$array = getCSVDetailsForOneShare($location, $_POST['share']);
$details = usort($array, 'date_compare');

$startDate = strtotime($_POST['startDate']);
$endDate = strtotime($_POST['endDate']);

$dates = array_column($array,'date');


$start = findStartDate($dates, $startDate);

findDates ($array, $start, $startDate, $endDate);

