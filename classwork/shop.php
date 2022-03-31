<?php

include 'bank-account.class.php';

class StockItem extends FileManager
{
    function __construct()
    {
        parent::__construct('data/stock.json');
    }

    function getAll()
    {
    }

    function buyItem($itemId)
    {
    }
}

$stock = new StockItem();
?>

<div class="row">
    <div class="col">
        <b>Sąskaitos likutis: </b>$250<br />
        <a class="btn btn-primary" href="?page=bank">Prisijungti prie banko (ten galima įsidėti pinigų 😉)</a>
        <hr />
        <p>Mano daiktai:</p>
        <ul class="list-group">
            <li class="list-group-item">Iphone 13</li>
            <li class="list-group-item">Bulviu tarkavimo masina "Migris"</li>
        </ul>
    </div>

    <div class="col">
        <ul class="list-group">
            <li class="list-group-item">
                Iphone 13 ($999.99)
                <span class="badge rounded-pill bg-primary">7 vnt.</span>
                <a class="btn btn-primary disabled" href="#">Pirkti</a>
            </li>
            <li class="list-group-item">
                Bulviu tarkavimo masina "Migris ($89.99)
                <span class="badge rounded-pill bg-primary">10 vnt.</span>
                <a class="btn btn-primary" href="#">Pirkti</a>
            </li>
        </ul>
    </div>
</div>