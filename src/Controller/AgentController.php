<?php

namespace src\Controller;

use lib\View\View;
use src\Repository\AgentRepository;
use src\Entity\Agent;

class AgentController {

    private $agentRepo;
    private $view;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
        $this->agentRepo = new AgentRepository();
        $this->view = new View();
    }

    public function index() {
        $keyword=null;
        if(isset($_GET["keyword"])){
            $keyword=$_GET["keyword"];
        }
        $agents = $this->agentRepo->findAll($keyword);
        $this->view->render("agent/agentlist", ['agents' => $agents,'username'=>$_SESSION['username']]);
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $agent = new Agent();
            $agent->setfirstName($_POST["firstname"]);
            $agent->setlastName($_POST["lastname"]);
            $agent->setEmail($_POST["email"]);
            $agent->setPhone($_POST["phone"]);

            $this->agentRepo->create($agent);

            header("location: ?action=agent_list");
            exit();
        }
        $this->view->render("agent/addnewagent",['username'=>$_SESSION['username']]);
    }

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $agent = new Agent();
            $agent->setId($_POST["id"]);
            $agent->setfirstName($_POST["firstname"]);
            $agent->setlastName($_POST["lastname"]);
            $agent->setEmail($_POST["email"]);
            $agent->setPhone($_POST["phone"]);

            $this->agentRepo->update($agent);

            header("location: ?action=agent_list");
            exit();
        }

        $id = $_GET["id"];
        $agent = $this->agentRepo->findById($id);
        $this->view->render("agent/editagent", ['agent' => $agent,'username'=>$_SESSION['username']]);
    }

    public function delete() {
        $id = $_GET["id"];
        $this->agentRepo->delete($id);

        header("location: ?action=agent_list");
        exit();
    }

}

