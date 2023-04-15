<?php

namespace src\Controller;

use lib\View\View;
use src\Repository\PropertyRepository;
use src\Repository\AgentRepository;
use src\Repository\FavorisRepository;
use src\Entity\Property;
use src\Entity\Favoris;

class ShoppingController
{
    private $propertyRepo;
    private $agentRepo;
    private $favoriteRepo;
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
        $this->favoriteRepo = new FavorisRepository();
        $this->view = new View();
    }

    public function index()
    {
        $keyword = null;
        if (isset($_POST["search"])) {
            $keyword = $_POST["search"];
        }
        $properties = $this->propertyRepo->findAll($keyword);

        $this->view->render("buyproperty", ['properties' => $properties, 'username' => $_SESSION['username']]);
    }

    public function addToFavorites()
    {
        
        $favoris=new Favoris();
        echo $_SESSION['user_id'];
        $favoris->setUserId($_SESSION['user_id']);
        $favoris->setPropertyId( $_GET['property_id']);
        $this->favoriteRepo->create($favoris);

        header('Location: ?action=favoris');
    }

    public function viewAgent()
    {
        $agentId = $_GET['agent_id'];

        $agent = $this->agentRepo->findById($agentId);

        
        header('Content-Type: application/json');
    echo json_encode($agent);
    }
    public function favoris()
    {
    $userId = $_SESSION['user_id'];

    
    $favoriteProperties = $this->favoriteRepo->findUserFavoriteProperties($userId);

    $this->view->render("favoris", ['favoriteProperties' => $favoriteProperties]);
    }
    public function removefavoris(){
        $id = $_GET["id"];
        $this->favoriteRepo->delete($id,$_SESSION["user_id"]);

        header("location: ?action=favoris");
        exit();
    }
}
