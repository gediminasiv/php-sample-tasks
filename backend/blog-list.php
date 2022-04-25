<?php
include 'class/blog.php';
include 'class/form.php';

$blog = new Blog();

$categories = $blog->getCategories();

$form = new Form([
    [
        'type' => 'select',
        'name' => 'category',
        'placeholder' => 'Select category',
        'values' => $categories
    ],
    [
        'type' => 'file',
        'name' => 'image_url',
        'placeholder' => 'Blog image'
    ],
    [
        'type' => 'input',
        'name' => 'bolded_text',
        'placeholder' => 'Bolded text in blog'
    ],
    [
        'type' => 'input',
        'name' => 'title',
        'placeholder' => 'Blog title'
    ], [
        'type' => 'text',
        'name' => 'content',
        'placeholder' => 'Blog content'
    ]
]);

if (isset($_POST['submit'])) {
    $categoryId = $_POST['category'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $boldedText = $_POST['bolded_text'];

    $filename = 'uploads/' . time() . "_" . $_FILES['image_url']['name'];

    move_uploaded_file($_FILES['image_url']['tmp_name'], $filename);

    $blog->savePost($categoryId, $title, $content, $filename, $boldedText);

    header('Location: ?page=blog-list');
    die;
}

$category = isset($_GET['category']) ? $_GET['category'] : null;

$posts = $blog->getPosts($category);

?>

<div class="row">
    <div class="col">
        <div class="card">
            <h2>Categories</h2>
            <ul>
                <li><a href="?page=blog-list">All</a></li>
                <?php foreach ($categories as $category) { ?>
                    <li><a href="?page=blog-list&category=<?= $category['id']; ?>"><?= $category['name']; ?></a></li>
                <?php } ?>
            </ul>
            <h2>Posts</h2>

            <div class="d-flex inline">
                <?php foreach ($posts as $post) { ?>
                    <div class="card">
                        <img class="card-img-top" src="<?= $post['image_url']; ?>" alt="<?= $post['title']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $post['title']; ?></h5>

                            <p>Category: <?= $post['name']; ?></p>

                            <p class="card-text"><?= substr($post['content'], 0, 100); ?>...</p>

                            <a href="?page=blog-inner&id=<?= $post['id']; ?>" class="btn btn-primary stretched-link">
                                Learn more
                            </a>
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