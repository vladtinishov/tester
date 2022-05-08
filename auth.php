<?php

$requestData = json_decode(file_get_contents('php://input'), true);

$conn = new mysqli('localhost', 'id13161526_root', 'A/$xm3%3q2}IK3^g', 'id13161526_questions');
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