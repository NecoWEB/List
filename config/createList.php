<?php
session_start();
require_once 'functions.php';

$errors = [];
if(!isset($_POST['name']) || !isset($_POST['date']) || !isset($_POST['desc']) || empty($_POST['products']) || !isset($_POST['products'])) {
    echo "/nemanja_kosanovic/list.php?l=4";
    die();
}

$name = $_POST['name'];
$date = $_POST['date'];
$today = date("Y-m-d"); 
$desc = $_POST['desc'];
$items = $_POST['products'];
$message = '';
$data = [];

if(empty($name)) {
    echo "/nemanja_kosanovic/list.php?l=48";
    die();
}

if(strlen($name) < 3 || strlen($name) > 30) {
    echo "/nemanja_kosanovic/list.php?l=50";
    die();;
}

if(empty($desc)) {
    echo "/nemanja_kosanovic/list.php?l=49";
    die();
}

if(strlen($desc) < 5 || strlen($desc) > 50) {
    echo "/nemanja_kosanovic/list.php?l=51";
    die();
}

if (!isRealDate($date)) {
    echo "/nemanja_kosanovic/list.php?l=52";
    die();
}

if (strtotime($today) > strtotime($date)) {
    echo "/nemanja_kosanovic/list.php?l=53";
    die();
}

$id_user = getUser($pdo, $_SESSION['username']);

if(empty($errors)) {
    if($id = createList($pdo, $id_user, $name, $date, $desc)) {
        foreach($items as $product) {
            addItemsToTheList($pdo, $product, $id);
        }
        echo "/nemanja_kosanovic/view_lists.php?l=47";
        die();
    }
}






