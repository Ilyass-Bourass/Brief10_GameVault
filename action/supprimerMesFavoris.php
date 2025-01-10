<?php
    require_once "../config/dataBase.php";
    require_once "../classes/bibliothéque.php";
    require_once "../classes/mesFavorits.php";

    session_start();

     var_dump($_POST);
    // echo "------<br>-----";
    // var_dump($_SESSION);

    $id_jeu=$_POST['id_jeu'];

    $id_user=$_SESSION['user_id'];

    $db=new Database();
    $conn= $db->getConnection();
    $biblio=new Bibliothéque( $conn);
    
    $favoris=new Favorits($conn);
    $favoris->deletemesFaoris($id_jeu);
    header('location:../Pages/maListe.php?=idGame='.$id_jeu);
    exit();
?>