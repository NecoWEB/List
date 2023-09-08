<?php
require_once 'functions.php';

$errors = [];
$data = [];
$message = '';
$name = $_POST['name']; 
$id = 0;

if(empty($name)) {
    $errors[] = 'Name cannot be empty!';
}

if(strlen($name) < 3 || strlen($name) > 30) {
    $errors[] = 'Name must be at least 3 character long and cannot be longer then 30!';
}

if(empty($errors)) {
    if(!itemExist($pdo, $name)) {
        $id = addItem($pdo, $name);
        $message = 'The product has been successfully added!';
    } else {
        $errors[] = 'Product with this name already exists!';
    }
} 

$data = [
    'errors' => $errors,
    'message' => $message,
    'id' => $id
];

echo json_encode($data);
