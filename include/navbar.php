<?php
function menu($active) {

  if(isset($_POST["logout"])){
    unset($_SESSION['user']);
    header("Refresh: 0");
    die();
  }

  if(!isset($_SESSION['user'])){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
             <li class="nav-item <?php if($active == "index"){ echo "active";}?>">
                <a class="nav-link" href="index.php">Kezdőlap</a>
             </li>
             <li class="nav-item <?php if($active == "recipe"){ echo "active";}?>">
                <a class="nav-link" href="#">Receptek</a>
             </li>
             <li class="nav-item <?php if($active == "registration"){ echo "active";}?>">
                <a class="nav-link" href="registration">Regisztráció</a>
            </li>
            <li class="nav-item <?php if($active == "login"){ echo "active";}?>">
                <a class="nav-link" href="login.php">Bejelentkezés</a>
            </li>
        </ul>
    </div>
</nav>
<?php
} else {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
             <li class="nav-item <?php //if($active == "index"){ echo "active";}?>">
                <a class="nav-link" href="index.php">Kezdőlap</a>
             </li>
             <li class="nav-item <?php //if($active == "recipe"){ echo "active";}?>">
                <a class="nav-link" href="#">Receptek</a>
             </li>
             <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <?php //echo $_SESSION['user']['name'];?>
               </a>
               <form class="dropdown-menu" method="post" aria-labelledby="navbarDropdown">
                 <a class="dropdown-item" href="#">Profil</a>
                 <a class="dropdown-item" href="#">Valami</a>
               <div class="dropdown-divider"></div>
                 <button type="submit" name="logout" class="dropdown-item">Kijelentkez</button>
               </form>
            </li>
        </ul>
    </div>
</nav>
<?php
  }
}
?>
