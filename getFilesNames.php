<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT");
header('Access-Control-Allow-Headers: *');

$id = $_GET['id'];
$dir = 'questions';
$files = scandir($dir);
$result = [];

for ($i=0; $i < count($files); $i++) { 
  if (explode('||', $files[$i])[0] == $id) {
    $result[] = ['value' => $files[$i], 'title' => explode('||', $files[$i])[1]];
  }
}


echo json_encode($result);
