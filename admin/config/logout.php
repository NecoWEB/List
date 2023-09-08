<?php
require_once '../../config/config.php';
require_once '../../config/functions.php';
session_start();

if(isset($_SESSION['admin-username']) && $_SESSION['admin-id']){
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    redirection("../index.php?m=5");
} else{
    redirection("../index.php?m=0");
}
