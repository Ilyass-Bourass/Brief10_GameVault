<?php
require_once "../config/dataBase.php"; 
require_once "../classes/Jeu.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $title = $_POST['titre'];
    $description = $_POST['description'];
    $type = $_POST['image_url'];
    
    

    $jeu=new Jeu($db ,$title,$description,$type);

    if($jeu->ajouterJeu()) {
        header("Location: ../Pages/dashbordAdmin.php?success=1");
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
}
?> 