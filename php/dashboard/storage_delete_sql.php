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

  $query = $mysql->prepare("SELECT file FROM storage WHERE id = :id");
  $query->execute([':id' => $_GET['id']]);
  $result = $query->fetchAll();
  foreach ($result as $row){
    unlink('storage/' . $row['file']);
  }

  $queryUpdate = $mysql->query('DELETE FROM storage WHERE id = "'.$_GET['id'].'";');
  
  if ($queryUpdate) header('location: storage.php');