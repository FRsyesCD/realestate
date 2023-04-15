<?php
namespace src\Entity;
class Favoris {
    private $id;
    private $userId;
    private $propertyId;

    public function __construct() {
  
    }


    // Getters and setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUserId() { return $this->userId; }
    public function setUserId($userId) { $this->userId = $userId; }

    public function getPropertyId() { return $this->propertyId; }
    public function setPropertyId($propertyId) { $this->propertyId = $propertyId; }
}
