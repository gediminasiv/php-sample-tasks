<?php

include 'backend/class/form.php';

$form = new Form([]);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <?php $form->generateFormHtml(); ?>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('contact-form');

    console.log(form);
</script>