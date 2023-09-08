<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require_once "config.php";

//function to register new user
function registerUser(PDO $pdo, string $password, string $firstname,  string $email, string $token): int
{

    $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO customer (email,password,firstname,email_conf_token,email_expire_token,active) 
                        VALUES (:email,:passwordHashed,:firstname,:token,DATE_ADD(now(),INTERVAL 1 DAY),0)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':passwordHashed', $passwordHashed, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->execute();

        return $pdo->lastInsertId();

    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

//function to check if user exists
function existsUser(PDO $pdo, string $email): bool
{
    try {
        $sql = "SELECT id_customer FROM customer WHERE email=:email AND (email_expire_token>now() OR active ='1') LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

//fucntion to create token for user
function createToken(int $length): ?string
{
    try {
        return bin2hex(random_bytes($length));
    } catch (\Exception $e) {
        // c:xampp/apache/logs/
        error_log("****************************************");
        error_log($e->getMessage());
        error_log("file:" . $e->getFile() . " line:" . $e->getLine());
        return null;
    }
}

//function to redirect user
function redirection($url)
{
    header("Location:$url");
    exit();
}

//function to connect to database
function connectDatabase(string $dsn, array $pdoOptions): PDO
{

    try {
        $pdo = new PDO($dsn, USER, PASSWORD , $pdoOptions);

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    return $pdo;
}

//function to send mail via mailtrap
function sendEmail(PDO $pdo, string $email, array $emailData, string $body): void
{

    $phpmailer = new PHPMailer(true);

    try {

        $phpmailer->isSMTP();
        $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '90aea4d6f86fab';
        $phpmailer->Password = '65ee769c562a73';

        $phpmailer->setFrom('webmaster@example.com', 'Webmaster');
        $phpmailer->addAddress("$email");

        $phpmailer->isHTML(true);
        $phpmailer->Subject = $emailData['subject'];
        $phpmailer->Body = $body;
        $phpmailer->AltBody = $emailData['altBody'];

        $phpmailer->send();

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
        $message = "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}";
    }

}

//function to check user data on log in list
function checkUserLogin(PDO $pdo, string $email, string $enteredPassword): array
{
    try {
        $sql = "SELECT id_customer, password, banned FROM customer WHERE email=:email AND active=1 LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        $data = [];
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $data['is_banned'] = $result['banned'];
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {

        $registeredPassword = $result['password'];

        if (password_verify($enteredPassword, $registeredPassword)) {
            $data['id_customer'] = $result['id_customer'];
        }
    }

    return $data;
}

// function to create the list
function createList(PDO $pdo, int $id_customer, string $name, string $purchase_day, string $description) {
    try {
        $sql = "INSERT INTO list (id_customer, name, purchase_day, description, date_created, status)
                VALUES (:id_customer,:name,:purchase_day,:description,NOW(), 'created')";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_customer', $id_customer, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':purchase_day', $purchase_day, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $success = $pdo->lastInsertId();
    } else {
        $success = false;
    }

    return $success;
}


// function to add item to the list
function addItemsToTheList(PDO $pdo,int $id_item, int $id_list)
{
    try {
        $sql = "INSERT INTO list_items (id_item, id_list)
                VALUES (:id_item,:id_list)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
        $stmt->bindParam(':id_item', $id_item, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $success = true;
    } else {
        $success = false;
    }

}

// function to create item
function addItem(PDO $pdo, string $name)
{
    $success = false;
    try {
        $sql = "INSERT INTO items (name)
                VALUES (:name)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        
        if ($stmt->execute())
        {
            $success = $pdo->lastInsertId();;
        } else {
            $success = false;
        }
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    return $success;

}

function itemExist(PDO $pdo, string $name) {
    try {
        $sql = "SELECT name FROM items WHERE name=:name LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->fetch(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

function removeItem(PDO $pdo, int $id) {
    $itemExistInAList = false;
    $success = false;
    try {
        $sql = "DELETE FROM items WHERE id_item=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute())
        {
            $success = true;
        } else {
            $success = false;
        }
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    return $success;
}

function removeListItems(PDO $pdo, int $id) {
    try {
        $sql = "DELETE FROM list_items WHERE id_list=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            removeList($pdo,$id);
        }
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function removeList(PDO $pdo, int $id) {
    $success = false;
    try {
        $sql = "DELETE FROM list WHERE id_list=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $success = false;
        }
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    return $success;
}

function checkIfItemExistInAlist(PDO $pdo, int $id_item) {

}

function getUser(PDO $pdo, string $email) {
    try {
        $sql = "SELECT id_customer FROM customer WHERE email=:email LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        return $result['id_customer'];
    } else {
        return false;
    }
}

// function to update item
function updateItem(PDO $pdo,int $id_item,int $id_list, string $name) : void
{
    try {
        $sql = "UPDATE list_items SET id_list= :id_list,  name= :name WHERE id_item = :id_item";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

function updateList(PDO $pdo,int $id_list) {
    try {
        $sql = "UPDATE list SET status='finished' WHERE id_list = :id_list";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_list', $id_list, PDO::PARAM_INT);
        $stmt->execute();
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}

//funtion that sends token on forgot-password event
function setForgottenToken(PDO $pdo, string $email, string $token): void
{
    try {
        $sql = "UPDATE customer SET pass_conf_token = :token, pass_expire_token = DATE_ADD(now(),INTERVAL 6 HOUR) WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }
}

//funtion that select user based on email address
function getUserData(PDO $pdo, string $data, string $field, string $value): string
{
    try {
        $sql = "SELECT $data as data FROM customer WHERE $field=:value LIMIT 0,1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':value', $value, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $data = '';
    }
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
        throw new \PDOException($e->getMessage());
    }

    if ($stmt->rowCount() > 0) {
        $data = $result['data'];
    }

    return $data;
}

function isRealDate($date) { 
    if (false === strtotime($date)) { 
        return false;
    } 
    list($year, $month, $day) = explode('-', $date); 
    return checkdate($month, $day, $year);
}



