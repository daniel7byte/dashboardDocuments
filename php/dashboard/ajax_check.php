<?php

session_start();

if(!isset($_SESSION['nick'])){
  header('Location: signin.php');
  exit;
}

if($_SESSION['role'] != "ADMIN"){
  header('Location: 403.php');
  exit;
}

require_once("config/parameters.php");
require_once("config/connection.php");

function getStatus($id) {

  $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

  $query = $mysql->prepare("SELECT id, file_check FROM storage WHERE id = :id");
  $query->execute([
    ':id' => $id
  ]);

  $result = $query->fetchAll();
  
  foreach ($result as $row) {
    return $row['file_check'];
  }
}

function changeStatus($id) {

  $newStatus = (getStatus($id) == 'N') ? 'Y' : 'N';

  $mysql = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

  $query = $mysql->prepare("UPDATE storage SET file_check = :file_check WHERE id = :id");
  $query->execute([
    ':file_check' => $newStatus,
    ':id' => $id
  ]);

  if ($query) {
    return getStatus($id);
  }
}

if (isset($_POST['id'])) {
  $result = changeStatus($_POST['id']);
  echo $result;
}
