<?php

class BankAccount
{
    public $balance = 0;
    public $accountNumber;

    function __construct($accountNumber, $balance)
    {
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
    }

    function transferMoney()
    {
    }

    function saveTransactionHistory()
    {
    }

    function deposit($amount)
    {
        if ($amount < 0) {
            return;
        }

        $this->balance += $amount;
        $this->updateData();
    }

    function withdraw($amount)
    {
        if ($amount > $this->balance) {
            return;
        }

        $this->balance -= $amount;
        $this->updateData();
    }

    function updateData()
    {
        $_SESSION['balance'] = $this->balance;
        $_SESSION['accountNumber'] = $this->accountNumber;
    }

    function displayBalance()
    {
        return $this->balance . '$';
    }
}
