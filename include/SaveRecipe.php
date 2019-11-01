<?php
<<<<<<< HEAD
class SaveRecipe {

  public $msg = "";
  public $ok = true;
  public $recipe_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
  public $making      = filter_input(INPUT_POST, "making", FILTER_SANITIZE_STRING);
  public $making_time = filter_input(INPUT_POST, "makingtime", FILTER_SANITIZE_STRING);
  public $std         = new \stdClass();

  function Check($units){
=======
function Save($units)
{
    $recipe_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $making      = $_POST['making'];
    $making_time = filter_input(INPUT_POST, "makingtime", FILTER_SANITIZE_STRING);
>>>>>>> ade4d23f1541fde2be08685e367fa777505bdf40
    $time_ok     = preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][05]$/", $making_time);
    $ingredients_ok = false;

    //<-------------------- Kép feltöltés -------------------->
    require 'vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
    require 'vendor/cloudinary/cloudinary_php/src/Uploader.php';

    \Cloudinary::config(array(
        "cloud_name" => "htmfraf8s",
        "api_key" => "445362577878397",
        "api_secret" => "yWEvOGYU2B_xylfLEzW3XDNNnbQ"
    ));

    $cloudUpload = \Cloudinary\Uploader::upload($_FILES["customFile"]['tmp_name']);
    //<------------------ Kép feltölté vége ------------------>

    for ($i = 1; $i < 26; $i++) {
        $ingredients_name = 'ingredients' . $i;
        $num_name         = 'db' . $i;
        $unit_name        = 'unit' . $i;
        if (filter_has_var(INPUT_POST, $ingredients_name) && $_POST[$ingredients_name] != "") {
            if (filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING) != "") {
                $std->$ingredients_name = new \stdClass();
                $std->$ingredients_name->name = filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING);
                $std->$ingredients_name->quantity = filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING);
                $std->$ingredients_name->unit = filter_input(INPUT_POST, $unit_name, FILTER_SANITIZE_STRING);
                $ingredients_ok = true;
            } else {
                $msg = '<div class="alert alert-danger alert-dismissible fade show">Nem adta meg a mennyiséget a hozzávalóknál!</div>';
                $ok = false;
            }
        }
    }

    $unit_number = 0;

    foreach ($units as $unit) {
        for ($i = 1; $i < 26; $i++) {
            $ingredients_name = 'ingredients' . $i;
            if (isset($std->$ingredients_name->unit)) {
                if ($std->$ingredients_name->unit == $unit) {
                    $unit_number = $unit_number+1;
                }
            }
        }
    }

    if (count((array) $std) != $unit_number) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">A megadott mértékegység nem létezik!</div>';
        $ok = false;
    }

    if (mb_strlen($recipe_name) < 3 || mb_strlen($recipe_name) > 255) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept nevének minimum 3 karakternek, maximum 255 karakternek kell lennie!</div>';
        $ok = false;
    }

    if (mb_strlen($making) < 10 || mb_strlen($making) > 5000) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept leírásának minimum 10 karakternek, maximum 5000 karakternek kell lennie!</div>';
        $ok = false;
    }

    if (!$time_ok) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">Rossz az elkészítési idő formátuma!</div>';
        $ok = false;
    }

    if ($making_time == "00:00") {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem adott meg elkészíttési időt!</div>';
        $ok = false;
    }

    if (!$ingredients_ok) {
        $msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem adott meg hozzávalót!</div>';
        $ok = false;
    }
  }

<<<<<<< HEAD
  function Save(){
      if($ok){
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
            $ingredients = json_encode($std);
            $url = urlencode($recipe_name) . "-" . date('ymdgis');

            $stmt = $pdo->prepare("INSERT INTO recipebeta(name, ingredients, making, uploader, uploadtime, url, makingtime) VALUES (:name, :ingredients, :making, :uploader, CURRENT_TIMESTAMP, :url, :makingtime)");
            $stmt->bindParam(':name', $recipe_name, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':making', $making, PDO::PARAM_STR);
            $stmt->bindParam(':uploader', $_SESSION['user']['email'], PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':makingtime', $making_time, PDO::PARAM_STR);
            $stmt->execute();

            $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeresen elküldte a receptet!</div>';
            $_POST = array();
            unset($_POST);
        }

        return $msg;
  }
=======
    if ($ok) {
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
        $ingredients = json_encode($std);
        $url = urlencode($recipe_name) . "-" . date('ymdgis');

        $stmt = $pdo->prepare("INSERT INTO recipebeta(name, ingredients, making, uploader, uploadtime, url, makingtime, image) VALUES (:name, :ingredients, :making, :uploader, CURRENT_TIMESTAMP, :url, :makingtime, :image)");
        $stmt->bindParam(':name', $recipe_name, PDO::PARAM_STR);
        $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
        $stmt->bindParam(':making', $making, PDO::PARAM_STR);
        $stmt->bindParam(':uploader', $_SESSION['user']['email'], PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->bindParam(':makingtime', $making_time, PDO::PARAM_STR);
        $stmt->bindParam(':image', $cloudUpload['secure_url'], PDO::PARAM_STR);
        $stmt->execute();

        $msg = '<div class="alert alert-success alert-dismissible fade show">Sikeresen elküldte a receptet!</div>';
        $_POST = array();
        unset($_POST);
    }

    return $msg;
>>>>>>> ade4d23f1541fde2be08685e367fa777505bdf40
}
