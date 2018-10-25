<?php
  session_start();
  session_unset();
  session_destroy();

  if(!isset($_SESSION['usuario'])){
    header('Location: ../signin.php');
    exit;
  }