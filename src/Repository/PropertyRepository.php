<?php

namespace src\Repository;

use lib\DB\Connexion;
use PDO;
use PDOException;
use src\Entity\Property;

class PropertyRepository
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
        $query='SELECT * FROM property';
        
        if($keyword)
        $query=$query.' WHERE address LIKE :keyword OR description like :keyword OR price LIKE :keyword';
        $stmt = $this->pdo->prepare($query);
        if($keyword){
            $keyword='%'.$keyword.'%';
            $stmt->bindParam(':keyword', $keyword);
        }
        
        
        $stmt->execute();

        $properties = [];
        while ($row = $stmt->fetch()) {
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

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM property WHERE propertyId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        $property = new Property();
        $property->setId($row['propertyId']);
        $property->setAddress($row['address']);
        $property->setPrice($row['price']);
        $property->setDescription($row['description']);
        $property->setImage($row['image']);
        $property->setAgentId($row['agentId']);

        return $property;
    }

    public function create(Property $property)
    {
        $stmt = $this->pdo->prepare('INSERT INTO property (address, price, description, image, agentId) VALUES (:address, :price, :description, :image, :agentId)');
        $stmt->bindValue(':address', $property->getAddress());
        $stmt->bindValue(':price', $property->getPrice());
        $stmt->bindValue(':description', $property->getDescription());
        $stmt->bindValue(':image', $property->getImage());
        $stmt->bindValue(':agentId', $property->getAgentId());
        $stmt->execute();

        $property->setId($this->pdo->lastInsertId());
    }

    public function update(Property $property)
    {
        $stmt = $this->pdo->prepare('UPDATE property SET address = :address, price = :price, description = :description, image = :image, agentId = :agentId WHERE propertyId = :id');
        $stmt->bindValue(':address', $property->getAddress());
        $stmt->bindValue(':price', $property->getPrice());
        $stmt->bindValue(':description', $property->getDescription());
        $stmt->bindValue(':image', $property->getImage());
        $stmt->bindValue(':agentId', $property->getAgentId());
        $stmt->bindValue(':id', $property->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM property WHERE propertyId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
