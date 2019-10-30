<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

if (!isset($_GET['name'])) {
    header("Location: /recipes");
    die();
}

$sql = "SELECT * FROM recipebeta WHERE url = :url;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', urlencode($_GET['name']), PDO::PARAM_STR);
$stmt->execute();
$recipe = $stmt->fetch(PDO::FETCH_OBJ);

if ($stmt->rowCount() != 1) {
    include $_SERVER['DOCUMENT_ROOT'] . '/error/404.php';
    die();
}

?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | <?php echo($recipe->name); ?></title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
            menu("none");
            if (isset($_SESSION['user'])) {
                echo "<h6 id=\"email\" style=\"display: none\">" . $_SESSION['user']['email'] . "</h6>";
            }
        ?>
        <div class="container recipe-container">
            <div class="row">
                <div class="col-sm-5">
                    <h1 id="name"><?php echo $recipe->name ?></h1>
                    <?php
                    if (isset($_SESSION['user'])) {
                        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

                        $stmt = $pdo->prepare("SELECT name, email, favourite FROM users WHERE '" . $recipe->name . "' = ANY(favourite) AND email = '" . $_SESSION['user']['email'] . "';");
                        $stmt->execute();
                        $data = $stmt->fetch();

                        echo "<hr>";
                        if ($stmt->rowCount() == 0) {
                            echo "<div class=\"favourite\"><div style=\"background-image: url('/images/favourite.svg');\" class=\"favourite-star\"></div><h5 class=\"favourite-text\">Hozzáadás a kedvencekhez</h5></div>";
                        } else {
                            echo "<div class=\"favourite\"><div style=\"background-image: url('/images/favourite2.svg');\" class=\"favourite-star\"></div><h5 class=\"favourite-text\">Hozzáadva a kedvencekhez</h5></div>";
                        }
                    }
                    ?>
                    <hr>
                    <h3>Hozzávalók</h3>
                    <div class="ingredients">
                        <ul>
                            <?php
                                $ingredients = json_decode($recipe->ingredients);
                                foreach ($ingredients as $key => $value) {
                                    echo "<li>". $value->quantity . " " . $value->unit ." ". $value->name . "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-7">
                    <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo($_GET['name']); ?>">
                </div>
            </div>
            <div class="row">
                <div class="recipe">
                    <h3>Elkészítés</h3>
                    <h6 class="gray">Elkészítési idő:
                      <strong>
                        <?php
                            $time = preg_split("/:/", $recipe->makingtime);
                            if(intval($time[0]) != 0){
                              $hour = intval($time[0]) . " óra";
                            } else {
                              $hour = "";
                            }
                            if(intval($time[1]) != 0){
                              $minute = intval($time[1]) . " perc";
                            } else {
                              $minute = "";
                            }

                            echo $hour, " ", $minute;
                          ?>
                      </strong>
                    </h6><hr>
                    <?php
                      echo "<p>" . $recipe->making . "</p>";
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
    <script>
    $(".favourite").click(function() {
        name = $("#name").text();
        email = $("#email").text();
        if ($('.favourite-text').text() == "Hozzáadás a kedvencekhez") {

            $(".favourite-star").css('background-image', 'url(\'/images/favourite2.svg\')');
            $(".favourite-text").text('Hozzáadva a kedvencekhez');

            $.ajax({
            url: '../include/addToFavourite.php',
                    type: 'post',
                    data: {
                        "name": name,
                        "email": email
                    },
                    success: function (response) {},
                    error: function (data) {}
            });
        } else {

            $(".favourite-star").css('background-image', 'url(\'/images/favourite.svg\')');
            $(".favourite-text").text('Hozzáadás a kedvencekhez');

            $.ajax({
            url: '../include/removeFromFavourite.php',
                    type: 'post',
                    data: {
                        "name": name,
                        "email": email
                    },
                    success: function (response) {},
                    error: function (data) {}
            });
        }
    });
    </script>
</html>
