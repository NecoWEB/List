<?php

require_once 'functions.php';

if (isset($_POST['name'])) {
    $firstname = trim($_POST["name"]);
}

if (isset($_POST['email'])) {
    $email = trim($_POST["email"]);
}

if (isset($_POST['password'])) {
    $password = trim($_POST["password"]);
}

if (isset($_POST['confirm-password'])) {
    $passwordConfirm = trim($_POST["confirm-password"]);
}

if (empty($firstname)) {
    echo "/nemanja_kosanovic/sign_up.php?l=4";
    die();
}


if (empty($password)) {
    echo "/nemanja_kosanovic/sign_up.php?l=9";
    die();
}

if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
    echo "/nemanja_kosanovic/sign_up.php?l=10";
    die();
}

if (empty($passwordConfirm)) {
    echo "/nemanja_kosanovic/sign_up.php?l=9";
    die();
}

if ($password !== $passwordConfirm) {
    echo "/nemanja_kosanovic/sign_up.php?l=7";
    die();
}

if (empty($email) or !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "/nemanja_kosanovic/sign_up.php?l=8";
    die();
}

if (!existsUser($pdo, $email)) {
    $token = createToken(20);
    if ($token) {
        $id_user = registerUser($pdo, $password, $firstname,  $email, $token);
        try {
            $body = "<div style=\"background: grey; padding:15px; text-align:center; color: #fff; font-family: 'Oxygen', sans-serif; height: 100vh; display: flex;flex-direction:column;justify-content: center\">
                        <h1 style=\"padding-top:50px\">ACTIVATE YOUR ACCOUNT</h1>
                        <p style=\"padding: 35px\">Hi, your email is $email. <br>
                        Click the button to begin!</p>
                            <div>
                                <a href=" . SITE . "config/active.php?token=$token style=\"text-decoration:none; color: #fff;border: 1px solid #fff; padding: 5px;\">ACTIVATE</a>
                            </div>
                    </div>";
            sendEmail($pdo, $email, $emailMessages['register'], $body);
            echo "/nemanja_kosanovic/sign_up.php?l=3";
            die();
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            echo "/nemanja_kosanovic/index.php?l=11";
            die();
        }
    }
} else {
    echo "/nemanja_kosanovic/sign_up.php?l=2";
    die();
}
