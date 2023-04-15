<?php

namespace src\Repository;

use lib\DB\Connexion;
use PDO;
use PDOException;
use src\Entity\Favoris;
use src\Entity\Property;

class FavorisRepository
{
    private $pdo;

    public function __construct()
    {
        $connexion = new Connexion();
        $pdo = $connexion->getPdo();
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM userfavoriteproperty');
        $stmt->execute();

        $favorites = [];
        while ($row = $stmt->fetch()) {
            $favorite = new Favoris();
            $favorite->setId($row['favoriteId']);
            $favorite->setUserId($row['userId']);
            $favorite->setPropertyId($row['propertyId']);

            $favorites[] = $favorite;
        }

        return $favorites;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM userfavoriteproperty WHERE favoriteId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        $favorite = new Favoris();
        $favorite->setId($row['favoriteId']);
        $favorite->setUserId($row['userId']);
        $favorite->setPropertyId($row['propertyId']);

        return $favorite;
    }

    public function create(Favoris $favorite)
    {
        $stmt = $this->pdo->prepare('INSERT INTO userfavoriteproperty (userId, propertyId) VALUES (:user_id, :property_id)');
        $stmt->bindValue(':user_id', $favorite->getUserId());
        $stmt->bindValue(':property_id', $favorite->getPropertyId());
        $stmt->execute();

        $favorite->setId($this->pdo->lastInsertId());
    }

    public function update(Favoris $favorite)
    {
        $stmt = $this->pdo->prepare('UPDATE userfavoriteproperty SET userId = :user_id, propertyId = :property_id WHERE favoriteId = :id');
        $stmt->bindValue(':user_id', $favorite->getUserId());
        $stmt->bindValue(':property_id', $favorite->getPropertyId());
        $stmt->bindValue(':id', $favorite->getId());
        $stmt->execute();
    }

    public function delete($id,$userId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM userfavoriteproperty WHERE propertyId = :id AND userId= :userId');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();
    }
    public function findUserFavoriteProperties($userId)
{
    $stmt = $this->pdo->prepare("
        SELECT p.*
        FROM property p
        JOIN userfavoriteproperty ufp ON p.propertyId = ufp.propertyId
        WHERE ufp.userId = :userId
    ");
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();

    $properties = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $property = new Property();
        $property->setId($row['propertyId']);
        $property->setAddress($row['address']);
        $property->setPrice($row['price']);
        $property->setDescription($row['description']);
        $property->setImage($row['image']);
        $property->setAgentId($row['agentId']);

        $properties[] = $property;
    }

    return $properties;
}

}
