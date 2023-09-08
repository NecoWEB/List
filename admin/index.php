<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxygen:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Admin login</title>
</head>
<body class="admin-login">
<div class="position-absolute top-50 start-50 translate-middle">
    <?php
        require_once '../config/config.php';

        $errorMsg = '';

        if(isset($_GET['m']) && ($_GET['m'] == 18 || $_GET['m'] == 0)){
            $errorMsg = $messages[$_GET['m']];
            echo '<div class="alert alert-danger alert-dismissible" role="alert">';
                echo $errorMsg;
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        if(isset($_GET['m']) && $_GET['m'] == 5){
            $errorMsg = $messages[$_GET['m']];
            echo '<div class="alert alert-success alert-dismissible" role="alert">';
                echo $errorMsg;
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }

    ?>
    <form id="admin-login-form" action="config/validate-data.php" method="post">
        <h2 class="mb-3">Admin</h2>
        <div class="form-back">
            <div class="form-floating mb-3 ">
                <input type="text" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Username:</label>
            </div>
            <div class="form-floating mb-3 ">
                <input type="password" name="paswd" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password:</label>
            </div>
        </div>

        <input type="submit" value="Log In" class="btn btn-dark">
    </form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
