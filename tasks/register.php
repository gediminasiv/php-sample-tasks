<?php
include 'database.php';
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
?>

<div class="row">
    <div class="col-4 offset-4">
        <div class="card">
            <div class="card-body">
                <h3>Registracija</h3>

                <?php $form->generateFormHtml(); ?>
            </div>
        </div>
    </div>
</div>

<?php

var_dump('test');
