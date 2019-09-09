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
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a target="_blank" href="#" class="navbar-brand">My sApp.</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">Inicio</a></li>
                <li class="active"><a href="http://bootsnipp.com/snippets/featured/nav-account-manager" target="_blank">Inspirado en este ejemplo</a></li>
                 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">DropDown
                    <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Link 2</a></li>
                    </ul>
                 </li>
             </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong>Nombre</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Nombre Apellido</strong></p>
                                        <p class="text-left small">correoElectronico@email.com</p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Actualizar Datos</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="#" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<!---
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
</nav>-->
<?php
  }
}
?>
