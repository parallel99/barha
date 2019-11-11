<?php
if (!isset($_SESSION['user'])) {
    header("Location: /");
    die();
}
?>
<!DOCTYPE html>
<html lang="hu">
    <head>
        <title>BárHa | Receptek</title>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/include/header.php'; ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/include/navbar.php';
        menu("none");
        if (isset($_SESSION["msg"])) {
            echo $_SESSION["msg"];
            unset($_SESSION["msg"]);
        }
        ?>
        <div class="container recipe-list-container">
            <div class="recipes">
            <?php
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
            include $_SERVER['DOCUMENT_ROOT'] . '/include/makingTime.php';
            $sql = "SELECT * FROM recipes WHERE uploader = :email ORDER BY uploadtime DESC;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
            $stmt->execute();
            $data = $stmt->fetchAll();
            if ($stmt->rowCount() == 0) {
                echo "<div class=\"no-result\"><h3>Nincs találat</h3></div>";
            }
                foreach ($data as $row) {
                    ?>
                    <div>
                      <a class="media" href="recipe/<?php echo $row->url; ?>" style="margin-bottom: 0; border-radius: 10px 10px 0 0">
                          <div class="media-left">
                            <?php
                                if (empty($row->image)) {
                                    echo "<img src= \"/images/no-img.png\" loading=\"lazy\" alt=\"$row->name\">";
                                } else {
                                    echo "<img src= \"$row->image\" loading=\"lazy\" alt=\"$row->name\">";
                                } ?>
                          </div>
                          <div class="media-body">
                              <h3>
                                <?php
                                  echo $row->name, statusText($row->status);
                                ?>
                            </h3>
                              <h6>Elkészítési idő:
                                <strong>
                                  <?php echo MakingTime($row->makingtime); ?>
                                </strong>
                              </h6>
                          </div>
                      </a>
                      <button onclick="location.href='/changeRecipe?id=<?php echo $row->id; ?>';" class="myrecipe-btn write-recipe-btn">
                        <i class="fa fa-edit"></i>Szerkeszt
                      </button>
                      <button type="button" class="myrecipe-btn delete-recipe-btn" data-toggle="modal" data-target="#recipe<?php echo $row->id; ?>">
                        <i class="fa fa-trash-o"></i>Töröl
                      </button>
                    </div>
                    <div class="modal fade" id="recipe<?php echo $row->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Figyelem!</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Biztosan törölni kívánja ezt a receptet: <?php echo $row->name; ?>
                          </div>
                          <form class="modal-footer" method="post">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Vissza</button>
                            <button type="submit" name="recipe<?php echo $row->id; ?>" class="btn btn-danger">Törlés</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <?php
                        if (isset($_POST["recipe". $row->id])) {
                            include($_SERVER['DOCUMENT_ROOT'].'/include/db.php');
                            include($_SERVER['DOCUMENT_ROOT'].'/include/SaveRecipe.php');
                            try {
                                if (!empty($row->image) || $row->image != null || $row->image != "") {
                                    $delimg = new SaveRecipe();
                                    $delimg->DeleteImage($row->url);
                                }
                                $stmt = $pdo->prepare("DELETE FROM recipes WHERE uploader = :email AND id = :id");
                                $stmt->bindValue(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
                                $stmt->bindValue(':id', $row->id, PDO::PARAM_INT);
                                $stmt->execute();
                                $_SESSION["msg"] = '<div class="alert alert-success alert-dismissible fade show">Sikeresen törölte: '. $row->name. '</div>';
                                header("Refresh: 0");
                                die();
                            } catch (Exception $e) {
                                $_SESSION["msg"] = '<div class="alert alert-success alert-dismissible fade show">Nem sikerült a törlés: '. $e->getMessage(). '</div>';
                                header("Refresh: 0");
                                die();
                            }
                        } ?>
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
                error: function () {}
        });
    });
</script>
</html>
