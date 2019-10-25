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
        ?>
        <div class="container recipe-list-container">
            <form method="get" class="row search">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Keresés">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="submit">Keresés</button>
                    </span>
                </div>
            </form>
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

            if (isset($_GET['submit'])) {
                $sql = "SELECT * FROM ingredients WHERE name LIKE %:search%;";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':search', $_GET['search'], PDO::PARAM_STR);
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
                            <h6>Elkészítési idő: <strong>30 perc</strong></h6>
                        </div>
                    </a>
                    <?php
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
                            <h6>Elkészítési idő: <strong>30 perc</strong></h6>
                        </div>
                    </a>
                    <?php
                }
            }
            ?>
        </div>
    </body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
