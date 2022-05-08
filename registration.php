<?php
$requestData = json_decode(file_get_contents('php://input'), true);
$name = $requestData['name'];
$email = $requestData['email'];
$password = $requestData['password'];
// Create connection
$conn = new mysqli('localhost', 'id13161526_root', 'A/$xm3%3q2}IK3^g', 'id13161526_questions');
// Check connection
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
?>