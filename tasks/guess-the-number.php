<?php

if (isset($_POST['number'])) {
  $randomNumber = rand(1, $_POST['difficulty']);

  if ($randomNumber == $_POST['number']) {
    echo "<div class='alert alert-success' role='alert'>
    Skaicius atspetas. Buvo $randomNumber - speta $_POST[number]
    </div>";
  } else {
    echo '<div class="alert alert-danger" role="alert">Skaicius neatspetas</div>';
  }
}
?>

<form method="post">
  <div class="form-group">
    <label>Koki skaiciu spesime?</label>
    <input class="form-control" name="number">

  </div>
  <br />
  <div class="form-group">
    <select class="form-select" name="difficulty">
      <option value="3">Lengvas (3 skaičiai)</option>
      <option value="5">Vidutinis (5 skaičiai)</option>
      <option value="7">Sunkus (7 skaičiai)</option>
    </select>
  </div>

  <button class="btn btn-primary" type="submit">Speti!</button>
</form>