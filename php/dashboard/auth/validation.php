<?php
  require_once('../config/parameters.php');
  require_once('../config/connection.php');

  session_start();
  if(isset($_SESSION['nick'])){
    header('Location: ../home.php');
    exit;
  }

  $query = $mysql->prepare("SELECT * FROM users WHERE nick = :nick");
  $query->execute([':nick' => $_POST['nick']]);

  $result = $query->fetchAll();
  foreach ($result as $row) {
    $id = $row['id'];
    $nick = $row['nick'];
    $full_name = $row['full_name'];
    $hash = $row['password'];
    $role = $row['role'];
    $full_name = $row['full_name'];
    break;
  }
  if (password_verify($_POST['password'], $hash)) {
    echo 'Contraseña válida!';
    $_SESSION['id'] = $id;
    $_SESSION['nick'] = $nick;
    $_SESSION['full_name'] = $full_name;
    $_SESSION['role'] = $role;
    $_SESSION['full_name'] = $full_name;
    header('Location: ../home.php');
  } else {
    echo 'La contraseña no es válida';
  }
