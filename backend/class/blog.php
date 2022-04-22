<?php

class Blog extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function getCategories()
    {
        $categoriesQuery = $this->pdo->prepare('SELECT * FROM blog_category');
        $categoriesQuery->execute();

        return $categoriesQuery->fetchAll();
    }
}
