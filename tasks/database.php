<?php

class Database
{
    public $pdo;

    function __construct()
    {
        $this->pdo = new Pdo('mysql:host=localhost;dbname=codeacademy;user=root;password=root');
    }
}
