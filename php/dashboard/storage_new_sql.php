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

  if(isset($_FILES["file"]["name"])) {


    $extension = explode(".", $_FILES["file"]["name"]);
    $extension = strtolower(end($extension));
    
    if($extension != "php"){
      
       if (is_uploaded_file($_FILES["file"]["tmp_name"])){
        move_uploaded_file($_FILES["file"]["tmp_name"], "storage/" . $_FILES["file"]["name"]);

        $query = $mysql->prepare("INSERT INTO storage (id, description, file, priority) VALUES (NULL, :description, :file, :priority)");
        $query->execute([
          ':description' => $_POST['description'],
          ':file' => $_FILES["file"]["name"],
          ':priority' => $_POST['priority']
        ]);

        if($query) header('location: storage.php');
      } else {
        header('location: storage.php');
      }

    }else{
      echo "ERROR";
      exit;
    }



  }else{
    echo "ERROR";
    exit;
  }