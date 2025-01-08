<?php

require_once '../config/dataBase.php';
require '../classes/jeu.php';

 if($_SERVER['REQUEST_METHOD']=='POST'){

    $db = new Database();
    $connex = $db->getConnection();
    $user_id=$_POST['user_id'];

    var_dump($_POST);
    $GameId=$_POST['GameId'];
    $note=(int)$_POST['note'];

    $jeu=new Jeu($connex,"","","");
    $jeu->ajouterNote($GameId,$user_id, $note);
    header('location: ../pages/détails.php?idGame='. $GameId);
    exit();
    
 }
 
 
?>