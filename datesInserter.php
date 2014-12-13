<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');

    $date_from = $_POST['from'];
    $date_to = $_POST['to'];

    if ($date_from && $date_to) {
        $deleteQuery = "TRUNCATE TABLE dates";
        mysqli_query($dbc, $deleteQuery);
        $insertQuery = "INSERT INTO dates(dateFrom, dateTo) VALUES (STR_TO_DATE('$date_from', '%m/%d/%Y'), STR_TO_DATE('$date_to', '%m/%d/%Y'))";
        mysqli_query($dbc, $insertQuery);
    }

    mysqli_close($dbc);
?>