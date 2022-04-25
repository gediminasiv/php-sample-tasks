<?php

class Blog extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function savePost($categoryId, $title, $content, $imageUrl, $boldedText)
    {
        $date = date('Y-m-d');

        $blogInsertQuery = $this->pdo->prepare('INSERT INTO blog SET
            category_id=:categoryId,
            title=:title,
            content=:content,
            image_url=:imageUrl,
            bolded_text=:boldedText,
            date=:date');

        $blogInsertQuery->execute([
            'categoryId' => $categoryId,
            'title' => $title,
            'content' => $content,
            'imageUrl' => $imageUrl,
            'boldedText' => $boldedText,
            'date' => $date
        ]);
    }

    function getPosts()
    {
        $postsQuery = $this->pdo->prepare('SELECT * FROM blog
            LEFT JOIN blog_category ON blog.category_id = blog_category.id');
        $postsQuery->execute();

        return $postsQuery->fetchAll();
    }

    function getCategories()
    {
        $categoriesQuery = $this->pdo->prepare('SELECT * FROM blog_category');
        $categoriesQuery->execute([]);

        return $categoriesQuery->fetchAll();
    }
}
