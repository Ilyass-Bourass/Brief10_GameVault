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


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ResetPass'])){
    $currenrPass = $_POST['CurrentPas'];
    $newPass = $_POST['mewPass'];
    $conFirmPass = $_POST['confirNewPass'];
    $old_Pass = $profilinfo['mot_passe'];

    $ressetPassword = $profil->resetPassword($user_id, $currenrPass, $newPass, $conFirmPass, $old_Pass);
    if($ressetPassword){
        header('Location: logout.php');
    }else {
        $errors = $profil->getErrors();
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile and Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-orange-300 font-sans">
    <div class="container mx-auto p-4 md:p-8">
        <div class="flex flex-wrap -mx-4 justify-center">
            <div class="w-full sm:w-2/3 md:w-1/3 px-4 mb-6">
                <div class="bg-black p-6 rounded-lg shadow-lg text-white">
                    <div class="relative text-center mb-6">
                        <img id="profileImage" src="../background.jpg" alt="Profile Picture"
                            class="rounded-full w-24 h-24 md:w-32 md:h-32 mx-auto border-4 border-orange-500 object-cover">
                        <!-- Overlay for Upload Icon -->
                        <label for="profileInput"
                            class="absolute inset-0 flex items-end justify-end rounded-full bg-black bg-opacity-50 cursor-pointer w-24 h-24 md:w-32 md:h-32 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 md:h-10 md:w-10 text-orange-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 10l7-7m0 0l7 7m-7-7v18" />
                            </svg>
                            <input id="profileInput" type="file" name="profile_pic" accept="image/*" class="hidden"
                                onchange="previewImage(event)">
                        </label>
                    </div>
                    <h2 class="text-xl md:text-2xl font-semibold mt-4 flex items-center justify-center">
                        <?php echo $profilinfo['nom']; ?></h2>
                    <p class="text-gray-300 text-sm md:text-base flex items-center justify-center">
                        <?php echo $profilinfo['email']; ?></p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <nav class="space-y-2 mt-6">
                            <button type="submit" name="profil"
                                class="w-full text-left block py-2 px-3 bg-gray-800 text-gray-300 rounded hover:bg-orange-100 hover:text-black">My
                                Profile</button>
                            <button type="submit" name="setting"
                                class="w-full text-left block py-2 px-3 bg-gray-800 text-gray-300 rounded hover:bg-orange-100 hover:text-black">Settings</button>
                            <a href="logout.php"
                                class="block py-2 px-3 bg-orange-500 text-white rounded hover:bg-orange-600">Log Out</a>
                        </nav>
                    </form>
                </div>
            </div>

            <!-- Conditional Panels -->
            <div class="w-full sm:w-2/3 md:w-2/3 px-4 mb-6">
                <div class="bg-black p-6 rounded-lg shadow-lg text-white">
                    <?php if (isset($_POST['setting'])) : ?>
                    <!-- Password Reset Panel -->
                    <h2 class="text-xl md:text-2xl font-bold mb-6">Password Reset</h2>
                    <?php if(!empty($errors)) :?>
                    <?php foreach($errors as $error):?>
                    <P class="text-red-600 text-center"><?php echo $error ?></P>
                    <?php endforeach;?>
                    <?php endif;?>
                    <form method="post">
                        <div class="mb-4">
                            <label class="block text-white font-medium">Current Password</label>
                            <input type="password" name="CurrentPas"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Enter current password">
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">New Password</label>
                            <input type="password" name="mewPass"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Enter new password">
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">Confirm New Password</label>
                            <input type="password" name="confirNewPass"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Confirm new password">
                        </div>
                        <button type="submit"class="w-full bg-orange-500 text-black py-3 rounded-lg hover:bg-orange-600" name="ResetPass">Reset Password</button>
                    </form>
                    <?php else : ?>
                    <!-- Profile Details Panel -->
                    <h2 class="text-xl md:text-2xl font-bold mb-6">Profile Details</h2>
                    <form method="post">
                        <div class="mb-4">
                            <label class="block text-white font-medium">Name</label>
                            <input type="text" class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                value="<?php echo $profilinfo['nom']; ?>">
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">Email</label>
                            <input type="email" class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                value="<?php echo $profilinfo['email']; ?>">
                        </div>
                        <button type="submit"
                            class="w-full bg-orange-500 text-black py-3 rounded-lg hover:bg-orange-600">Save
                            Changes</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>