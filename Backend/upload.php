<?php

function readCSV ($path) {
    $csvAsArray = array_map('str_getcsv', file($path));

    $header = array_shift($csvAsArray);
    $csv    = array();
    foreach($csvAsArray as $row) {
        $csv[] = array_combine($header, $row);
    }

    if(sizeof($header) != 4 &&
        !in_array('id_no',$header) &&
        !in_array('date',$header) &&
        !in_array('stock_name',$header) &&
        !in_array('price',$header))
    {
        echo "Incorrect file entered, please Enter correct File";
        exit();
    }

//    echo json_encode($csv);

    $lowTime = $highTime = strtotime($csv[0]['date']);
    $shares = [];

    foreach ($csv as $index => $element) {
        $time = strtotime($element['date']);

        if ($time < $lowTime) {
            $lowTime = $time;
        }

        if ($time > $highTime) {
            $highTime = $time;
        }

        $shares[] = $element['stock_name'];

    }

    $data = array(
        'lowestDate' => date("Y-m-d",$lowTime),
        'highestDate' => date("Y-m-d",$highTime),
        'allShares' => array_values(array_flip(array_flip($shares))),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

function readCSVForOneShare ($path, $value) {
    $csvAsArray = array_map('str_getcsv', file($path));

    $header = array_shift($csvAsArray);
    $csv    = array();
    foreach($csvAsArray as $row) {
        if (in_array($value, $row))
            $csv[] = array_combine($header, $row);
    }

    if(sizeof($header) != 4 &&
        !in_array('id_no',$header) &&
        !in_array('date',$header) &&
        !in_array('stock_name',$header) &&
        !in_array('price',$header))
    {
        echo "Incorrect file entered, please Enter correct File";
        exit();
    }

//    echo json_encode($csv);



    $lowTime = $highTime = strtotime($csv[0]['date']);
    $shares = [];
    foreach ($csv as $index => $element) {
        $time = strtotime($element['date']);

        if ($time < $lowTime) {
            $lowTime = $time;
        }

        if ($time > $highTime) {
            $highTime = $time;
        }

        $shares[] = $element['stock_name'];

    }

    $data = array(
        'lowestDate' => date("Y-m-d",$lowTime),
        'highestDate' => date("Y-m-d",$highTime),
        'allShares' => array_values(array_flip(array_flip($shares))),
    );

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

function getCSVDetailsForOneShare ($path, $value) {
    $csvAsArray = array_map('str_getcsv', file($path));

    $header = array_shift($csvAsArray);
    $csv    = array();
    foreach($csvAsArray as $row) {
        if (in_array($value, $row))
            $csv[] = array_combine($header, $row);
    }

    if(sizeof($header) != 4 &&
        !in_array('id_no',$header) &&
        !in_array('date',$header) &&
        !in_array('stock_name',$header) &&
        !in_array('price',$header))
    {
        echo "Incorrect file entered, please Enter correct File";
        exit();
    }

    foreach ($csv as $index => $item) {
        $csv[$index]['date'] = strtotime($csv[$index]['date']);
    }

    return $csv;
}