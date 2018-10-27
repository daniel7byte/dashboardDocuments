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

  $options = [
    'cost' => 12,
  ];

  $hash = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

  $query = $mysql->prepare("INSERT INTO users (id, nick, password, full_name, role) VALUES (NULL, :nick, :password, :full_name, :role)");
  $query->execute([
      ':nick' => $_POST['nick'],
      ':password' => $hash,
      ':full_name' => $_POST['full_name'],
      ':role' => $_POST['role']
  ]);

  if($query) header('location: users.php');
