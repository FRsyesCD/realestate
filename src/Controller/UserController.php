<?php

namespace src\Controller;

use lib\View\View;
use src\Repository\LoginRepository;
use src\Entity\Login;


class UserController {

    private $loginRepo;
    private $view;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?action=login");
            exit;
        }
        $this->loginRepo = new LoginRepository();
        $this->view=new View();
    }

    public function index() {
        $keyword=null;
        if(isset($_GET["keyword"])){
            $keyword=$_GET["keyword"];
        }
        $logins = $this->loginRepo->findAll($keyword);
        $this->view->render("login/userlist", ['logins' => $logins,'username'=>$_SESSION['username']]);
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $login=new Login();
            $login->setUsername($_POST["username"]);
        $login->setPassword( $_POST["password"]);
        $login->setRole($_POST["role"]);

           

            $this->loginRepo->create($login);

            header("location: ?action=login_list");
            exit();
        }
        $this->view->render("login/addnewuser",['username'=>$_SESSION['username']]);
    }

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"];
            $login=new Login();
            $login->setId($_POST["id"]);
            $login->setUsername($_POST["username"]);
        $login->setPassword( $_POST["password"]);
        $login->setRole($_POST["role"]);

           
            $this->loginRepo->update($login);

            header("location: ?action=login_list");
            exit();
        }

        $id = $_GET["id"];
        $login = $this->loginRepo->findById($id);
        $this->view->render("login/edituser", ['login' => $login,'username'=>$_SESSION['username']]);
    }

    public function delete() {
        $id = $_GET["id"];
        $this->loginRepo->delete($id);

        header("location: ?action=login_list");
        exit();
    }

}

?>
