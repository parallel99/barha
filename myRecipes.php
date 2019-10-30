<!DOCTYPE html>
<html lang="hu" role="main">
    <head>
        <title>BárHa | Receptek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("none");
        ?>
        <div class="container recipe-list-container">
            <div class="recipes">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

            $sql = "SELECT * FROM recipebeta ORDER BY uploadtime DESC;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();

                foreach ($data as $row) {
                    $time = preg_split("/:/", $row->makingtime);
                    if(intval($time[0]) != 0){
                      $hour = intval($time[0]) . " óra";
                    } else {
                      $hour = "";
                    }
                    if(intval($time[1]) != 0){
                      $minute = intval($time[1]) . " perc";
                    } else {
                      $minute = "";
                    }
                    ?>
                    <div>
                      <a class="media" href="recipe/<?php echo $row->url; ?>" style="margin-bottom: 0;">
                          <div class="media-left">
                              <img src="/images/test-recipe.jpg" loading="lazy" alt="<?php echo $row->name; ?>">
                          </div>
                          <div class="media-body">
                              <h3><?php echo $row->name; ?></h3>
                              <h6>Elkészítési idő:
                                <strong>
                                  <?php echo $hour, " ", $minute; ?>
                                </strong>
                              </h6>
                          </div>
                      </a>
                      <div style="width: 50%; display: inline-block; background: blue;">Szerkeszt</div>
                      <div style="width: 50%; display: inline-block; background: red;">Töröl</div>
                    </div>
                    <?php
                }
            ?>
        </div>
    </body>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/include/footer.php'; ?>
<script>
    count = 0;
    $(".more-recipe").on("click",".more-recipe-btn", function(){
        count++;
        $.ajax({
        url: 'include/loadMoreRecipe.php',
                type: 'post',
                data: {
                    "count": count,
                    "search": $("#search").val()
                },
                success: function (response) {
                    $('.recipes').append(response)
                },
                error: function (data) {}
        });
    });
</script>
</html>
