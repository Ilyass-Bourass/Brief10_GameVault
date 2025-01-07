<?php
require_once "../config/dataBase.php"; 
require_once "../classes/Jeu.php";
require_once "../classes/commentaire.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    $database = new Database();
    $connex = $database->getConnection();
    $message = $_POST['commentaire'];
    $GameId=$_POST['GameId'];
    $id_user=$_SESSION['user_id'];

    $newCommentaire=new Commentaire($connex);

    
    
    if($newCommentaire->EnvoyerCommentaire($GameId, $id_user,$message)) {
        header('location: ../pages/détails.php?idGame='. $GameId);
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
}
?> 