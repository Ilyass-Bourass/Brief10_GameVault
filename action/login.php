<?php 
require_once '../config/dataBase.php';
require_once '../classes/utilsateur.php';
$db = new Database();
$connex = $db->getConnection();
$utilisateur = new Utilisateur($connex);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sign_in'])){
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $signin = $utilisateur->signin($email, $password);

    if($signin){
        header('location: index.php');
        exit();
    }else {
        $errors = $utilisateur->getErrors();
    }
}

?>