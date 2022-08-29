<?php

function findDates ($data, $startDate, $endDate ) {
    $min = 0;
    $profit = 0;

    foreach ( $data as $index => $datum ) {
        if ( $datum['date'] < $startDate ) {
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

    if ( $lowDate >= $highDate ) {
        echo json_encode(['message' => 'do not purchase']);

        exit();
    }

    header('Content-type: application/json');
    echo json_encode(['buy' => date("Y-m-d",$lowDate), 'sell' => date("Y-m-d",$highDate)]);
}



