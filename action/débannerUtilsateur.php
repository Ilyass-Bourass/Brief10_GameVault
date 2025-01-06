<?php
require_once "../config/dataBase.php"; 
require_once "../classes/utilsateur.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //var_dump($_POST);
    $id_user_bani=$_POST['id_user'];

    $database = new Database();
    $db = $database->getConnection();

    $Utilisateur=new Utilisateur($db);

    if($Utilisateur->débaniUtilsateur($id_user_bani)) {
        header("Location: ../Pages/dashbordAdmin.php?success=1");
        exit();
    } else {
        header("Location: ../Pages/dashbordAdmin.php?error=1");
        exit();
    }
}
?> 