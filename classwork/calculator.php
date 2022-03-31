<?php

class Calculator
{
}

?>

<div class="row">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Skaičius 1:</label>
            <input name="firstNumber" type="number" class="form-control" />
        </div>

        <div class="mb-3">
            <label class="form-label">Veiksmas</label>
            <select name="action" class="form-control">
                <option value="add">Sudėti</option>
                <option value="subtract">Atimti</option>
                <option value="multiply">Padauginti</option>
                <option value="division">Padalinti</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Skaičius 2:</label>
            <input name="secondNumber" type="number" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr />

    <div>
        <b>Rezultatas:</b> 8 + 8 = 16
    </div>
</div>