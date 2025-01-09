<?php
    include_once '../config/dataBase.php';
    include_once '../classes/bibliothéque.php';

    $db=new Database();
    $conn=$db->getConnection();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        var_dump($_POST);
        $id_jeu=$_POST['id_jeu'];
        $statut=$_POST['statut'];

        $biblio=new Bibliothéque($conn);
        $biblio->updateEtatjeu($id_jeu,$statut);
        header('location:../Pages/maListe.php');
        exit();
    }
?>