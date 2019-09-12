<?php include 'database.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dan Erics</title>
    <link rel="icon" href="src/images/icon.png">
    <link rel="stylesheet" href="src/css/style.css">

</head>
<div class="topnav">
  <a href="index.php"><img src="src/images/logo.png"></a>
  <div class="login-container">
    <form method="POST">
      <button type="submit" name="logout" id="logout">Logout</button>

      <?php
            if (isset($_POST['logout'])){
                session_destroy();
                header ('location: login.php');
            }
        ?>
    </form>
  </div>
</div>