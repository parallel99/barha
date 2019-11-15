<?php

try {
    $dsn = getenv("DB_URI");

    $pdo = new PDO($dsn, getenv("DB_USERNAME"), getenv("DB_PASSWORD"));
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "<div class=\"alert alert-danger\">Connection failed: " . $e->getMessage() . "</div>";
    die();
}
