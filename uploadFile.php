<?php
require 'vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
require 'vendor/cloudinary/cloudinary_php/src/Uploader.php';

\Cloudinary::config(array(
    "cloud_name" => "htmfraf8s",
    "api_key" => "445362577878397",
    "api_secret" => "yWEvOGYU2B_xylfLEzW3XDNNnbQ"
));

if (isset($_POST["submit"])) {
    echo "files:";
    print_r($_FILES["fileToUpload"]);
    $cloudUpload = \Cloudinary\Uploader::upload($_FILES["fileToUpload"]['tmp_name']);
    echo "<br>upload: ";
    print_r($cloudUpload);
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo $cloudUpload['url'];
    echo "<br>";
    echo $cloudUpload['secure_url'];
}

?>
<!DOCTYPE HTML>
  <html>
    <head>
  </head>

  <body>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

  </body>
</html>
