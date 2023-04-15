<?php

namespace src\Repository;

use lib\DB\Connexion;
use PDO;
use PDOException;
use src\Entity\Login;

class LoginRepository
{
    private $pdo;

    public function __construct()
    {
        $connexion = new Connexion();
        $pdo = $connexion->getPdo();
        $this->pdo = $pdo;
    }

    public function findAll($keyword)
    {
        $query='SELECT * FROM login';
        if($keyword)
        $query=$query.' WHERE username LIKE :keyword OR role like :keyword OR password LIKE :keyword';
        $stmt = $this->pdo->prepare($query);
        if($keyword){
            $keyword='%'.$keyword.'%';
            $stmt->bindParam(':keyword', $keyword);
        }
        
        $stmt->execute();

        $logins = [];
        while ($row = $stmt->fetch()) {
            $login = new Login();
            $login->setId($row['loginId']);
            $login->setUsername($row['username']);
            $login->setPassword($row['password']);
            $login->setRole($row['role']);

            $logins[] = $login;
        }

        return $logins;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM login WHERE loginId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        $login = new Login();
        $login->setId($row['loginId']);
        $login->setUsername($row['username']);
        $login->setPassword($row['password']);
        $login->setRole($row['role']);

        return $login;
    }

    public function create(Login $login)
    {
        $stmt = $this->pdo->prepare('INSERT INTO login (username, password, role) VALUES (:username, :password, :role)');
        $stmt->bindValue(':username', $login->getUsername());
        $stmt->bindValue(':password', $login->getPassword());
        $stmt->bindValue(':role', $login->getRole());
        $stmt->execute();

        $login->setId($this->pdo->lastInsertId());
    }

    public function update(Login $login)
    {
        $stmt = $this->pdo->prepare('UPDATE login SET username = :username, password = :password, role = :role WHERE loginId = :id');
        $stmt->bindValue(':username', $login->getUsername());
        $stmt->bindValue(':password', $login->getPassword());
        $stmt->bindValue(':role', $login->getRole());
        $stmt->bindValue(':id', $login->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM login WHERE loginId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function findByUsernameAndPassword($username, $password)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM login WHERE username = :username AND password = :password');
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        $login = new Login();
        $login->setId($row['loginId']);
        $login->setUsername($row['username']);
        $login->setPassword($row['password']);
        $login->setRole($row['role']);

        return $login;
    }
}
