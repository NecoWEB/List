<?php

require_once './config.php';
session_start();

$user_email = '';
$user_password = '';
$data = [];

if(isset($_POST['email']) && isset($_POST['password'])){
    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $data = checkUserLogin($pdo, $user_email, $user_password);
}
else {
    echo "/nemanja_kosanovic/login.php?l=1";
    die();
}

if($data['is_banned'] === 1) {
    echo "/nemanja_kosanovic/login.php?l=23";
    die();
}
else {
    if($data and is_int($data['id_customer'])){
        $_SESSION['username'] = $user_email;
        $_SESSION['id_user'] = $data['id_customer'];
        echo "/nemanja_kosanovic/index.php";
        die();
    }
    else {
        echo "/nemanja_kosanovic/login.php?l=1";
        die();
    }
}