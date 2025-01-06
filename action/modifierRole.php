<?php
    require_once "../config/dataBase.php"; 
    require '../classes/utilsateur.php';
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $database = new Database();
        $db = $database->getConnection();
    
        $id_user = $_POST['id_user'];
        $role = $_POST['role'];
        var_dump($id_user,$role);
        
        $utilsateur=  new Utilisateur($db);
    
        if($utilsateur->modifierRole($id_user,$role)) {
            header("Location: ../Pages/dashbordAdmin.php?success=1");
            exit();
        } else {
            header("Location: ../Pages/dashbordAdmin.php?error=1");
            exit();
        }
    }
?>