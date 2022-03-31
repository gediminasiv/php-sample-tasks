<?php

include 'files.php';

session_start();
?>

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

    <style>
        .container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

</head>

<body>

    <div class="container">
        <?php

        $page = isset($_GET['page']) ? $_GET['page'] : 'index';


        if ($page === 'index') {
            include 'main.php';
        } else if ($page === 'calc') {
            include 'calculator.php';
        } else if ($page === 'bank') {
            include 'bank.php';
        } else if ($page === 'shop') {
            include 'shop.php';
        }
        ?>
    </div>

</body>

</html>