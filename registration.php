<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header('Access-Control-Allow-Headers: *');

include 'db.php';

$requestData = json_decode(file_get_contents('php://input'), true);
$name = $requestData['name'];
$email = $requestData['email'];
$password = $requestData['password'];

try {
  $conn = new mysqli($host, $userName, $pass, $db);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $sql = "INSERT INTO users (email, password, name)
  VALUES ('$email', '$password', '$name')";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
  $conn->close();
} catch (Exception $e) {
  echo [ 'error' => $e ];
}

?>