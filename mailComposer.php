<?php
function __autoload($class_name) {
    include $class_name . '.php';
}

function createSelectOptions() {
    $dbc = mysqli_connect('localhost', 'root', 'root', 'ZaawansowaneTechnologieWebowe1') or die ('Error connecting to MySQL server');
    $query = 'SELECT DISTINCT mailing_list_name FROM mailing_lists';
    $result = mysqli_query($dbc, $query) or die('error querying');
    echo '<option disabled selected>Select mailing list</option>';
    while ($row = $result->fetch_array()) {
        $optionName = $row['mailing_list_name'];
        echo "<option>$optionName</option>";
    }
    mysqli_close($dbc);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="adminStyle.css">
    <title>Wysyłanie maila</title>
</head>
<body>
<div class="form" id="mail_div">
    <?php
    session_start();
    if (LoginHelper::isUserLogged() == 0) {
        echo LoginHelper::$USER_NOT_LOGGED;
        exit();
    }
    ?>
    <h1>Fill fields</h1>
    <form action="sender.php" method="post" enctype="multipart/form-data">

        <select name="to_address">
            <?php
            createSelectOptions();
            ?>
        </select><br/>

        <input type="submit" class="cloud-button" name="submit" value="Send mail"> <br/>
    </form>
</div>
</body>
</html>
