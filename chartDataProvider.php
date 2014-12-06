<?php
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe3');
    $username = $_POST['userName'];
    $query = "SELECT y FROM points WHERE userName = '$username'";
    $result = mysqli_query($dbc, $query);

    $array = array();
    while ($data = mysqli_fetch_array($result)) {
        $array[] = $data['y'];
    }
    echo json_encode($array);

    mysqli_close($dbc);
?>