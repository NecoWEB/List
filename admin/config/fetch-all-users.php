<?php
require_once '../../config/config.php';
try{
    $sql = "SELECT * FROM customer";
    $stmt = $pdo->prepare($sql);
    $stmt -> execute();
    $result = $stmt->fetchAll();
    exit(json_encode($result));
} catch (PDOException $e){
    throw new PDOException($e->getMessage());
}
