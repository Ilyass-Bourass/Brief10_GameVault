<?php
require_once '../config/dataBase.php';
require_once '../classes/Jeu.php';
$db = new Database();
$connex = $db->getConnection();
session_start();
if(isset($_SESSION['role'])){
   $id_user=$_SESSION['user_id']; 
}

$jeu=new Jeu($connex,"","","");
$allgames = $jeu->getAllJeux();

if(isset($_SESSION['role']) &&$_SESSION['role'] == 'USER'){
    $allgames = $jeu->getAllJeuxNexisteBibliotheque($id_user);
}
