<?php

class Calculator
{
    public $numberOne;
    public $numberTwo;

    function __construct($numberOne, $numberTwo)
    {
        $this->numberOne = $numberOne;
        $this->numberTwo = $numberTwo;
    }

    function handleRequest($action)
    {
        if ($action === 'add') {
            return $this->add();
        } else if ($action === 'subtract') {
            return $this->subtract();
        } else if ($action === 'multiply') {
            return $this->multiply();
        } else if ($action === 'division') {
            return $this->divide();
        }
    }

    function add()
    {
        return $this->numberOne + $this->numberTwo;
    }

    function subtract()
    {
        return $this->numberOne - $this->numberTwo;
    }

    function multiply()
    {
        return $this->numberOne * $this->numberTwo;
    }

    function divide()
    {
        return $this->numberOne / $this->numberTwo;
    }

    function getActionSign($action)
    {
        if ($action === 'add') {
            return '+';
        } else if ($action === 'subtract') {
            return '-';
        } else if ($action === 'multiply') {
            return 'x';
        } else if ($action === 'division') {
            return ':';
        }
    }
}

if (isset($_POST['action'])) {
    $calculator = new Calculator($_POST['firstNumber'], $_POST['secondNumber']);

    $calculator->handleRequest($_POST['action']);
}

?>

<div class="row">
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Skaičius 1:</label>
            <input name="firstNumber" value="<?= isset($_POST['firstNumber']) ? $_POST['firstNumber'] : null; ?>" type="number" class="form-control" />
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
            <input name="secondNumber" value="<?= isset($_POST['secondNumber']) ? $_POST['secondNumber'] : null; ?>" type="number" type="number" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <hr />

    <?php if (isset($_POST['action'])) { ?>
        <div>
            <b>Rezultatas:</b>
            <?= $calculator->numberOne; ?>
            <?= $calculator->getActionSign($_POST['action']); ?>
            <?= $calculator->numberTwo; ?> = <?= $calculator->handleRequest($_POST['action']); ?>
        </div>
    <?php } ?>

</div>