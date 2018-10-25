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

  $query = $mysql->prepare("INSERT INTO news (id, title, description, type) VALUES (NULL, :title, :description, :type)");
  $query->execute([
      ':title' => $_POST['title'],
      ':description' => $_POST['description'],
      ':type' => $_POST['type']
  ]);

  if($query) header('location: news.php');