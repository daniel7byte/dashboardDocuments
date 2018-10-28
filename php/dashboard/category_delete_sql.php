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

  $queryUpdate = $mysql->query('DELETE FROM category WHERE id = "'.$_GET['id'].'";');
  
  if ($queryUpdate) header('location: category.php');