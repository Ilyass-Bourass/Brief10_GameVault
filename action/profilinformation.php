<?php
require_once '../classes/utilsateur.php';
require_once '../config/dataBase.php';
session_start();

if (!isset($_SESSION['is_login']) || !$_SESSION['role'] == 'USER') {
    header('location: signin.php');
}
$db = new Database();
$connex = $db->getConnection();

$user_id = $_SESSION['user_id'];
$profil = new Utilisateur($connex);
$profilinfo = $profil->profil($user_id);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ResetPass'])) {
    $currentPass = $_POST['CurrentPass'];
    $newPass = $_POST['newPass'];
    $confirmPass = $_POST['confirmNewPass'];
    $old_PassHach = $profilinfo['mot_passe'];

    $resetPassword = $profil->resetPassword($user_id, $currentPass, $newPass, $confirmPass, $old_PassHach);

        if ($resetPassword) {
            echo "Password changed successfully";
        } else {
            $errorsPass = $profil->getErrorsPass();
            exit();
        }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['UpdateInfoProfile'])) {
    $name = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    $changeInfo = $profil->changerInfoProfil($name, $email, $user_id);
    $change_image_Profil = $profil->uploadImage($fileName, $fileTmpName, $fileSize, $fileError, $user_id);

    if ($changeInfo && $change_image_Profil) {
        header('Location: profil.php');
    } else {
        echo "Something went wrong";
        $errors = $profil->getErrors();
        exit();
    }
}
// image profil path
$imageProfil = $profil->SelectImageProfil($user_id);

?>