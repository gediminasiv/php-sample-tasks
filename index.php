<?php
include 'tasks/database.php';
include 'tasks/user.php';

session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="css/main.css" />
  <script src="js/bootstrap.min.js"></script>

  <title>Document</title>
</head>

<body>

  <?php
  include 'menu.php';
  ?>

  <div class="container">
    <?php

    $page = isset($_GET['page']) ? $_GET['page'] : 'movies';

    if ($page === 'movies') {
      include 'tasks/movies.php';
    } else if ($page === 'register') {
      include 'tasks/register.php';
    } else if ($page === 'login') {
      include 'tasks/login.php';
    }
    ?>
  </div>
  <script src="js/app.js"></script>
</body>

</html>