<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

if (!isset($_GET['name'])) {
    header("Location: /recipes");
    die();
}

$sql = "SELECT * FROM recipes WHERE url = :url;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', urlencode($_GET['name']), PDO::PARAM_STR);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_OBJ);

if ($stmt->rowCount() != 1) {
    include $_SERVER['DOCUMENT_ROOT'] . '/error/404.php';
    die();
}

//Ezen még gondolkodnom kell
if (!isset($_SESSION['user'])) {
    if ($recipe->status != 'accepted') {
        include $_SERVER['DOCUMENT_ROOT'] . '/error/404.php';
        die();
    }
} else {
    if ($_SESSION['user']['permission'] != 'admin') {
        if ($recipe->status != 'accepted' && $recipe->uploader != $_SESSION['user']['email']) {
            include $_SERVER['DOCUMENT_ROOT'] . '/error/404.php';
            die();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<? try {echo $_SESSION['user']['lang'];}catch (Exception $e){echo 'hu';} ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?php echo($recipe->name); ?></title>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/makingTime.php';
menu("none");
?>
<div class="container recipe-container">
    <div class="row">
        <div class="col-sm-5">
            <h1 id="name">
                <?php
                echo $recipe->name, statusText($recipe->status);
                ?>
            </h1>
            <?php
            if (isset($_SESSION['user']) && $recipe->status == 'accepted') {

                $stmt = $pdo->prepare("SELECT name, email, favourite FROM users WHERE :id = ANY(favourite) AND email = :email;");
                $stmt->bindValue(':id', $recipe->id, PDO::PARAM_STR);
                $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
                $stmt->execute();

                echo "<hr>";
                if ($stmt->rowCount() == 0) {
                    echo "<div class=\"favourite\"><div style=\"background-image: url('/images/favourite.svg');\" class=\"favourite-star\"></div><h5 class=\"favourite-text\">Hozzáadás a kedvencekhez</h5></div>";
                } else {
                    echo "<div class=\"favourite\"><div style=\"background-image: url('/images/favourite2.svg');\" class=\"favourite-star\"></div><h5 class=\"favourite-text\">Hozzáadva a kedvencekhez</h5></div>";
                }
            }
            ?>
            <hr>
            <h3><?= _INGREDIENTS ?></h3>
            <div class="ingredients">
                <ul>
                    <?php
                    $ingredients = json_decode($recipe->ingredients);
                    foreach ($ingredients as $key => $value) {
                        echo "<li>" . $value->quantity . " " . $value->unit . " " . $value->name . "</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-sm-7">
            <?php
            if (empty($recipe->image)) {
                echo "<img src= \"/images/no-img.png\" loading=\"lazy\" alt=\"$recipe->name\">";
            } else {
                echo "<img src= \"$recipe->image\" loading=\"lazy\" alt=\"$recipe->name\">";
            } ?>
        </div>
    </div>
    <div class="row">
        <div class="recipe">
            <h3><?= _PREPARATION ?></h3>
            <h6 class="gray"><?= _PREPARATION_TIME_COLON ?>
                <strong>
                    <?php echo MakingTime($recipe->makingtime); ?>
                </strong>
            </h6>
            <hr>
            <?php
            echo "<p>" . $recipe->making . "</p>";
            ?>
        </div>
    </div>
    <?php
    if (isset($_SESSION['user']) && $recipe->status == 'pending') {
        if ($_SESSION['user']['permission'] == 'admin') {

            $form = "<form method='post' class='clearfix'>";
            $form .= "<button type='submit' class='btn btn-danger recipe-accept-button' name='delete'>Elutasít</button>";
            $form .= "<button type='submit' class='btn btn-success recipe-accept-button' name='accept'>Elfogad</button>";
            $form .= "</form>";
            echo $form;

            if (isset($_POST['delete'])) {
                //$stmt = $pdo->prepare("DELETE recipes WHERE id = :id;");
                $stmt = $pdo->prepare("UPDATE recipes SET status = 'rejected' WHERE id = :id;");
                $stmt->bindValue(':id', $recipe->id, PDO::PARAM_INT);
                $stmt->execute();
                $_SESSION['admin-message'] = '<div class="alert alert-danger alert-dismissible fade show">Sikeresen törölte a receptet!</div>';
                header("Location: /admin");
                die();
            }

            if (isset($_POST['accept'])) {
                $stmt = $pdo->prepare("UPDATE recipes SET status = 'accepted' WHERE id = :id;");
                $stmt->bindValue(':id', $recipe->id, PDO::PARAM_INT);
                $stmt->execute();

                foreach ($ingredients as $key => $value) {

                    $getingredients = $pdo->prepare("SELECT name FROM ingredients WHERE name = :name;");
                    $getingredients->bindValue(':name', $value->name, PDO::PARAM_STR);
                    $getingredients->execute();

                    if ($getingredients->rowCount() == 0) {
                        $addingredients = $pdo->prepare("INSERT INTO ingredients(name) VALUES(:name);");
                        $addingredients->bindParam(':name', $value->name, PDO::PARAM_STR);
                        $addingredients->execute();
                    }
                }
                $_SESSION['admin-message'] = '<div class="alert alert-success alert-dismissible fade show">Sikeresen elfogadta a receptet!</div>';
                header("Location: /admin");
                die();
            }
        }
    }
    ?>
</div>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
<script>
    $(".favourite").click(function () {
        let id = <?php echo $recipe->id; ?>;
        // Ez meg nem jó teljesen
        if ($('.favourite-text').text() === "Hozzáadás a kedvencekhez") {
            $(".favourite-star").css('background-image', 'url(\'/images/favourite2.svg\')');
            $(".favourite-text").text('Hozzáadva a kedvencekhez');

            $.ajax({
                url: '../include/addToFavourite.php',
                type: 'post',
                data: {
                    "id": id
                },
                success: function () {
                },
                error: function () {
                }
            });
        } else {
            $(".favourite-star").css('background-image', 'url(\'/images/favourite.svg\')');
            $(".favourite-text").text('Hozzáadás a kedvencekhez');

            $.ajax({
                url: '../include/removeFromFavourite.php',
                type: 'post',
                data: {
                    "id": id
                },
                success: function () {
                },
                error: function () {
                }
            });
        }
    });
</script>
</html>
