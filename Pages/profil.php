<?php
require_once '../action/profilinformation.php';
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
                        <img id="profileImage" src="<?php echo $imageProfil['profil_photo'] ;?>" alt="Profile Picture"
                            class="rounded-full w-24 h-24 md:w-32 md:h-32 mx-auto border-4 border-orange-500 object-cover">
                        <!-- Overlay for Upload Icon -->
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
                            <button type="submit" name="history"
                                class="w-full text-left block py-2 px-3 bg-gray-800 text-gray-300 rounded hover:bg-orange-100 hover:text-black">history</button>
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
                    <form method="post" action="profil.php">
                        <div class="mb-4">
                            <label class="block text-white font-medium">Current Password</label>
                            <input type="password" name="CurrentPass"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Enter current password" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">New Password</label>
                            <input type="password" name="newPass"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Enter new password" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">Confirm New Password</label>
                            <input type="password" name="confirmNewPass"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                placeholder="Confirm new password" required>
                        </div>
                        <button type="submit"
                            class="w-full bg-orange-500 text-black py-3 rounded-lg hover:bg-orange-600"
                            name="ResetPass">Reset Password</button>
                    </form>
                    <?php elseif(isset($_POST['history'])) : ?>

                    <div class="container mx-auto px-4 py-8">
                        <h1 class="text-4xl font-bold mb-6 border-b border-orange-400 pb-2">Page History</h1>

                        <ul class="space-y-4">
                            <!-- History Item 1 -->
                            <li class="bg-orange-800 bg-opacity-20 p-4 rounded-lg shadow">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-semibold">Visited: Home Page</h2>
                                    <span class="text-sm text-orange-300">Jan 9, 2025, 2:30 PM</span>
                                </div>
                                <p class="text-orange-200 mt-2">You navigated to the home page to explore content.</p>
                            </li>

                            <!-- History Item 2 -->
                            <li class="bg-orange-800 bg-opacity-20 p-4 rounded-lg shadow">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-semibold">Visited: About Us</h2>
                                    <span class="text-sm text-orange-300">Jan 9, 2025, 3:00 PM</span>
                                </div>
                                <p class="text-orange-200 mt-2">You read about the company's mission and values.</p>
                            </li>

                            <!-- History Item 3 -->
                            <li class="bg-orange-800 bg-opacity-20 p-4 rounded-lg shadow">
                                <div class="flex justify-between items-center">
                                    <h2 class="text-xl font-semibold">Visited: Contact Page</h2>
                                    <span class="text-sm text-orange-300">Jan 9, 2025, 3:30 PM</span>
                                </div>
                                <p class="text-orange-200 mt-2">You visited the contact page to send a message.</p>
                            </li>
                        </ul>
                    </div>
                    <?php else: ?>
                    <!-- Profile Details Panel -->
                    <h2 class="text-xl md:text-2xl font-bold mb-6">Profile Details</h2>
                    <?php if(!empty($errors)) :?>
                    <?php foreach($errors as $error):?>
                    <P class="text-red-600 text-center"><?php echo $error ?></P>
                    <?php endforeach;?>
                    <?php endif;?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="block text-white font-medium">Name</label>
                            <input type="text" name="nom"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                value="<?php echo $profilinfo['nom']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-white font-medium">Email</label>
                            <input type="email" name="email"
                                class="w-full p-3 border border-orange-500 rounded-lg text-black"
                                value="<?php echo $profilinfo['email']; ?>" required>
                        </div>

                        <div class="flex items-center justify-start p-4">
                            <label class="block">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" name="file"
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 cursor-pointer">
                            </label>
                        </div>

                        <button type="submit" name="UpdateInfoProfile"
                            class="w-full bg-orange-500 text-black py-3 rounded-lg hover:bg-orange-600">Save
                            Changes</button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>