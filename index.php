<?php session_start(); ?>

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

    $page = isset($_GET['page']) ? $_GET['page'] : 'counter';

    if ($page == 'counter') {
      include 'tasks/counter.php';
    } else if ($page == 'taupykle') {
      include 'tasks/taupykle.php';
    } else if ($page == 'shopping-list') {
      include 'tasks/shopping-list.php';
    } else if ($page === 'guess-the-number') {
      include 'tasks/guess-the-number.php';
    } else if ($page == 'upload') {
      include 'tasks/upload.php';
    } else if ($page === 'movies') {
      include 'tasks/movies.php';
    } else if ($page === 'bank') {
      include 'tasks/bank.php';
    } else if ($page === 'homework_students') {
      include 'tasks/homework.php';
    } else if ($page === 'shopping-list-mysql') {
      include 'tasks/shopping-list-mysql.php';
    }
    ?>
  </div>

</body>

</html>