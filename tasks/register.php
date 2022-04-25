<?php

include 'form.php';

$form = new Form([
    [
        'name' => 'username',
        'placeholder' => 'Username',
        'type' => 'text'
    ],
    [
        'name' => 'password',
        'placeholder' => 'Password',
        'type' => 'password'
    ],
    [
        'name' => 'passwordRepeat',
        'placeholder' => 'Password (repeat)',
        'type' => 'password'
    ],
]);

function registerUser()
{
    $form = new Form([]);
    $user = new User();
    $existingUser = $user->doesUserExist($_POST['username']);

    if ($existingUser) {
        $_SESSION['registerError'] = 'Šis vartotojas užregistruotas';

        header('Location: ?page=register');
        die;
    }

    if ($_POST['password'] !== $_POST['passwordRepeat']) {
        $_SESSION['registerError'] = 'Jūsų slaptažodžiai nesutampa';
        // dar vienas klaidos aprasymo pridejimas
        header('Location: ?page=register');
        die;
    }

    $newUser = [
        'username' => $_POST['username'],
        'password' => md5($_POST['password']) //todo: change to better encoding
    ];

    $userQuery = $form->pdo->prepare("INSERT INTO users SET username=:username, password=:password");
    $userQuery->execute($newUser);

    // sekmes pranesimo aprasymo pridejimas

    $_SESSION['registerSuccess'] = 'Jūsų registracija sėkminga! Galite prisijungti';

    header('Location: ?page=register');
    die;
}

if (isset($_POST['submit'])) {
    registerUser();
}

function generateAlert($alertText, $alertType)
{
    $_SESSION['registerError'] = '';
    $_SESSION['registerSuccess'] = '';

    return '<div class="alert ' . $alertType . '">' . $alertText . '</div>';
}

?>

<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-body">
                <h3>Registracija</h3>

                <?php if (isset($_SESSION['registerSuccess']) && !empty($_SESSION['registerSuccess'])) { ?>
                    <?= generateAlert($_SESSION['registerSuccess'], 'alert-success'); ?>
                <?php
                } ?>

                <?php if (isset($_SESSION['registerError']) && !empty($_SESSION['registerError'])) { ?>
                    <?= generateAlert($_SESSION['registerError'], 'alert-danger'); ?>
                <?php
                } ?>

                <?php $form->generateFormHtml(); ?>
            </div>
        </div>
    </div>
</div>