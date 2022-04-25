<?php
session_start();

include 'backend/class/database.php';
include 'backend/class/user.php';
include 'backend/class/form.php';
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
    <title>Admin backend</title>
</head>

<body>
    <div class="container">
        <?php if (!isset($_SESSION['userId'])) {
            include 'backend/admin/login.php';
        } else { ?>
            Vartotojas prisijungęs
        <?php } ?>
    </div>
</body>

</html>