<?php

include 'form.php';

class BankAccount
{
    public $balance = 0;
    public $accountNumber;

    function __construct($accountNumber, $balance)
    {
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }

    function deposit($amount)
    {
        $this->balance += $amount;
        $this->updateFile();
    }

    function withdraw($amount)
    {
        if ($amount > $this->balance) {
            return;
        }

        $this->balance -= $amount;
        $this->updateFile();
    }

    function updateFile()
    {
        $_SESSION['balance'] = $this->balance;
        $_SESSION['accountNumber'] = $this->accountNumber;
    }

    function displayBalance()
    {
        return $this->balance . '$';
    }
}

if (!isset($_SESSION['accountNumber'])) {
    $_SESSION['accountNumber'] = 'LT' . rand(100000, 999999);
    $_SESSION['balance'] = 0;
}

$bankAccount = new BankAccount($_SESSION['accountNumber'], $_SESSION['balance']);

if (isset($_POST['submit'])) {
    $action = $_POST['action'];

    if ($action === 'deposit') {
        $bankAccount->deposit($_POST['amount']);
    } else if ($action === 'withdraw') {
        $bankAccount->withdraw($_POST['amount']);
    }

    header('Location: /?page=bank');
}

?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <b>Sąskaitos numeris:</b> <?= $bankAccount->accountNumber; ?><br />
                <b>Sąskaitos likutis:</b> <?= $bankAccount->displayBalance(); ?>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="number" class="form-control" name="amount" placeholder="Amount" />
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Action:</label>
                        <select name='action' class="form-control" id="exampleFormControlSelect1">
                            <option value="deposit">Deposit</option>
                            <option value="withdraw">Withdraw</option>
                        </select>
                    </div>

                    <input type="submit" name="submit" value="Ikelti" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>