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
        return;
    }

    if ($_POST['password'] !== $_POST['passwordRepeat']) {
        $_SESSION['registerError'] = 'Jūsų slaptažodžiai nesutampa';
        // dar vienas klaidos aprasymo pridejimas
        header('Location: ?page=register');
        return;
    }

    $newUser = [
        'username' => $_POST['username'],
        'password' => md5($_POST['password']) //todo: change to better encoding
    ];

    $userQuery = $form->pdo->prepare("INSERT INTO users SET username=:username, password=:password");
    $userQuery->execute($newUser);

    // sekmes pranesimo aprasymo pridejimas

    header('Location: ?page=register');
}

if (isset($_POST['submit'])) {
    registerUser();
}

function generateAlert($alertText, $alertType)
{
    return '<div class="alert ' . $alertType . '">' . $alertText . '</div>';
}

?>

<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-body">
                <h3>Registracija</h3>

                <?= generateAlert('Jūsų registracija sėkminga! Galite prisijungti.', 'alert-success'); ?>

                <?php if (isset($_SESSION['registerError'])) { ?>
                    <?= generateAlert('Viena is dvieju klaida', 'alert-danger'); ?>
                <?php } ?>

                <?php $form->generateFormHtml(); ?>
            </div>
        </div>
    </div>
</div>