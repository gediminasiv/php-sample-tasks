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
    ]
]);

function login()
{
    $user = new User();

    $existingUser = $user->getUserByUsernameAndPassword(
        $_POST['username'],
        md5($_POST['password'])
    );

    if (!$existingUser) {
        // pranesim apie klaida kazkada
        header('Location: ?page=login');
        return;
    }

    $_SESSION['userId'] = $existingUser['id'];
}

if (isset($_POST['submit'])) {
    login();
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