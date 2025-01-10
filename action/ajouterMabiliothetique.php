<?php
    require_once "../config/dataBase.php";
    require_once "../classes/bibliothéque.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_user = $_POST['userId'];
        $id_jeu = $_POST['idGame'];

        $db=new Database();
        $conn=$db->getConnection();

        $biblio=new Bibliothéque($conn);

        $game_name = $biblio->selectNameGame($id_jeu)['titre'];
        $biblio->ajouterMabiliothetique($id_user, $id_jeu, $game_name); 
        header('location:../Pages/maListe.php?=idGame='.$id_jeu);
        exit();       
        
    }
?>