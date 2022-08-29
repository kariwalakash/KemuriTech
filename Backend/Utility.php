<?php
function date_compare($element1, $element2) {
    $datetime1 = strtotime($element1['date']);
    $datetime2 = strtotime($element2['date']);
    return $datetime1 - $datetime2;
}

function findStartDate ($dateArr, $startDate) {
    $start = $dateArr[0];

    foreach ($dateArr as $date) {
        if ($date <= $startDate) {
            $start = $date;
        }
    }

    return $start;
}