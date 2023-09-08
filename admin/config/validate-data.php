<?php
session_start();
require_once '../../config/config.php';
$adminUsername = '';
$adminPassword = '';
$dbUsername = '';
$dbPassword = '';

if(isset($_POST['email']) && isset($_POST['paswd'])){
    $adminUsername = $_POST['email'];
    $adminPassword = $_POST['paswd'];

    try{
        $sql = "SELECT * FROM admin";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_BOTH);
        $dbUsername = $result['email'];
        $dbPassword = $result['password'];
        $dbID = $result['id_admin'];

    }catch (PDOException $e){
        var_dump($e->getCode());
        throw new PDOException($e->getMessage());
    }


    if(($adminPassword === $dbPassword) && ($adminUsername === $dbUsername)){
        $_SESSION['admin-username'] = $adminUsername;
        $_SESSION['admin-id'] = $dbID;
        redirection('../admin.php');
    } else{
        session_destroy();
        redirection('../index.php?m=18');
    }
}


