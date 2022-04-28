<?php

include 'backend/class/blog.php';

$blog = new Blog();

$posts = $blog->getPosts(null);
?>

<div class="row">
    <div class="col">
        <div class="card">
            <?php if (isset($_SESSION['blogAddSuccess'])) { ?>
                <div class="alert alert-success"><?= $_SESSION['blogAddSuccess']; ?></div>
            <?php
                unset($_SESSION['blogAddSuccess']);
            } ?>

            <div class="d-flex justify-content-between">
                <h2>Blog list</h2>
                <a class="btn btn-primary" href="?page=add-blog">Add post</a>
            </div>

            <ul class="list-group">
                <?php foreach ($posts as $post) { ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>
                            <?= $post['title']; ?>
                        </span>

                        <div>
                            <a href="?page=edit-blog&post=<?= $post['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                            <a href="?page=delete-blog&post=<?= $post['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>