<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');
    $query = "SELECT dateFrom, dateTo from dates";
    $result = mysqli_query($dbc, $query);
    $data = $result->fetch_assoc();
    $dateFrom = new DateTime($data['dateFrom']);
    $dateTo = new DateTime($data['dateTo']);
    $period = new DatePeriod($dateFrom, new DateInterval('P1D'), $dateTo);
    $array = iterator_to_array($period);

    $dates = [];
    for ($i = 0; $i < count($array); $i++) {
        $tmp = $array[$i];
        $dates[] = $tmp->format('m/d/Y');
    }
    echo json_encode($dates);
    mysqli_close($dbc);
?>