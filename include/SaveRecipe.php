<?php

class SaveRecipe {
    public function __construct() {
        $this->msg = "";
        $this->ok = true;
        $this->recipe_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $this->making = str_replace(PHP_EOL, "<br>", filter_input(INPUT_POST, "making", FILTER_SANITIZE_STRING));
        $this->making_time = filter_input(INPUT_POST, "makingtime", FILTER_SANITIZE_STRING);
        $this->std = new \stdClass();
    }

    public function Check($units) {
        $time_ok = preg_match("/^(?:2[0-3]|[01][0-9]):[0-5][05]$/", $this->making_time);
        $ingredients_ok = false;

        for ($i = 1; $i < 26; $i++) {
            $ingredients_name = 'ingredients' . $i;
            $num_name = 'db' . $i;
            $unit_name = 'unit' . $i;
            if (filter_has_var(INPUT_POST, $ingredients_name) && $_POST[$ingredients_name] != "") {
                if (filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING) != "") {
                    $this->std->$ingredients_name = new \stdClass();
                    $this->std->$ingredients_name->name = filter_input(INPUT_POST, $ingredients_name, FILTER_SANITIZE_STRING);
                    $this->std->$ingredients_name->quantity = filter_input(INPUT_POST, $num_name, FILTER_SANITIZE_STRING);
                    $this->std->$ingredients_name->unit = filter_input(INPUT_POST, $unit_name, FILTER_SANITIZE_STRING);
                    $ingredients_ok = true;
                } else {
                    $this->msg = '<div class="alert alert-danger alert-dismissible fade show">Nem adta meg a mennyiséget a hozzávalóknál!</div>';
                    $this->ok = false;
                }
            }
        }

        $unit_number = 0;

        foreach ($units as $unit) {
            for ($i = 1; $i < 26; $i++) {
                $ingredients_name = 'ingredients' . $i;
                if (isset($this->std->$ingredients_name->unit)) {
                    if ($this->std->$ingredients_name->unit == $unit) {
                        $unit_number = $unit_number + 1;
                    }
                }
            }
        }

