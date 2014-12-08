<?php
require 'vendor/autoload.php';
include 'LoginHelper.php';

function sendMail() {
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe1') or die ('Error connecting to MySQL server');
    $query = "SELECT * FROM secret";
    $result = mysqli_query($dbc, $query) or die('Error querying');

    $row = $result->fetch_assoc();

    $mail = new PHPMailer;
    $mail->CharSet = "UTF-8";
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = $row['email'];
    $mail->Password = $row['password'];
    $mail->SMTPSecure = 'tls';
    $mail->From = $row['email'];
    $mail->FromName = $row['name'];
    $mail->Subject = 'Ankieta dostępności czasowej';
    $emailListName = $_POST['to_address'];


    $query = "SELECT email FROM mailing_lists WHERE mailing_list_name = '$emailListName'";
    $result = mysqli_query($dbc, $query) or die('Error querying');

    while ($row = $result->fetch_array()) {
        $mail->clearAddresses();
        $address = $row['email'];
        $mail->Body = getMessageBodyForEmail($address);
        $mail->addAddress($address);
        if (!$mail->send()) {
            echo "<h2> Message to $address could not be sent. Error: $mail->ErrorInfo";
        } else {
            echo "<h2>Message to $address has been successfully sent</h2>";
        }
    }

    mysqli_close($dbc);
}

function getMessageBodyForEmail($emailAddress) {
    $link = "http://localhost:8888/index.html?username=$emailAddress";
    return "Witaj, \n Zostałeś zaproszony do ankiety, aby wziąć w niej udział wejdź w link: $link";
}
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <title>Summary</title>
</head>
<body>

<div class="form" id="summary_div">
    <?php
    session_start();
    if (LoginHelper::isUserLogged() == 0) {
        echo LoginHelper::$USER_NOT_LOGGED;
        exit();
    }
    ?>
    <h1>Summary</h1>
    <?php
    sendMail();
    ?>
    <br/>
    <button class="cloud-button" onclick="location.href='mailComposer.php'">Back</button>
</div>

</body>
</html>

