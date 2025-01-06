<?php
require_once "../config/dataBase.php"; 
require_once "../classes/utilsateur.php";

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $idSupprimer=$_GET['id_supprimer'];
    $database = new Database();
    $db = $database->getConnection();

    $Utilisateur=new Utilisateur($db,"","","");

    if($Utilisateur->supprimerutilsateur($idSupprimer)) {
        header("Location: ../Pages/dashbordAdmin.php?success=1");
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
}
?> 