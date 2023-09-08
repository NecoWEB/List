<?php
require_once 'functions.php';

$id = $_POST['id'];

if(is_numeric($id) && isset($id)) {
    removeListItems($pdo, $id);
}