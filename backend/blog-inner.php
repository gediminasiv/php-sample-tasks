<?php

include 'class/blog.php';

$blog = new Blog();

$post = $blog->getPost($_GET['id']);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <img class="card-img-top" src="<?= $post['image_url']; ?>" alt="<?= $post['title']; ?>">
            <h2><?= $post['title']; ?></h2>
            <p><?= $post['content']; ?></p>
            <p><?= $post['date']; ?></p>
            <p><?= $post['bolded_text']; ?></p>
        </div>
    </div>
</div>