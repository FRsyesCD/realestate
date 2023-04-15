<?php

namespace src\Controller;

use lib\View\View;
use src\Repository\PropertyRepository;
use src\Repository\AgentRepository;
use src\Entity\Property;

class PropertyController
{
    private $propertyRepo;
    private $agentRepo;
    private $view;

    public function __construct()
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
        $this->propertyRepo = new PropertyRepository();
        $this->agentRepo = new AgentRepository();
        $this->view = new View();
    }

    public function index()
    {
        $keyword = null;
        if (isset($_GET["keyword"])) {
            $keyword = $_GET["keyword"];
        }
        $properties = $this->propertyRepo->findAll($keyword);
        
        
        $this->view->render("property/propertylist", ['properties' => $properties,'username'=>$_SESSION['username']]);
    }

    public function add()
    {
        $agents = $this->agentRepo->findAll(null);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $property = new Property();
            $property->setAddress($_POST["address"]);
            $property->setPrice($_POST["price"]);
            $property->setDescription($_POST["description"]);
            $property->setAgentId($_POST["agentId"]);
            $image = $_FILES["image"];
            $uploadDir = "uploads/";
            $uploadFile = $uploadDir . basename($image["name"]);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedExtensions = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $allowedExtensions)) {
                if (move_uploaded_file($image["tmp_name"], $uploadFile)) {
                    $property->setImage($uploadFile);
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Invalid file type.";
            }

            $this->propertyRepo->create($property);

            header("location: ?action=property_list");
            exit();
        }

        $this->view->render("property/addnewproperty", ['agents' => $agents,'username'=>$_SESSION['username']]);
    }

    public function edit()
    {
        $agents = $this->agentRepo->findAll(null);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $property =$this->propertyRepo->findById($id);
            $property->setId($_POST["id"]);
            $property->setAddress($_POST["address"]);
            $property->setPrice($_POST["price"]);
            $property->setDescription($_POST["description"]);
            $property->setAgentId($_POST["agentId"]);

            // check if new image uploaded
            if (!empty($_FILES["image"]["name"])) {
                $image = $_FILES["image"];
                $uploadDir = "uploads/";
                $uploadFile = $uploadDir . basename($image["name"]);
                $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
                $allowedExtensions = array("jpg", "jpeg", "png", "gif");

                if (in_array($imageFileType, $allowedExtensions)) {
                    if (move_uploaded_file($image["tmp_name"], $uploadFile)) {
                        $property->setImage($uploadFile);
                    } else {
                        echo "Error uploading file.";
                    }
                } else {
                    echo "Invalid file type.";
                }
            }

            $this->propertyRepo->update($property);

            header("location: ?action=property_list");
            exit();
        }

        $id = $_GET["id"];
        $property = $this->propertyRepo->findById($id);
        $this->view->render("property/editproperty", ['agents' => $agents,'property'=>$property,'username'=>$_SESSION['username']]);
    }

    public function delete() {
        $id = $_GET["id"];
        $this->propertyRepo->delete($id);

        header("location: ?action=property_list");
        exit();
    }

}

