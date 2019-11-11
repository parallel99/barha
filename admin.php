<?php
if ($_SESSION['user']['permission'] != 'admin') {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <title>BárHa | Admin</title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
menu("favourite");
?>
<div class="container recipe-list-container">
    <?php
    if (isset($_SESSION['admin-message'])) {
        echo $_SESSION['admin-message'];
        unset($_SESSION['admin-message']);
    }
    ?>
    <div class="favourite">
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/include/makingTime.php';

        $sql = "SELECT * FROM recipes WHERE status = 'pending' ORDER BY uploadtime DESC;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        if ($stmt->rowCount() == 0) {
            echo "<div class=\"no-result\"><h3>Nincs találat</h3></div>";
        }

        foreach ($data as $row) {
            ?>
            <a class="media" href="recipe/<?php echo $row->url; ?>">
                <div class="media-left">
                    <?php
                    if (empty($row->image)) {
                        echo "<img src= \"/images/no-img.png\" loading=\"lazy\" alt=\"$row->name\">";
                    } else {
                        echo "<img src= \"$row->image\" loading=\"lazy\" alt=\"$row->name\">";
                    } ?>
                </div>
                <div class="media-body">
                    <h3><?php echo $row->name; ?></h3>
                    <h6>Elkészítési idő:
                        <strong><?php echo MakingTime($row->makingtime); ?></strong>
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
