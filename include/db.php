<?php

try {
    $dsn = "pgsql:host=ec2-54-247-170-5.eu-west-1.compute.amazonaws.com;port=5432;dbname=db7cf6bqdj1uek;user=wqfrdangwxocek;password=655905b5bafb9efa2d0aeb130b343aac6534b8421ad0c7be466407c6a9f1c8a8;";

    $pdo = new PDO($dsn, "wqfrdangwxocek", "655905b5bafb9efa2d0aeb130b343aac6534b8421ad0c7be466407c6a9f1c8a8");
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8mb4");
} catch (PDOException $e) {
    echo "<div class=\"alert alert-danger\">Connection failed: " . $e->getMessage() . "</div>";
    die();
}
