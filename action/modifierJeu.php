<?php
require_once "../config/dataBase.php";
require_once "../classes/Jeu.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $id_jeu = $_POST['id_jeu'];
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    
    $jeu = new Jeu($db, $titre, $description, $image_url);
    
    
    if($jeu->modifierJeu($id_jeu)) {
        header("Location: ../Pages/dashbordAdmin.php?success=1");
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
} 