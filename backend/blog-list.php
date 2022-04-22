<?php
include 'class/blog.php';
include 'class/form.php';

$blog = new Blog();

$form = new Form([
    [
        'type' => 'select',
        'name' => 'category',
        'values' => [
            [
                'id' => 1,
                'name' => 'art deco'
            ]
        ]
    ]
]);

$categories = $blog->getCategories();

?>

<div class="row">
    <div class="col">
        <ul>
            <?php foreach ($categories as $category) { ?>
                <li><?= $category['name']; ?> ?page=blog-list&category=<?= $category['id']; ?></li>
            <?php } ?>
        </ul>
    </div>

    <div class="col">
        <?= $form->generateFormHtml(); ?>
    </div>
</div>