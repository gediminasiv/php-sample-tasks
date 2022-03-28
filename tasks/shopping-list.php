<?php
function saveAndRefreshPage($shoppingListArray)
{
  $shoppingListString = implode("\n", $shoppingListArray);
  file_put_contents('data/shopping-list.txt', $shoppingListString);
  header('Location: /?page=shopping-list'); // perkrauna puslapi, kad jame neuzsiliktu get parametras `delete` 
}
?>

<div class="row">
  <div class="col">
    <?php

    $shoppingListString = file_get_contents('data/shopping-list.txt');

    $shoppingList = explode("\n", $shoppingListString);

    if (empty($shoppingList[0])) { // jeigu apdorojus musu faila, pirkiniu krepselis tuscias, nustatom ji kaip tuscia masyva
      $shoppingList = [];
    }

    // delete logika
    if (isset($_GET['delete']) && !isset($_POST['productName'])) {
      $idToDelete = $_GET['delete'];

      foreach ($shoppingList as $key => $shoppingItem) {
        $itemInfo = explode('|', $shoppingItem);

        if ($itemInfo[0] == $idToDelete) {
          unset($shoppingList[$key]);
        }
      }

      saveAndRefreshPage($shoppingList);
    }

    // insert logika
    if (isset($_POST['productName'])) {
      $id = time();
      $shoppingList[] = "$id|$_POST[productName]" . "|" . $_POST['quantity'];

      saveAndRefreshPage($shoppingList);
    }

    if (count($shoppingList) > 0) { // tikrinam ar musu sarase is viso yra prekiu
      foreach ($shoppingList as $shoppingItem) {
        $itemInfo = explode('|', $shoppingItem);

        echo $itemInfo[1] . "($itemInfo[2])
    <a href='?page=shopping-list&delete=$itemInfo[0]' class='btn btn-danger btn-sm'>Istrinti</a><br />";
      }
    } else { // jeigu ne, atvaizduojame klaidos pranesima 
    ?>
      <div class="alert alert-warning">Pirkiniu sarase nera prekiu :(</div>
    <?php }

    ?>
  </div>

  <div class="col">
    <form method="post">
      <div class="form-group">
        <label>Kokia preke desime i krepseli? </label>
        <input class="form-control" name="productName">
      </div>

      <div class="form-group">
        <label>Kiek prekes desime i krepseli?</label>
        <input class="form-control" name="quantity">
      </div>

      <button class="btn btn-primary" type="submit">Ideti</button>
    </form>
  </div>

</div>