<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
$count = $_POST['count'];
$search = $_POST['search'];

$stmt = $pdo->prepare("SELECT * FROM ingredients WHERE LOWER(name) LIKE LOWER('%" . $search . "%') LIMIT 50 OFFSET :offset;");
$stmt->bindValue(':offset', $count * 50, PDO::PARAM_STR);
$stmt->execute();
$data = $stmt->fetchAll();

$i = 0;

foreach ($data as $row) {
    $i++;
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
    echo $i;
}

?>
