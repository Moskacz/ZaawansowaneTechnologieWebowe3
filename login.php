<?php
    include 'LoginHelper.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe1') or die ('Error connecting to MySQL server');
    $query = "SELECT * FROM users WHERE username = '$username' AND password = SHA('$password')";

    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
    if (mysqli_num_rows($result) > 0) {
        LoginHelper::logUser();
        header('location:mailComposer.php');
    } else {
        header('location:login.html');
    }
    mysqli_close($dbc);
?>