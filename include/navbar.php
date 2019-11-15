<?php
function menu($active) {
    if (isset($_POST["logout"])) {
        unset($_SESSION['user']);
        setcookie("userid", "", time() - 1, "/", "barha.herokuapp.com", 1, 1);
        header("Refresh: 0");
        die();
    }

    if (isset($_POST["hu"]) && !isset($_SESSION['user']['name'])) {
        $_SESSION['lang'] = "hu";
        header("Refresh: 0");
        die();
    }
    if (isset($_POST["en"]) && !isset($_SESSION['user']['name'])) {
        $_SESSION['lang'] = "en";
        header("Refresh: 0");
        die();
    }

    if (!isset($_SESSION['user'])) {
        ?>
        <nav class="navbar navbar-expand-md navbar-light bg-light sticky-top" aria-label="navbar">
            <a class="navbar-brand" href="/" aria-label="<?= _HOMEPAGE ?>">
                <img src="/images/android-chrome-192x192.png" width="30" height="30" class="d-inline-block align-top" alt="<?= _BARHA ?>">
                <span class="name"><?= _BARHA ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if ($active == "index") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/"><?= _HOMEPAGE ?></a>
                    </li>
                    <li class="nav-item <?php if ($active == "recipes") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/recipes?search="><?= _RECIPES ?></a>
                    </li>
                    <li class="nav-item <?php if ($active == "registration") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/registration"><?= _REGISTER ?></a>
                    </li>
                    <li class="nav-item <?php if ($active == "login") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/login"><?= _LOGIN ?></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-language" aria-hidden="true"></i><?= _LANGUAGE ?>
                        </a>
                        <form class="dropdown-menu profile-menu dropdown-menu-right" method="post" aria-labelledby="navbarDropdown">
                            <button type="submit" name="hu" class="dropdown-item"><?= _HU ?></button>
                            <button type="submit" name="en" class="dropdown-item"><?= _EN ?></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    } else {
        ?>
        <nav class="navbar navbar-expand-sm navbar-light bg-light sticky-top shadow-sm" aria-label="navbar">
            <a class="navbar-brand" href="/" aria-label="<?= _HOMEPAGE ?>">
                <img src="/images/android-chrome-192x192.png" width="30" height="30" class="d-inline-block align-top" alt="<?= _BARHA ?>">
                <span class="name"><?= _BARHA ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div id="navbarNavDropdown" class="navbar-collapse collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?php if ($active == "index") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/"><?= _HOMEPAGE ?></a>
                    </li>
                    <li class="nav-item <?php if ($active == "recipes") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="/recipes?search="><?= _RECIPES ?></a>
                    </li>
                    <li class="nav-item <?php if ($active == "recipe-upload") {
                        echo "active";
                    } ?>">
                        <a class="nav-link" href="#"></a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['user']['name']; ?>
                        </a>
                        <form class="dropdown-menu profile-menu dropdown-menu-right" method="post" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="profile"><span aria-hidden="true" class="fa fa-user-o fa-fw"></span><?= _PROFILE ?></a>
                            <a class="dropdown-item" href="/favourite"><span aria-hidden="true" class="fa fa-heart-o fa-fw"></span><?= _FAVOURITES ?></a>
                            <a class="dropdown-item" href="/upload_recipe"><span aria-hidden="true" class="fa fa-upload fa-fw"></span><?= _UPLOAD_RECIPE ?></a>
                            <a class="dropdown-item" href="/myRecipes"><span aria-hidden="true" class="fa fa-pencil-square-o fa-fw"></span><?= _EDIT_RECIPES ?></a>
                            <?php
                            if ($_SESSION['user']['permission'] == 'admin') {
                                echo "<div class=\"dropdown-divider\"></div><a class=\"dropdown-item\" href=\"/admin\"><span aria-hidden=\"true\" class=\"fa fa-lock fa-fw\"></span>Admin</a>";
                            } ?>
                            <div class="dropdown-divider"></div>
                            <button type="submit" name="logout" class="dropdown-item"><span aria-hidden="true" class="fa fa-sign-out fa-fw"></span><?= _LOGOUT ?></button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    }
}

?>
