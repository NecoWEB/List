<?php
require_once "config.php";
require_once "functions.php";
// https://www.php.net/manual/en/reserved.variables.request

if (isset($_GET['token'])) {
    $token = trim($_GET['token']);
}

if (isset($_POST['token'])) {
    $token = trim($_POST['token']);
}


$method = strtolower(filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_ENCODED));

switch ($method) {
    case "get":
        if (!empty($token) and strlen($token) === 40) {

            $sql = "SELECT id_customer FROM customer 
            WHERE binary pass_conf_token = :token AND pass_expire_token>now() AND active= 1";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                include_once "reset_form.php";
            } else {
                redirection('reset_form.php?rf=15');
            }
        } else {
            redirection('reset_form.php?rf=0');
        }
        break;

    case "post":
        if (!empty($token) and strlen($token) === 40) {


            if (isset($_POST['reset-email'])) {
                $resetEmail = trim($_POST["reset-email"]);
            }

            if (isset($_POST['new-password'])) {
                $resetPassword = trim($_POST["new-password"]);
            }

            if (isset($_POST['repeat-new-password'])) {
                $resetPasswordConfirm = trim($_POST["repeat-new-password"]);
            }

            if (empty($resetEmail)) {
                redirection('reset_form.php?rf=8&token='. $token);
            }

            if (empty($resetPassword)) {
                redirection('reset_form.php?rf=9&token='. $token);
            }

            if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $resetPassword)) {
                redirection('reset_form.php?rf=10&token='. $token);
            }

            if (empty($resetPasswordConfirm)) {
                redirection('reset_form.php?rf=9&token='. $token);
            }

            if ($resetPassword !== $resetPasswordConfirm) {
                redirection('reset_form.php?rf=7&token='. $token);
            }

            $passwordHashed = password_hash($resetPassword, PASSWORD_DEFAULT);


            $sql = "UPDATE customer SET pass_conf_token = '', pass_expire_token = null, password = :resetPassword
            WHERE binary pass_conf_token = :token AND pass_expire_token>now() AND active = 1 AND email = :email";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':resetPassword', $passwordHashed, PDO::PARAM_STR);
            $stmt->bindParam(':token', $token, PDO::PARAM_STR);
            $stmt->bindParam(':email', $resetEmail, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                redirection('../login.php?l=15');

            } else {
                redirection('reset_form.php?rf=16&token='.$token);
            }
        } else {
            redirection('reset_form.php?rf=0');

        }
        break;
}


