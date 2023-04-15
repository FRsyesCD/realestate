<?php
namespace src\Entity;

class Property {
    private $id;
    private $address;
    private $price;
    private $description;
    private $image;
    private $agentId;

    public function __construct() {
  
    }


// Getters and setters
public function getId() { return $this->id; }
public function setId($id) { $this->id = $id; }

public function getAddress() { return $this->address; }
public function setAddress($address) { $this->address = $address; }

public function getPrice() { return $this->price; }
public function setPrice($price) { $this->price = $price; }

public function getDescription() { return $this->description; }
public function setDescription($description) { $this->description = $description; }

public function getImage() { return $this->image; }
public function setImage($image) { $this->image = $image; }

public function getAgentId() { return $this->agentId; }
public function setAgentId($agentId) { $this->agentId = $agentId; }
}