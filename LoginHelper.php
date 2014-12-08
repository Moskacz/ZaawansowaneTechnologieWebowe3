<?php

class LoginHelper {

    public static $USER_NOT_LOGGED = 'You do not have access to see this page. Log in first';

    public static  function isUserLogged() {
        session_start();
        if ($_SESSION['logged'] != 1) {
            return 0;
        }
        return 1;
    }

    public static function logUser() {
        session_start();
        $_SESSION['logged'] = 1;
    }
}

?>