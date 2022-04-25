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
        <div class="card">
            <h2>Categories</h2>
            <ul>
                <?php foreach ($categories as $category) { ?>
                    <li><a href="?page=blog-list&category=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                <?php } ?>
            </ul>
            <h2>Posts</h2>

            <div class="d-flex inline">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <div class="card">
                        <img class="card-img-top" src="data:image/png;base64,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" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p>Category: </p>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="?page=blog-list" class="btn btn-primary stretched-link">Go somewhere</a>
                        </div>
                    </div>
                <?php } ?>

            </div>

        </div>
    </div>

    <div class="col-3">
        <h2>New blog post</h2>

        <?= $form->generateFormHtml(); ?>
    </div>
</div>