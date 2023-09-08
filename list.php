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
<body id="list_body">

    <?php 

        session_start();
        require_once 'config/config.php';
        require_once 'config/functions.php';
    
        if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
            redirection('index.php');
        }

    ?>

    <nav class="navbar navbar_index navbar-expand-lg">
        <div class="container-fluid container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 links">
                <li class="nav-item logo">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
            </ul>

            <ul class="navbar-nav buttons">

                <?php
                
                if (!isset($_SESSION['username']) OR !isset($_SESSION['id_user']) OR !is_int($_SESSION['id_user'])) {
                    echo '<li class="nav-item create_event_btn">';
                    echo '<a class="nav-link" href="./login.php">Create a list</a>';
                    echo '</li>';

                    echo '<li class="nav-item sign_up_btn">';
                    echo '<a class="nav-link" href="./sign_up.php">Sign Up</a>';
                    echo '</li>';

                    echo '<li class="nav-item log_in_btn">';
                    echo '<a class="nav-link" href="./login.php">Log in</a>';
                    echo '</li>';
                }

                else{
                    echo '<li class="nav-item create_event_btn">';
                    echo '<a class="nav-link" href="./list.php">Create a list</a>';
                    echo '</li>';
                    echo '<li>';
                    echo '<a class="nav-link" href="./view_lists.php">View lists</a>';
                    echo '</li>';
                    echo '<li>';
                    echo '<a class="nav-link" href="./profile.php">' . $_SESSION["username"] . '</a>';
                    echo '</li>';
                    echo '<li>';
                    echo '<a class="nav-link" href="./config/logout.php">Logout</a>';
                    echo '</li>';
                    echo '</ul>';
                }
                ?>


            </div>
        </div>
    </nav>

    <?php

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
    
    <main>

        <div class="create-a-list col-md-12">
            <div class="list col-12 col-sm-12 col-md-4">
                <h3 class="mt-3 mb-3">Create a list:</h3>

                <div class=" mb-3 form-group form-field">
                    <label for="list_name">List name:</label>
                    <input type="text" class="form-control" id="list_name" name="list_name" aria-describedby="List name">
                </div>

                <div class=" mb-3 form-group form-field">
                    <label for="purchase_day">Purchase day:</label>
                    <input type="date" class="form-control" id="purchase_day" name="purchase_day" aria-describedby="Purchase day">
                </div>

                <div class=" mb-3 form-group form-field">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description" aria-describedby="Description">
                </div>

                <div class="productsList">

                    <div class="productsInAList">
                        <table>
                            <tr class="product-list-header-items">
                                <th style="width: 35%">ID</th>
                                <th style="width: 40%">Product name</th>
                                <th>Remove</th>
                            </tr>
                            
                        </table>
                    </div>
                </div>  

                <span id="create-list" onclick="createList()" class="btn btn-primary mt-3 mb-3">Create list</span>

            </div>
            <div class="product col-12 col-sm-12 col-md-4">
                <h3 class="mt-3 mb-3">Add/Remove products:</h3>

                <div class="ajax-message">

                </div>

                <div class="product-list">
                    <table>
                    <tr class="product-list-header">
                        <th style="width: 20%">ID</th>
                        <th style="width: 40%">Product name</th>
                        <th>Add/Remove</th>
                    </tr>
                    <?php

                        $sql = "SELECT id_item, name FROM items";
                        $q = $pdo->query($sql);
                        $q -> setFetchMode(PDO::FETCH_ASSOC);

                        while($row = $q -> fetch()) {
                        ?>

                        <tr class="<?php echo ($row['id_item'])?>"><td><?php echo ($row['id_item'])?></td><td><?php echo mb_strimwidth($row['name'], 0, 15, "...");?></td><td><span id="<?php echo ($row['id_item'])?>" data-name="<?php echo $row['name'] ?>" class="product-add-to-list btn btn-success">Add</span></td><td><span id="<?php echo ($row['id_item'])?>" class="product-remove btn btn-danger">Remove</span></td></tr>

                    <?php } ?>
                    </table>
                </div>

                <span id="new-product-button" class="btn btn-primary mt-3 mb-3">New product</span>
                <div class="mb-3 form-group form-field add-product">
                    <label for="list_name">Name:</label>
                    <input type="text" class="form-control" id="list_name_input" name="list_name" aria-describedby="List name">
                    <span id="add-product-button" onclick="addProduct()" class="btn btn-primary mt-3 mb-3">Add</span>
                </div>
            </div>
        </div>
    </main>
    

    <footer class="">
        <div class="container">
            <div class="row"> 
            <div class="categories col-6 col-md-9">
                <p>Create your list © 2023</p>
            </div>

            <div class="social-medias col-6 col-md-3">
                <div class="icons">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1"><title>facebook</title><desc>Created with Sketch.</desc><defs></defs>                        <g id="HOME" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                            <g id="desktop-4" transform="translate(-354.000000, -6820.000000)" fill-rule="nonzero">                                <g id="Group-20" transform="translate(354.000000, 6820.000000)">                                    <g id="facebook-(2)-copy">                                        <circle id="Oval" fill="#3B5998" cx="17.8719292" cy="17.8719292" r="17.8719292"></circle>                                        <path d="M22.3649204,18.5715398 L19.1758938,18.5715398 L19.1758938,30.2546549 L14.3442478,30.2546549 L14.3442478,18.5715398 L12.0463009,18.5715398 L12.0463009,14.4656283 L14.3442478,14.4656283 L14.3442478,11.8086372 C14.3442478,9.90860177 15.2467965,6.93334513 19.2189027,6.93334513 L22.7978761,6.94831858 L22.7978761,10.9338053 L20.2010973,10.9338053 C19.7751504,10.9338053 19.1762124,11.1466195 19.1762124,12.0529912 L19.1762124,14.4694513 L22.7870442,14.4694513 L22.3649204,18.5715398 Z" id="Shape" fill="#FFFFFF"></path></g></g></g></g></svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36px" height="36px" viewBox="0 0 36 36" version="1.1"><title>instagram</title><desc>Created with Sketch.</desc><defs>                            <radialGradient cx="32.3472356%" cy="104.68545%" fx="32.3472356%" fy="104.68545%" r="107.688743%" id="radialGradient-1">                                <stop stop-color="#FFDD55" offset="0%"></stop>                                <stop stop-color="#FFDD55" offset="10%"></stop>                                <stop stop-color="#FF543E" offset="50%"></stop>                                <stop stop-color="#C837AB" offset="100%"></stop>                            </radialGradient>                            <radialGradient cx="8.87684907%" cy="-21.2893486%" fx="8.87684907%" fy="-21.2893486%" r="100.1536%" id="radialGradient-2">                                <stop stop-color="#3771C8" offset="0%"></stop>                                <stop stop-color="#3771C8" offset="12.8%"></stop>                                <stop stop-color="#6600FF" stop-opacity="0" offset="100%"></stop>                            </radialGradient>                        </defs>                        <g id="HOME" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">                            <g id="desktop-4" transform="translate(-455.000000, -6820.000000)" fill-rule="nonzero">                                <g id="Group-20" transform="translate(354.000000, 6820.000000)">                                    <g id="instagram" transform="translate(101.000000, 0.000000)">                                        <circle id="Oval" fill="url(#radialGradient-1)" cx="18" cy="18" r="18"></circle>                                        <circle id="Oval" fill="url(#radialGradient-2)" cx="18" cy="18" r="18"></circle>                                        <path d="M21.3561914,9.3 L14.4154687,9.3 C11.5947656,9.3 9.3,11.5947656 9.3,14.4154687 L9.3,21.3561914 C9.3,24.1767773 11.5947656,26.4717187 14.4155273,26.4717187 L21.35625,26.4717187 C24.1768359,26.4717187 26.4717773,24.1768945 26.4717773,21.3561914 L26.4717773,14.4154687 C26.4717187,11.5947656 24.1768945,9.3 21.3561914,9.3 Z M24.7442578,21.35625 C24.7442578,23.2273828 23.2273828,24.7442578 21.35625,24.7442578 L14.4155273,24.7442578 C12.5443945,24.7442578 11.0275195,23.2273828 11.0275195,21.35625 L11.0275195,14.4155273 C11.0275195,12.5443945 12.5443945,11.0274609 14.4155273,11.0274609 L21.35625,11.0274609 C23.2273828,11.0274609 24.7442578,12.5444531 24.7442578,14.4155273 L24.7442578,21.35625 Z M17.8858594,13.4445703 C15.4369922,13.4445703 13.4445703,15.4369922 13.4445703,17.8858594 C13.4445703,20.3345508 15.4369922,22.3269727 17.8858594,22.3269727 C20.3347266,22.3269727 22.3269727,20.3347266 22.3269727,17.8858594 C22.3269727,15.4369922 20.3347266,13.4445703 17.8858594,13.4445703 Z M17.8858594,20.5995117 C16.3870898,20.5995117 15.1720313,19.3846875 15.1720313,17.8858594 C15.1720313,16.3870313 16.3870898,15.1720313 17.8858594,15.1720313 C19.3846289,15.1720313 20.5995117,16.3869727 20.5995117,17.8858594 C20.5995117,19.3846289 19.3846289,20.5995117 17.8858594,20.5995117 Z M23.399707,13.4780859 C23.399707,12.8902148 22.9233398,12.4138477 22.3354688,12.4138477 C21.7477734,12.4138477 21.2712305,12.890332 21.2712305,13.4780859 C21.2712305,14.0657812 21.7477734,14.5423242 22.3354688,14.5423242 C22.9232227,14.5423242 23.399707,14.0657812 23.399707,13.4780859 Z" id="Combined-Shape" fill="#FFFFFF"></path></g></g></g></g></svg>
                </a>
                </div>
            </div>
            </div>
        </div>
    </footer>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/list.js"></script>

</html>