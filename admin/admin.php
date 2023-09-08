<?php
    session_start();

    $username = '';
    $sessionID = '';

    if(isset($_SESSION['admin-username']) && $_SESSION['admin-id']){
        $username = $_SESSION['admin-username'];
        $sessionID = $_SESSION['admin-id'];
    } else{
        header("Location: index.php?m=0");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lists</title>
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
</head>
<body id="admin_body">

    <div class="logout">
        <a href="./config/logout.php" type="button" class="btn btn-danger">Logout</a>
    </div>
    

    <?php
        require_once '../config/config.php';

        $redirectionMessage = '';
        if(isset($_GET['m'])){
            $redirectionMessage = $messages[$_GET['m']];
            if($_GET['m'] == 26 || $_GET['m'] == 36 || $_GET['m'] == 37){
                echo '<div class="alert alert-danger alert-dismissible fade show my-3 mx-auto" style="width: 600px;" role="alert">';
            }
            else{
                echo '<div class="alert alert-success alert-dismissible fade show my-3 mx-auto" style="width: 600px;" role="alert">';
            }
            echo $redirectionMessage;
            echo '</div>';


            if(isset($_SESSION['errors']) && $_GET['m'] == 36){
                echo '<div class="py-3 px-3"><h2>Update form errors: </h2></div>';
                echo '<div class="alert alert-danger my-5  mx-auto" style="width: 600px;" role="alert">';
                echo '<h4 class="alert-heading">Check following</h4>';
                echo '<hr>';
                foreach ($_SESSION['errors'] as $key => $value){
                    echo $value . '<br/>';
                }
                echo '</div>';
            }

        }
    ?>

    <section class="form-errors">
        <?php
            require_once '../config/config.php';


        ?>
    </section>

    <!-- <header>
        <img src="./img/making-list.jpg" alt="background">
    </header> -->
    <main>
        <div class="users">
            
        </div>
    </main>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script/fetchAllUsers.js"></script>

<script>
    fetchUsers();
</script>

</html>