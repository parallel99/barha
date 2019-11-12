<!DOCTYPE html>
<html lang="<? echo $_SESSION['user']['lang'] ?>">
<head>
    <title><? _BARHA ?></title>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
include $_SERVER['DOCUMENT_ROOT'] . '/include/ingredients.php';
menu("index");
?>
<h1 id="title"><? _HOMEPAGE-TITLE ?></h1>

<form method="get" class="shadow" id="mainForm" action="search.php">
    <div class="ingredients-group">
        <div class="form-group">
            <input autofocus type="text" class="form-control" name="ingredients1" id="ingredients1" placeholder="<? _INGREDIENTS ?>">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Keresés</button>
</form>
<script>
    $('.ingredients-group').on('input', function () {
        let length = $(".ingredients-group > div").length
        if ($("div.ingredients-group div:last-child > input").val() !== "" && length < 25) {
            $(".ingredients-group").append("<div class='form-group'><input type='text' class='form-control' name='ingredients" + (length + 1) + "' id='ingredients" + (length + 1) + "' placeholder='<? _INGREDIENTS ?>'></div>");
            $("#ingredients" + (length + 1)).autocomplete({
                source: ingredients
            });
        }
    });
</script>
</body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
</html>
