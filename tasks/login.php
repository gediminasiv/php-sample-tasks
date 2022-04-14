<?php

include 'database.php';
include 'form.php';
include 'user.php';

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
    ]
]);

if (isset($_POST['submit'])) {
    $user = new User();

    $existingUser = $user->getUserByUsernameAndPassword(
        $_POST['username'],
        md5($_POST['password'])
    );

    if (!$existingUser) {
        // pranesim apie klaida kazkada
        header('Location: ?page=login');
    }

    $_SESSION['userId'] = $existingUser['id'];
}

?>

<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-body">
                <h3>Prisijungimas</h3>

                <?php $form->generateFormHtml(); ?>
            </div>
        </div>
    </div>
</div>