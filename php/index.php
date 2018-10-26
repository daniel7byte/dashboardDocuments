<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php

    require_once("dashboard/config/parameters.php");
    require_once("dashboard/config/connection.php");

    $query = $mysql->prepare("SELECT * FROM news WHERE type = :type ORDER BY id DESC");
    $query->execute([':type' => 'Public']);
    $result = $query->fetchAll();

    foreach ($result as $row):
  ?>
  <ul class="notipub">
    <li><?=$row['title']?></li>
    <li><?=$row['description']?></li>
  </ul>
  <?php endforeach; ?>

</body>
</html>
