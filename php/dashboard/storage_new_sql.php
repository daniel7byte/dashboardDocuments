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
        move_uploaded_file($_FILES["file"]["tmp_name"], "storage/" . time() . "_" . $_FILES["file"]["name"]);

        $tagsUsers = $_POST['users_nick'];

        $users_nick = "";

        for ($i=0; $i < count($tagsUsers); $i++) {
          $users_nick .= $tagsUsers[$i] . ',';
        }

        $query = $mysql->prepare("INSERT INTO storage (id, description, file, priority, users_nick, type, file_check) VALUES (NULL, :description, :file, :priority, :users_nick, :type, 'N')");
        $query->execute([
          ':users_nick' => $users_nick,
          ':type' => $_POST['type'],
          ':description' => $_POST['description'],
          ':file' => time() . "_" . $_FILES["file"]["name"],
          ':priority' => $_POST['priority']
        ]);

        if($query) header('location: storage.php');
      } else {
        echo "ERROR";
        exit;
      }

    }else{
      echo "ERROR";
      exit;
    }



  }else{
    echo "ERROR";
    exit;
  }
