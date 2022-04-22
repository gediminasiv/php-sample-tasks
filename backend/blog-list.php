<?php
include 'class/blog.php';
include 'class/form.php';

$blog = new Blog();

$form = new Form([
    [
        'type' => 'select',
        'name' => 'category',
        'placeholder' => 'Select category',
        'values' => [
            [
                'id' => 1,
                'name' => 'Art installation'
            ],
            [
                'id' => 2,
                'name' => 'Print design'
            ],
            [
                'id' => 3,
                'name' => 'Design workshops'
            ],
            [
                'id' => 4,
                'name' => 'Creative kitchen'
            ]
        ]
    ], [
        'type' => 'input',
        'name' => 'title',
        'placeholder' => 'Blog title'
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