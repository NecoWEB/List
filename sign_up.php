<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
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
            <div class="d-flex justify-content-center gap-2 form">
                <form action="./php/registration.php" method="post" class="signup_form" id="signup-form">
                    <div class="mb-3 form-group form-field ">
                        <label for="name">Name</label>
                        <input  type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Your name">
                        <small></small>
                    </div>
                    <div class="mb-3 form-group form-field">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email">
                        <small></small>
                    </div>
                    <div class="mb-3 form-group form-field">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your password">
                        <small></small>
                    </div>
                    <div class="mb-3 form-group form-field">
                        <label for="confirm-password">Confirm password</label>
                        <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
                        <small></small>
                    </div>
                
                    <div class="mb-3 sign_up">
                        <input type="submit" name="btnSubmit" class="btn btn-primary" />
                    </div>

                    <div class="mb-3 log_in">
                        <span>You have an account?</span>
                        <a href="login.php">Log in</a>
                    </div>

                </form>
            </div>
        </section>
    </main>

    <?php include_once("components/footer.php"); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/validateSignup.js"></script>
</body>
</html>