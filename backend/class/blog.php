<?php

class Blog extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function savePost($categoryId, $title, $content, $imageUrl, $boldedText)
    {
    }

    function getPosts()
    {
    }

    function getCategories()
    {
        $categoriesQuery = $this->pdo->prepare('SELECT * FROM blog_category');
        $categoriesQuery->execute([]);

        return $categoriesQuery->fetchAll();
    }
}
