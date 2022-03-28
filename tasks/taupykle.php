<?php

if (!isset($_SESSION['amount'])) {
  $_SESSION['amount'] = 0;
}

$sessionAmount = $_SESSION['amount'];

if (isset($_POST['amount']) && !empty($_POST['amount'])) {
  $sessionAmount += $_POST['amount'];

  $_SESSION['amount'] = $sessionAmount;
}

$items = [
  [
    'name' => 'Playstation 5',
    'price' => 849.99
  ],
  [
    'name' => 'Iphone 13',
    'price' => 999.99
  ],
  [
    'name' => 'Bulviu tarkavimo masina migris',
    'price' => 89.99
  ],
  [
    'name' => 'Mikrobangų krosnelė DOMO DO2342CG',
    'price' => 253
  ]
];

if (isset($_GET['buy'])) {
  if (!isset($items[$_GET['buy']])) {
    echo "Tokia prekė neegzistuoja";
  } else {
    $itemToBuy = $items[$_GET['buy']];

    if ($sessionAmount < $itemToBuy['price']) {
      echo "Taupyklėje nepridėta pakankamai pinigų.";
    } else {
      $sessionAmount -= $itemToBuy['price'];

      $_SESSION['amount'] = $sessionAmount;
?>
      <script>
        window.location.href = '?page=taupykle';
      </script>
  <?php
    }
  }
}

if (isset($_GET['deleteAll'])) {
  session_destroy();
  ?>
  <script>
    window.location.href = '?page=taupykle';
  </script>
<?php
}

?>

<div class="row">
  <div class="col">
    <form method="post">
      <div class="form-group">
        <label>Kiek pinigu desime i taupykle? </label>
        <input type="number" class="form-control" name="amount">

        <button class="btn btn-primary" type="submit">Ideti</button>
      </div>
    </form>

    <p>Taupykleje yra: <?= $sessionAmount; ?> €</p>
  </div>

  <div class="col">
    <a class="btn btn-primary" href="?page=taupykle&deleteAll">Istustinti taupykle</a>
  </div>

  <div class="col">
    <ul>
      <?php
      foreach ($items as $index => $item) {
        $canWeAfford = $item['price'] <= $sessionAmount;

        echo "<li>" . $item['name'] . "($item[price]€)";

        if ($canWeAfford) {
          echo '<span class="badge bg-success">Iperkama</span>';
        } else {
          echo "<span class='badge bg-danger'>Neiperkama</span>";
        }
        echo "<a class='btn btn-primary' href='?page=taupykle&buy=$index'>Pirkti</a>";
        echo "</li>";
      }
      ?>
    </ul>
  </div>
</div>