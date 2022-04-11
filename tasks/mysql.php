<?php

$pdo = new PDO('mysql:host=localhost;dbname=codeacademy_test;user=root;password=root');

<?php/*
var_dump($_POST);
// die;

if (isset($_POST['save-fruit'])) {
    $sql = "INSERT INTO fruits SET name=:name";
    $insertQuery = $pdo->prepare($sql);
    $insertQuery->execute(['name' => $_POST['fruit-name']]);

    header('Location: ?page=mysql');
}

if (isset($_POST['update-fruit'])) {
    $sql = "UPDATE fruits SET name=:name WHERE id=:id";
    $updateQuery = $pdo->prepare($sql);
    $updateQuery->execute(['name' => $_POST['fruit-name'], 'id' => $_POST['id']]);

    header('Location: ?page=mysql');
}

$fruitQuery = $pdo->query("SELECT * FROM fruits");
$fruits = $fruitQuery->fetchAll();

if (isset($_GET['subpage']) && $_GET['subpage'] === 'edit') {
    $singleFruitQuery = $pdo->prepare("SELECT * FROM fruits WHERE id=:id");

    $singleFruitQuery->execute(['id' => $_GET['id']]);
    $fruit = $singleFruitQuery->fetch();
}

?>

<div class="row">
    <div class="col">
        <ul class="list-group">
            <?php if (!isset($_GET['subpage'])) { ?>
                <?php foreach ($fruits as $fruit) { ?>
                    <li class="list-group-item">
                        <?= $fruit['name']; ?>

                        <a class="btn btn-success" href="?page=mysql&subpage=edit&id=<?= $fruit['id']; ?>">Redaguoti</a>
                        <a class="btn btn-danger" href="?page=mysql&subpage=delete&id=<?= $fruit['id']; ?>">Ištrinti</a>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <form method="post">
                    <div class="form-group">
                        <label>Vaisiaus vardas</label>
                        <input class="form-control" name="fruit-name" value="<?= $fruit['name']; ?>" />
                        <input type="hidden" value="<?= $fruit['id']; ?>" name="id" />
                    </div>

                    <button class="btn btn-primary" type="submit" name="update-fruit">Speti!</button>
                </form>
            <?php } ?>

        </ul>
    </div>
    <div class="col">
        <form method="post">
            <div class="form-group">
                <label>Vaisiaus vardas</label>
                <input class="form-control" name="fruit-name">

            </div>

            <button class="btn btn-primary" type="submit" name="save-fruit">Issaugoti</button>
        </form>
    </div>
</div>
*/ ?>