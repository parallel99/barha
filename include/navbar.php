<?php
function menu($active) {
if(!isset($_SESSION['user'])){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src="\images\navbar-logo.png" height="30"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
             <li class="nav-item <?php if($active == "index"){ echo "active";}?>">
                <a class="nav-link" href="/">Kezdőlap</a>
             </li>
             <li class="nav-item <?php if($active == "recipes"){ echo "active";}?>">
                <a class="nav-link" href="recipes">Receptek</a>
             </li>
             <li class="nav-item <?php if($active == "registration"){ echo "active";}?>">
                <a class="nav-link" href="registration">Regisztráció</a>
            </li>
            <li class="nav-item <?php if($active == "login"){ echo "active";}?>">
                <a class="nav-link" href="login">Bejelentkezés</a>
            </li>
        </ul>
    </div>
</nav>
<?php
} else {
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/"><img src="\images\navbar-logo.png" height="30"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if($active == "index"){ echo "active";}?>">
             <a class="nav-link" href="/">Kezdőlap</a>
          </li>
          <li class="nav-item <?php if($active == "recipes"){ echo "active";}?>">
             <a class="nav-link" href="recipes">Receptek</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Receptek kezelése
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="upload_recipe">Recept feltöltés</a>
              <a class="dropdown-item" href="#">Feltöltött recepteim</a>
              <a class="dropdown-item" href="#">Kedvenceim</a>
            </div>
          </li>
          <li class="nav-item <?php if($active == "recipe-upload"){ echo "active";}?>">
             <a class="nav-link" href="#"></a>
          </li>
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['user']['name'];?>
            </a>
            <form class="dropdown-menu profile-menu" method="post" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="profile"><span class="fa fa-user-o"></span>Profil</a>
              <a class="dropdown-item" href="#"><span class="fa fa-sliders"></span>Beállítások</a>
            <div class="dropdown-divider"></div>
              <button type="submit" name="logout" class="dropdown-item"><span class="fa fa-sign-out"></span>Kijelentkezés</button>
            </form>
          </li>
        </ul>
    </div>
</nav>
<?php
  }
}
?>
