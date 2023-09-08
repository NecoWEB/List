<nav class="navbar navbar_index navbar-expand-lg position-absolute top-0 w-100">
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
                session_start();
                require_once 'config/config.php';
                require_once 'config/functions.php';
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