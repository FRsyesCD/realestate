<?php

namespace src\Controller;

use lib\View\View;
use src\Repository\LoginRepository;

class DefaultController{
    private $userRepository;
    private $view;

    public function __construct()
    {
        $this->userRepository = new LoginRepository();
        $this->view = new View();
    }

    public function index(){
        echo 'Bonjour dans acceuil';
    }
   
public function login()
    {
        $username = '';
        $password = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = $this->userRepository->findByUsernameAndPassword($username, $password);
            
            if ($user !== null) {
                if ($user->getRole()=="admin") {
                    header('Location: ?action=property_list');
                    
                } else {
                   
                    header('Location: ?action=propertyshop');
                    
                }
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['username'] = $user->getUsername();
                exit();
                
            } else {
                $error = 'Invalid username or password';
                
            }
        }
            $this->view->render('login', [
                'username' => $username,
                'password' => $password,
                'error' => $error,
            ]);
        
    }
public function logout()
    {
        session_start();
        session_destroy();

        header('Location: ?action=login');
        exit();
    }
}