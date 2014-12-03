<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');
    $points = $_POST['points'];
    for ($i = 0; $i < count($points); $i++) {
        $xPointCoordinate = $i;
        $yPointCoordinate = $points[$i];
        $query = "INSERT INTO points (userName, x, y) VALUES('test', $xPointCoordinate, $yPointCoordinate) ON DUPLICATE KEY UPDATE userName=VALUES(userName), x=VALUES(x), y=VALUES(y)";
        mysqli_query($dbc, $query) or die("error querying");
    }
    mysqli_close($dbc);
?>