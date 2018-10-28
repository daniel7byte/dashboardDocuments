<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  function post_captcha($user_response) {
    $fields_string = '';
    $fields = array(
      'secret' => '6LcyGncUAAAAANFRddzBm_aXEuaSH84OdwghU-td',
      'response' => $user_response
    );
    foreach($fields as $key=>$value)
    $fields_string .= $key . '=' . $value . '&';
    $fields_string = rtrim($fields_string, '&');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
    curl_setopt($ch, CURLOPT_POST, count($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
  }

  // Call the function post_captcha
  $res = post_captcha($_POST['g-recaptcha-response']);

  if (!$res['success']) {
    // What happens when the reCAPTCHA is not properly set up
    echo 'reCAPTCHA error: Check to make sure your keys match the registered domain and are in the correct locations. You may also want to doublecheck your code for typos or syntax errors.';
  } else {
    // If CAPTCHA is successful...

    // Paste mail function or whatever else you want to happen here!

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
  }
}


