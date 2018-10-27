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

  $tagsUsers = $_POST['users_nick'];

  $users_nick = "";

  for ($i=0; $i < count($tagsUsers); $i++) {
    $users_nick .= $tagsUsers[$i] . ',';
  }

  $query = $mysql->prepare("UPDATE storage SET type=:type, users_nick=:users_nick, description=:description, priority=:priority WHERE id=:id");
  
  $query->execute([
    ':type' => $_POST['type'],
    ':users_nick' => $users_nick,
    ':description' => $_POST['description'],
    ':priority' => $_POST['priority'],
    ':id' => $_POST['id']
  ]);

  if($query) header('location: storage.php');