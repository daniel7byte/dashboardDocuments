<?php

  session_start();
  if(!isset($_SESSION['nick'])){
    header('Location: signin.php');
    exit;
  } else {
  	header('Location: home.php');
  	exit;
  }