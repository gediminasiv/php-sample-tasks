<?php
include 'backend/class/blog.php';

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

    $_SESSION['blogAddSuccess'] = 'Naujas įrašas pridėtas sėkmingai';

    header('Location: ?page=blog');
    die;
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="d-flex justify-content-between">
                <h2>Create blog</h2>
            </div>
            <div class="card-body">
                <?= $form->generateFormHtml(); ?>
            </div>
        </div>
    </div>
</div>