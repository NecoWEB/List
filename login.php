<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    
</head>
<body id="login_body">

    <?php include_once("components/header.php"); ?>

    <main>
        <section class="login container">
            <div>
                <?php
                require_once './config/config.php';

                $l = 0;

                if (isset($_GET["l"]) and is_numeric($_GET['l'])) {
                    $l = (int)$_GET["l"];

                    if (array_key_exists($l, $messages)) {
                        echo '
                    <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
                        ' . $messages[$l] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        </button>
                    </div>
                    ';
                    }
                }
                ?>
            </div>
            <div class="d-flex justify-content-center gap-2">
            
                <form id="login-form" action="config/login_data.php" method="post">

                    <div class="mb-3 form-field">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
                        <small></small>
                    </div>
                    <div class="mb-3 form-field">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" autocomplete="off">
                        <small></small>
                    </div>
                    <div class="login-actions form-field">
                        <button type="submit" class="btn btn-primary">Log In</button>
                        <span id="forgot-password">Forgot password?</span>
                        <p>Don't have an account? <a href="./sign_up.php">Sign up</a></p>
                    </div>
                </form>


            <div class="form" id="forgot_password_form">

                <form action="config/reset-password.php" method="post" id="forget-form">

                    <button type="button" class="btn btn-danger mb-3 go-back"><- Login</button>

                    <div class="form-group form-field mb-3">
                        <label for="email-forgot">Email</label>
                        <input type="email" class="form-control" id="email-forgot" name="email-forgot" aria-describedby="emailHelp" placeholder="Your email">
                        <small></small>
                    </div>

                    <button type="submit" class="btn btn-primary">Reset password</button>
                </form>
            </div>
            </div>
        </section>
    </main>

    <?php include_once("components/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/validateLogin.js"></script>
    <script src="js/forgotPass.js"></script>
</body>
</html>