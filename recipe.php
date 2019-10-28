<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$sql = "SELECT * FROM recipebeta WHERE url = :url;";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':url', $_GET['name'], PDO::PARAM_STR);
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
            echo "<h6 id=\"email\" style=\"display: none\">" . $_SESSION['user']['email'] . "</h6>";
        ?>
        <div class="container recipe-container">
            <div class="row">
                <div class="col-sm-5">
                    <h1 id="name"><?php echo $recipe->name ?></h1>
                    <hr>
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo "<div class=\"favourite\"><div class=\"favourite-star\"></div><h5>Hozzáadás a kedvencekhez</h5></div>";
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
                    <?php
                      echo $recipe->making;
                    ?>
                </div>
            </div>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
    <script>
    $(".favourite").click(function() {
        $.ajax({
        url: 'include/addToFavourite.php',
                type: 'post',
                data: {
                    "name": $("#name").text(),
                    "email": $("#email").text()
                },
                success: function (response) {
                    $('html').append(response)
                },
                error: function (data) {
                    $('html').append(data)
                }
        });
    });
    </script>
</html>
