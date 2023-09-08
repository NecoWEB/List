<?php
    session_start();
    require_once '../../config/config.php';


 if(isset($_GET['id_customer'])) {
         try{
             $sql = ("UPDATE customer SET banned = 1 WHERE id_customer = " . $_GET['id_customer'] . " AND banned = 0");
             $stmt = $pdo->prepare($sql);
             $stmt->execute();
             redirection("../admin.php?m=25");
         } catch (PDOException $e){
             echo 'Error: ' . $e->getMessage();
             throw new \PDOException($e->getMessage());
         }
         unset($_SESSION["id_customer"]);
     } else {
     redirection("../admin.php?m=26");
 }