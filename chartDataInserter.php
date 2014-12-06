<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');
    $points = $_POST['points'];
    $userName = $_POST['userName'];
    for ($i = 0; $i < count($points); $i++) {
        $xPointCoordinate = $i;
        $yPointCoordinate = $points[$i];

        $query = "SELECT x FROM points WHERE userName = '$userName' AND x = $xPointCoordinate";
        if (mysqli_num_rows(mysqli_query($dbc, $query)) != 0) {
            $query = "UPDATE points SET y = $yPointCoordinate WHERE userName = '$userName' AND x = $xPointCoordinate";
        } else {
            $query = "INSERT INTO points(userName, x, y) VALUES('$userName', $xPointCoordinate, $yPointCoordinate)";
        }
        mysqli_query($dbc, $query) or die("error querying");
    }
    mysqli_close($dbc);
?>