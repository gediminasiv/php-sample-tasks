<?php

class ShoppingList
{
    public $pdo;

    function __construct()
    {
        $this->pdo = new Pdo('mysql:host=localhost;dbname=codeacademy;user=root;password=root');
    }

    function getItems()
    {
        $query = $this->pdo->query('SELECT * FROM shopping_list');

        return $query->fetchAll();
    }

    function addItem($itemName, $itemQuantity)
    {
        $insertQuery = $this->pdo->prepare("INSERT INTO shopping_list SET name=:name, quantity=:quantity");

        $insertQuery->execute([
            'name' => $itemName,
            'quantity' => $itemQuantity
        ]);

        header('Location: ?page=shopping-list-mysql');
    }

    function deleteItem($id)
    {
        $deleteQuery = $this->pdo->prepare("DELETE FROM shopping_list WHERE id=:id");

        $deleteQuery->execute([
            'id' => $id
        ]);

        header('Location: ?page=shopping-list-mysql');
    }

    function getItem($id)
    {
        $selectQuery = $this->pdo->prepare('SELECT * FROM shopping_list WHERE id=:id');

        $selectQuery->execute(['id' => $id]);

        return $selectQuery->fetch();
    }

    function updateItem($id, $itemName, $itemQuantity)
    {
        $updateQuery = $this->pdo->prepare('UPDATE shopping_list SET name=:name, quantity=:quantity WHERE id=:id');

        $updateQuery->execute(([
            'id' => $id,
            'name' => $itemName,
            'quantity' => $itemQuantity
        ]));

        header('Location: ?page=shopping-list-mysql');
    }
}

$shoppingList = new ShoppingList();

$result = $shoppingList->getItems();

if (isset($_POST['add-item'])) { // pridejimo logika
    $shoppingList->addItem($_POST['item'], $_POST['quantity']);
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $shoppingList->deleteItem($_GET['id']);
}

if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $shoppingListItemToEdit = $shoppingList->getItem($_GET['id']);

    if (isset($_POST['edit-item'])) {
        $shoppingList->updateItem($_GET['id'], $_POST['item'], $_POST['quantity']);
    }
}


?>

<div class="row">
    <div class="col">
        <ul class="list-group">
            <?php foreach ($result as $shoppingListItem) { ?>
                <li class="list-group-item">
                    <span>
                        #<?= $shoppingListItem['id']; ?>
                        <?= $shoppingListItem['name']; ?>
                        (<?= $shoppingListItem['quantity']; ?>)
                    </span>

                    <a class="btn btn-success" href="?page=shopping-list-mysql&action=edit&id=<?= $shoppingListItem['id']; ?>">Edit</a>
                    <a class="btn btn-danger" href="?page=shopping-list-mysql&action=delete&id=<?= $shoppingListItem['id']; ?>">Delete</a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="col">
        <form method="post">
            <div class="form-group">
                <label>Koki daikta pridesime i pirkiniu sarasa?</label>
                <input class="form-control" name="item" value="<?= isset($shoppingListItemToEdit) ? $shoppingListItemToEdit['name'] : null; ?>" />
            </div>

            <div class="form-group">
                <label>Kiek to daikto desime i pirkiniu sarasa?</label>
                <input class="form-control" name="quantity" value="<?= isset($shoppingListItemToEdit) ? $shoppingListItemToEdit['quantity'] : null; ?>" />
            </div>

            <?php if (isset($_GET['action']) && $_GET['action'] === 'edit') { ?>
                <input class="btn btn-primary" type="submit" name="edit-item" value="Redaguoti" />
            <?php } else { ?>
                <input class="btn btn-primary" type="submit" name="add-item" value="Ideti" />
            <?php } ?>
        </form>
    </div>
</div>