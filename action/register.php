<?php
    require_once '../config/dataBase.php';
    require_once '../classes/utilsateur.php';

    $db = new Database();
    $connex = $db->getConnection();
    $utilisateur = new Utilisateur($connex);

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])){
        $name = htmlspecialchars($_POST['nom']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
    
        $register = $utilisateur->register($name, $email, $password);
        if($register){
            header('location: signin.php');
            exit();
        }else{
            $errors = $utilisateur->getErrors();
        }
    }

?>