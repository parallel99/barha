<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Receptek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("recipes");
        if (!isset($_GET['search'])) {
            header("Location: recipes.php?search=");
            die();
        }
        ?>
        <div class="container recipe-list-container">
            <form method="get" class="row search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" id="search" placeholder="Keresés" value="<?php echo trim($_GET["search"]) ?? "";?>">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Keresés</button>
                    </span>
                </div>
            </form>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

            if (isset($_GET['submit']) || isset($_GET['search'])) {
                $search = trim($_GET['search']);

                $sql = "SELECT * FROM ingredients WHERE LOWER(name) LIKE LOWER('%" . $search . "%') LIMIT 50;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll();

                if ($stmt->rowCount() == 0) {
                    echo "<div class=\"no-result\"><h3>Nincs találat</h3></div>";
                }

                foreach ($data as $row) {
                    ?>
                    <a class="media" href="recipe/<?php echo $row->name; ?>">
                        <div class="media-left">
                            <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo $row->name; ?>">
                        </div>
                        <div class="media-body">
                            <h3><?php echo $row->name; ?></h3>
                            <h6>Elkészítési idő: <strong><?php echo rand(10, 60); ?> perc</strong></h6>
                        </div>
                    </a>
                    <?php
                }

                if ($stmt->rowCount() == 50) {
                    echo "<div class=\"more-recipe\"><button class=\"btn btn-primary\" id=\"more-recipe-btn\">Tovább</button></div>";
                }

            } else {
                $sql = "SELECT * FROM ingredients;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll();

                foreach ($data as $row) {
                    ?>
                    <a class="media" href="recipe/<?php echo $row->name; ?>">
                        <div class="media-left">
                            <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo $row->name; ?>">
                        </div>
                        <div class="media-body">
                            <h3><?php echo $row->name; ?></h3>
                            <h6>Elkészítési idő: <strong><?php echo rand(10, 60); ?> perc</strong></h6>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
<script>
    count = 0;
    $("#more-recipe-btn").click(function() {
        count++;
        $.ajax({
        url: 'include/loadMoreRecipe.php',
                type: 'post',
                data: {
                    "count": count,
                    "search": $("#search").val()
                },
                success: function (response) {
                    $('.recipe-list-container').append(response)
                },
                error: function (data) {}
        });
        $("#more-recipe").remove();
    });
</script>
</html>
