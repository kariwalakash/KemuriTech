<?php

function findDates ($data, $lastTradedDate, $startDate, $endDate ) {
    $min = 0;
    $profit = 0;

    foreach ( $data as $index => $datum ) {
        if ( $datum['date'] < $lastTradedDate ) {
            continue;
        }

        if ($datum['date'] > $endDate) {
            break;
        }

        if ($data[ $index ]['price'] < $data[$min]['price'])
            $min = $index;
        else if ($data[$index]['price'] - $data[$min]['price'] > $profit) {
            $lowDate = $data[$min]['date'];
            $highDate = $data[$index]['date'];
            $profit = $data[$index]['price'] - $data[$min]['price'];
        }
    }

    if($lowDate < $startDate) {
        $lowDate = $startDate;
    }

    if ( $lowDate >= $highDate || $profit <= 0) {
        echo json_encode(['message' => 'do not purchase']);

        exit();
    }

    header('Content-type: application/json');
    echo json_encode(['buy' => date("Y-m-d",$lowDate), 'sell' => date("Y-m-d",$highDate)]);
}



