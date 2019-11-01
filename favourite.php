<?php
if (!isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Kedvencek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("favourite");
        ?>
        <div class="container recipe-list-container">
            <div class="favourite">
                <?php
                include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

                $sql = "SELECT * FROM recipebeta ORDER BY uploadtime DESC;";//még nem jó, meg kell egy WHERE ami nem lesz tul egyszerű
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $data = $stmt->fetchAll();

                if ($stmt->rowCount() == 0) {
                    echo "<div class=\"no-result\"><h3>Nincs találat</h3></div>";
                }

                foreach ($data as $row) {
                    $time = preg_split("/:/", $row->makingtime);
                    if (intval($time[0]) != 0) {
                        $hour = intval($time[0]) . " óra";
                    } else {
                        $hour = "";
                    }
                    if (intval($time[1]) != 0) {
                        $minute = intval($time[1]) . " perc";
                    } else {
                        $minute = "";
                    } ?>
                    <a class="media" href="recipe/<?php echo $row->url; ?>">
                        <div class="media-left">
                            <?php
                                if (empty($row->image)) {
                                    echo "<img src= \"/images/test-recipe.jpg\" loading=\"lazy\" alt=\"$row->name\">";
                                } else {
                                    echo "<img src= \"$row->image\" loading=\"lazy\" alt=\"$row->name\">";
                                } ?>
                        </div>
                        <div class="media-body">
                            <h3><?php echo $row->name; ?></h3>
                            <h6>Elkészítési idő:
                              <strong><?php echo $hour, " ", $minute; ?></strong>
                            </h6>
                        </div>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
