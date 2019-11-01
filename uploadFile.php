<!DOCTYPE HTML>
<html>
	<body>
		<form method="post" enctype="multipart/form-data">
			Select image to upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload Image" name="submit">
		</form>
	</body>
</html>

<?php
require 'vendor/cloudinary/cloudinary_php/src/Cloudinary.php';
require 'vendor/cloudinary/cloudinary_php/src/Uploader.php';
require 'vendor/cloudinary/cloudinary_php/src/Error.php';

\Cloudinary::config(array(
    "cloud_name" => "htmfraf8s",
    "api_key" => "445362577878397",
    "api_secret" => "yWEvOGYU2B_xylfLEzW3XDNNnbQ"
));

if (isset($_POST["submit"])) {
    $cloudUpload = \Cloudinary\Uploader::upload($_FILES["fileToUpload"]['tmp_name']);
    echo "URL: " . $cloudUpload['secure_url'];
}

?>
