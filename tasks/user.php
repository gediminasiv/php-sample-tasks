<?php

class User extends Database
{
    function __construct()
    {
        parent::__construct();
    }

    function doesUserExist($username)
    {
        $userQuery = $this->pdo->prepare("SELECT * FROM users WHERE username=:name");
        $userQuery->execute(['name' => $username]);

        return $userQuery->fetch();
    }

    function getUserById($id)
    {
        $userQuery = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");
        $userQuery->execute(['id' => $id]);

        return $userQuery->fetch();
    }

    function getUserByUsernameAndPassword($username, $password)
    {
        $userQuery = $this->pdo->prepare("SELECT * FROM users WHERE
        username=:name
        AND password=:password");

        $userQuery->execute([
            'name' => $username,
            'password' => $password
        ]);

        return $userQuery->fetch();
    }
}
