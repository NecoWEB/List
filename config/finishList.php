<?php
session_start();
require_once 'functions.php';

$errors = [];
if(!isset($_POST['id_list'])) {
    echo "/nemanja_kosanovic/checkList.php?l=54";
    die();
}

$id_list = $_POST['id_list'];

updateList($pdo, $id_list);
echo "/nemanja_kosanovic/view_lists.php?l=55";
die();


// if(empty($errors)) {
//     if($id = createList($pdo, $id_user, $name, $date, $desc)) {
//         foreach($items as $product) {
//             addItemsToTheList($pdo, $product, $id);
//         }
//         echo "/nemanja_kosanovic/view_lists.php?l=47";
//         die();
//     }
// }