        if (count((array)$this->std) != $unit_number) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">A megadott mértékegység nem létezik!</div>';
            $this->ok = false;
        }

        if (mb_strlen($this->recipe_name) < 3 || mb_strlen($this->recipe_name) > 255) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept nevének minimum 3 karakternek, maximum 255 karakternek kell lennie!</div>';
            $this->ok = false;
        }

        if (mb_strlen($this->making) < 10 || mb_strlen($this->making) > 5000) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">A recept leírásának minimum 10 karakternek, maximum 5000 karakternek kell lennie!</div>';
            $this->ok = false;
        }

        if (!$time_ok) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">Rossz az elkészítési idő formátuma!</div>';
            $this->ok = false;
        }

        if ($this->making_time == "00:00") {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem adott meg elkészíttési időt!</div>';
            $this->ok = false;
        }

        if (!$ingredients_ok) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem adott meg hozzávalót!</div>';
            $this->ok = false;
        }

        if (file_exists($_FILES['customFile']['tmp_name']) || is_uploaded_file($_FILES['customFile']['tmp_name'])) {
            $this->CheckImage();
        }
    }

    public function CheckImage() {
        $this->ok = getimagesize($_FILES["customFile"]["tmp_name"]);
        if ($this->ok == false) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">Nem Képet töltött fel!</div>';
        }

        if ($_FILES["customFile"]["size"] > 5000000) {
            $this->msg .= '<div class="alert alert-danger alert-dismissible fade show">A kép nem lehet nagyobb 5MB-nál!</div>';
            $this->ok = false;
        }
    }

    public function Save() {
        if ($this->ok) {
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
            $ingredients = json_encode($this->std);
            $url = urlencode($this->recipe_name) . "-" . date('ymdgis');

            $stmt = $pdo->prepare("INSERT INTO recipes(name, ingredients, making, uploader, uploadtime, status, url, makingtime, lang) VALUES (:name, :ingredients, :making, :uploader, CURRENT_TIMESTAMP, 'pending', :url, :makingtime, :lang)");
            $stmt->bindParam(':name', $this->recipe_name, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':making', $this->making, PDO::PARAM_STR);
            $stmt->bindParam(':uploader', $_SESSION['user']['email'], PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':makingtime', $this->making_time, PDO::PARAM_STR);
            $stmt->bindParam(':lang', $_SESSION['lang'], PDO::PARAM_STR);
            $stmt->execute();

            $this->msg = '<div class="alert alert-success alert-dismissible fade show">Sikeresen elküldte a receptet!</div>';
            if (file_exists($_FILES['customFile']['tmp_name']) || is_uploaded_file($_FILES['customFile']['tmp_name'])) {
                $this->UploadImage($url);
            }
            $_POST = array();
            unset($_POST);
        }

        return $this->msg;
    }

    public function UploadImage($url) {
        require_once 'vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
        require_once 'vendor/cloudinary/cloudinary_php/src/Uploader.php';
        require_once 'vendor/cloudinary/cloudinary_php/src/Error.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

        \Cloudinary::config(array(
            "cloud_name" => getenv("CLOUDINARY_CLOUD_NAME"),
            "api_key" => getenv("CLOUDINARY_API_KEY"),
            "api_secret" => getenv("CLOUDINARY_API_SECRET")
        ));

        $cloudUpload = \Cloudinary\Uploader::upload($_FILES["customFile"]['tmp_name']);

        $stmt = $pdo->prepare("UPDATE recipes SET image = :image, imagename = :imagename WHERE url = :url");
        $stmt->bindParam(':image', $cloudUpload['secure_url'], PDO::PARAM_STR);
        $stmt->bindParam(':imagename', $cloudUpload['public_id'], PDO::PARAM_STR);
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function Update() {
        if ($this->ok) {
            include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';
            $ingredients = json_encode($this->std);
            $url = urlencode($this->recipe_name) . "-" . date('ymdgis');

            $stmt = $pdo->prepare("UPDATE recipes SET name = :name, ingredients = :ingredients, making = :making, uploadtime = CURRENT_TIMESTAMP, url = :url, makingtime = :makingtime, lang = :lang, status = 'pending' WHERE id = :id");
            $stmt->bindParam(':name', $this->recipe_name, PDO::PARAM_STR);
            $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
            $stmt->bindParam(':making', $this->making, PDO::PARAM_STR);
            $stmt->bindParam(':url', $url, PDO::PARAM_STR);
            $stmt->bindParam(':makingtime', $this->making_time, PDO::PARAM_STR);
            $stmt->bindParam(':lang', $_SESSION['lang'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();

            $getimage = $pdo->prepare("SELECT imagename FROM recipes WHERE id = :id");
            $getimage->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $getimage->execute();
            $getimagename = $getimage->fetch(PDO::FETCH_OBJ);

            $this->msg = '<div class="alert alert-success alert-dismissible fade show">Sikeresen módosította a receptet!</div>';
            if (file_exists($_FILES['customFile']['tmp_name']) || is_uploaded_file($_FILES['customFile']['tmp_name'])) {
                if (!empty($getimagename->imagename)) {
                    $this->DeleteImage($url);
                }
                $this->UploadImage($url);
            }
            $_POST = array();
            unset($_POST);
        }

        return $this->msg;
    }

    public function DeleteImage($url) {
        require_once 'vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
        require_once 'vendor/cloudinary/cloudinary_php/src/Uploader.php';
        require_once 'vendor/cloudinary/cloudinary_php/src/Error.php';
        include $_SERVER['DOCUMENT_ROOT'] . '/include/db.php';

        \Cloudinary::config(array(
            "cloud_name" => getenv("CLOUDINARY_CLOUD_NAME"),
            "api_key" => getenv("CLOUDINARY_API_KEY"),
            "api_secret" => getenv("CLOUDINARY_API_SECRET")
        ));


        $stmt = $pdo->prepare("SELECT imagename FROM recipes WHERE url = :url");
        $stmt->bindParam(':url', $url, PDO::PARAM_STR);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_OBJ);
        \Cloudinary\Uploader::destroy($image->imagename);
    }
}
