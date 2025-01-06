<?php

if((isset($_POST['maliste']) || isset($_POST['VoirPlus'])) && (!isset($_SESSION['is_login']) || $_SESSION['role'] != 'USER')){
    header('Location: signin.php');
    exit();
}

if (isset($_POST['maliste']) && (isset($_SESSION['is_login']) || $_SESSION['role'] == 'USER')) {
    $userId = $_POST['userId'];
    header('Location: maListe.php?userId=' . $userId);
    exit();
}

if(isset($_SESSION['is_login']) && ($_SESSION['role'] == 'ADMIN')){
    session_start();
    $_SESSION['is_admin'] = true ;
    header('location: dashbordAdmin.php');
}

if (isset($_POST['VoirPlus']) && (isset($_SESSION['is_login']) || $_SESSION['role'] == 'USER')) {
    $idGame = $_POST['idGame'];
    header('Location: détails.php?idGame=' . $idGame);
    exit();
}
?>