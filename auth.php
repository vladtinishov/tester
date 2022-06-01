<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header('Access-Control-Allow-Headers: *');

include 'db.php';

$requestData = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli($host, $userName, $pass, $db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $requestData['email'];
$password = $requestData['password'];

$sql = "SELECT * FROM users 
          WHERE email = '$email' AND 
          password = '$password'";

$data = $conn->query($sql);

if ($data->num_rows > 0) {
  echo json_encode($data->fetch_assoc());
} else {
  echo json_encode(['error' => 'no user found']);
}

$conn->close();