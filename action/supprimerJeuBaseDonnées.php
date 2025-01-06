<?php
require_once "../config/dataBase.php"; 
require_once "../classes/Jeu.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $idSupprimer=$_GET['id_supprimer'];
    $database = new Database();
    $db = $database->getConnection();

    $jeu=new Jeu($db,"","","");

    if($jeu->supprimerJeu($idSupprimer)) {
        header("Location: ../Pages/dashbordAdmin.php?success=1");
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
}
?> 