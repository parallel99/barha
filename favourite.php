<?php
if (!isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="<? echo $_SESSION["lang"] ?? "hu"; ?>">
<head>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    <title><?= _BARHA ?> | <?= _FAVOURITES ?></title>
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
        include $_SERVER['DOCUMENT_ROOT'] . '/include/makingTime.php';

        $sql = "SELECT recipes.* FROM recipes, users WHERE recipes.id = ANY(users.favourite) AND users.email = :email AND recipes.status = 'accepted' ORDER BY uploadtime DESC;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll();

        if ($stmt->rowCount() == 0) {
            echo '<div class="alert alert-info mt-3" role="alert">' . _NO_RESULTS . '</div>';
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
                    <h6><?= _PREPARATION_TIME_COLON ?>
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
