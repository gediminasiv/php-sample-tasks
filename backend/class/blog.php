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

    function getPosts($categoryId)
    {
        $query = 'SELECT blog.id,
            blog_category.name,
            blog.title,
            blog.content,
            blog.image_url,
            blog.bolded_text,
            blog.date FROM blog
        LEFT JOIN blog_category ON blog.category_id = blog_category.id';
        $params = [];

        if ($categoryId) {
            $query .= ' WHERE blog.category_id = :categoryId';
            $params = [
                'categoryId' => $categoryId
            ];
        }

        $postsQuery = $this->pdo->prepare($query);
        $postsQuery->execute($params);

        return $postsQuery->fetchAll();
    }

    function getPost($id)
    {
        $postQuery = $this->pdo->prepare('SELECT * FROM blog WHERE id=:id');
        $postQuery->execute(['id' => $id]);

        return $postQuery->fetch();
    }

    function getCategories()
    {
        $categoriesQuery = $this->pdo->prepare('SELECT * FROM blog_category');
        $categoriesQuery->execute([]);

        return $categoriesQuery->fetchAll();
    }
}
