<?php

include 'bank-account.class.php';

$bankAccount = new BankAccount($_SESSION['accountNumber'], $_SESSION['balance']);

if (isset($_POST['submit'])) {
    $action = $_POST['action'];

    if ($action === 'deposit') {
        $bankAccount->deposit($_POST['amount']);
    } else if ($action === 'withdraw') {
        $bankAccount->withdraw($_POST['amount']);
    }

    header('Location: ?page=bank');
}

?>
<div class="row">
    <div class="col">
        <p>Šitas var_dump'as nėra paliktas netyčia ir yra skirtas apsižiūrėti, kaip skiriasi POST'inimas iš dviejų formų.
            Atkreipkite dėmesį į parametrus <i>submit*</i>:</p>
        <?= var_dump($_POST); ?>
    </div>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <b>Sąskaitos numeris:</b> <?= $bankAccount->accountNumber; ?><br />
                <b>Sąskaitos likutis:</b> <?= $bankAccount->displayBalance(); ?>
            </div>

            <div class="card-body">
                <form method="post">

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
    <div class="col">
        <div class="card">
            <div class="card-body">
                <h4>Banko klientai:</h4>

                <form method="post">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Banko klientai:</label>
                        <select name='action' class="form-control" id="exampleFormControlSelect1">
                            <option value="LT821580">LT821580 ($100)</option>
                            <option value="LT293818">LT293818 ($200)</option>
                            <option value="LT141234">LT141234 ($200)</option>
                        </select>
                    </div>
                    <br />

                    <div class="form-group">
                        <input type="number" class="form-control" name="amount" placeholder="Amount" />
                    </div>
                    <br />
                    <input type="submit" name="submit-bank-client-action" value="Pervesti" class="btn btn-primary" />
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .row {
        width: 100%;
    }
</style>