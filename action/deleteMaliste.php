<?php

    require_once "../config/dataBase.php";
    require_once "../classes/bibliothéque.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
        $id_jeu=$_POST['id_jeu'];

        $db=new Database();
        $conn=$db->getConnection();

        $biblio=new Bibliothéque($conn);

        $biblio->deleteMaliste($id_jeu); 
            header('location:../Pages/maListe.php?');
            exit();
        
    }

?>