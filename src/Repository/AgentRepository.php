<?php

namespace src\Repository;

use lib\DB\Connexion;
use PDO;
use PDOException;
use src\Entity\Agent;

class AgentRepository
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
        $query='SELECT * FROM agent';
        if($keyword)
        $query=$query.' WHERE nom LIKE :keyword OR prenom like :keyword OR email LIKE :keyword OR phone LIKE :keyword';
        $stmt = $this->pdo->prepare($query);
        if($keyword){
            $keyword='%'.$keyword.'%';
            $stmt->bindParam(':keyword', $keyword);
        }
        $stmt->execute();

        $agents = [];
        while ($row = $stmt->fetch()) {
            $agent = new Agent();
            $agent->setId($row['agentId']);
            $agent->setfirstName($row['prenom']);
            $agent->setlastName($row['nom']);
            $agent->setEmail($row['email']);
            $agent->setPhone($row['phone']);

            $agents[] = $agent;
        }

        return $agents;
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM agent WHERE agentId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch();
        if (!$row) {
            return null;
        }

        $agent = new Agent();
        $agent->setId($row['agentId']);
        $agent->setfirstName($row['prenom']);
        $agent->setlastName($row['nom']);
        $agent->setEmail($row['email']);
        $agent->setPhone($row['phone']);

        return $row;
    }

    public function create(Agent $agent)
    {
        $stmt = $this->pdo->prepare('INSERT INTO agent (prenom, nom, email, phone) VALUES (:first_name, :last_name, :email, :phone)');
        $stmt->bindValue(':first_name', $agent->getfirstName());
        $stmt->bindValue(':last_name', $agent->getlastName());
        $stmt->bindValue(':email', $agent->getEmail());
        $stmt->bindValue(':phone', $agent->getPhone());
        $stmt->execute();

        $agent->setId($this->pdo->lastInsertId());
    }

    public function update(Agent $agent)
    {
        $stmt = $this->pdo->prepare('UPDATE agent SET prenom = :first_name, nom = :last_name, email = :email, phone = :phone WHERE agentId = :id');
        $stmt->bindValue(':first_name', $agent->getfirstName());
        $stmt->bindValue(':last_name', $agent->getlastName());
        $stmt->bindValue(':email', $agent->getEmail());
        $stmt->bindValue(':phone', $agent->getPhone());
        $stmt->bindValue(':id', $agent->getId());
        $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM agent WHERE agentId = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
