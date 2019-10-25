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
            <div class="row search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Keresés">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="button">Keresés</button>
                    </span>
                </div>
            </div>
            <?php
            
            function getContent() {
                include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
                $sql = "SELECT * FROM recipe_test;";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll();
            }

            $data = getContent();
            foreach($data as $row) {?>
                <a class="media" href="recipe/<?php echo $row->id . ": " . $row->name; ?>">
                    <div class="media-left">
                        <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo $row->id . ": " . $row->name; ?>">
                    </div>
                    <div class="media-body">
                        <h3><?php echo $row->id . ": " . $row->name; ?></h3>
                        <h6>Elkészítési idő: <strong>30 perc</strong></h6>
                    </div>
                </a>
                
                echo '<br>';
            <?php}?>
        </div>
    </body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
