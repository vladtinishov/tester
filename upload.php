<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header('Access-Control-Allow-Headers: *');

$target_dir = "questions/";
$target_file = $target_dir . $_POST['id'] . '||' . basename($_FILES["questions"]["name"]);
$uploadOk = 1;
// Check if image file is a actual image or fake image
if(isset($_FILES["questions"])) {
  if (move_uploaded_file($_FILES["questions"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["questions"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>