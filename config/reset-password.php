<?php
require_once 'functions.php';
require_once 'config.php';

$email = trim($_POST["email-forgot"]);
if (!empty($email) and getUserData($pdo, 'id_customer', 'email', $email)) {
    $token = createToken(20);
    if ($token) {
        setForgottenToken($pdo, $email, $token);
        $id_user = getUserData($pdo, 'id_customer', 'email', $email);
        try {
            $body = "<div style=\"background: grey; padding:15px; text-align:center; color: #fff; font-family: 'Oxygen', sans-serif; height: 100vh; display: flex;flex-direction:column;justify-content: center\">
                        <h1 style=\"padding-top:50px\">RESET YOUR PASSWORD</h1>
                        <p style=\"padding: 35px\">Click the button to begin!</p>
                            <div>
                                <a href=" . SITE . "config/forget.php?token=$token style=\"text-decoration:none; color: #fff;border: 1px solid #fff; padding: 5px;\">CHANGE</a>
                            </div>
                    </div>";
            sendEmail($pdo, $email, $emailMessages['forget'], $body);
            echo 'da';
            redirection('../sign_up.php?l=14');
        } catch (Exception $e) {
            error_log("****************************************");
            error_log($e->getMessage());
            error_log("file:" . $e->getFile() . " line:" . $e->getLine());
            redirection("../sign_up.php?l=11");
        }
    } else {
        redirection('../sign_up.php?l=14');
    }
} else {
    redirection('../sign_up.php?l=13');
}