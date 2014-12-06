<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');
    $query = "SELECT userName FROM meetings";
    $result = mysqli_query($dbc, $query);

    $array = array();
    while ($data = mysqli_fetch_array($result)) {
        $array[] = $data['userName'];
    }
    echo json_encode($array);

    mysqli_close($dbc);
?>