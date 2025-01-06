<?php
require_once '../action/register.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <div class="flex justify-center items-center h-screen">
        <div class="bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-3xl font-bold mb-6 text-center">Sign Up</h2>
            <?php if(!empty($errors)) :?>
            <?php foreach($errors as $error):?>
            <P class="text-red-600 text-center"><?php echo $error ?></P>
            <?php endforeach;?>
            <?php endif;?>
            <form action="#" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-lg font-bold mb-2">Name</label>
                    <input type="text" id="name" name="nom" required
                        class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-orange-500">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-lg font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-orange-500">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-lg font-bold mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                        class="w-full p-3 rounded-lg bg-gray-700 border border-gray-600 focus:outline-none focus:border-orange-500">
                </div>
                <button type="submit" name="inscription"
                    class="w-full bg-orange-500 text-white font-bold py-3 rounded-lg hover:bg-orange-600 transition duration-300">
                    Sign Up
                </button>
            </form>
            <div class="mt-4 text-center">
                <p>Already have an account? <a href="signin.php" class="text-orange-400 hover:underline">Sign in now</a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>