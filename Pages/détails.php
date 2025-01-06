<?php
require_once '../config/dataBase.php';
require_once '../classes/chat.php';
session_start();
$db = new Database();
$connex = $db->getConnection();

$GameId = $_GET['idGame'];
$chat = new Chat($connex);

$afficherMessage = $chat->AfficherChatLive($GameId);
print_r($afficherMessage);

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendLiveChat'])){
    $message = htmlspecialchars($_POST['messageLive']);
    $userId = $_SESSION['user_id'];
    $ChatLive = $chat->EnvoyerMessage($GameId, $userId, $message);
    
    if($ChatLive){
        header('location: détails.php?idGame='. $GameId);
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body class="bg-gray-900 bg-opacity-90 text-white font-sans">
    <div class="flex justify-center items-center min-h-screen">
        <main
            class="relative z-10 bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg p-6 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8 rounded-lg shadow-2xl">
            <!-- Left Column: Game Details -->
            <div class="col-span-1 md:col-span-2">
                <div class="p-6 bg-gray-900 rounded-lg shadow-lg">
                    <img src="../game1.png" alt="The Last of Us"
                        class="w-full rounded-lg shadow-md mb-6 transition-transform transform hover:scale-105">
                    <h2 class="text-3xl font-bold mb-4">The Last of Us: Part 1</h2>
                    <p class="text-gray-400 leading-relaxed mb-6">
                        Experience the emotional journey of Ellie and Joel in this critically acclaimed adventure game.
                        Immerse yourself in a post-apocalyptic world and discover the lengths people will go to survive.
                    </p>
                    <div class="grid grid-cols-4 gap-4 overflow-x-scroll no-scrollbar livechat">
                        <img src="../game1.png" alt="Image 1"
                            class="rounded-lg shadow-md transition-transform transform hover:scale-105">
                        <img src="../game1.png" alt="Image 2"
                            class="rounded-lg shadow-md transition-transform transform hover:scale-105">
                        <img src="../game1.png" alt="Image 3"
                            class="rounded-lg shadow-md transition-transform transform hover:scale-105">
                        <img src="../game1.png" alt="Image 4"
                            class="rounded-lg shadow-md transition-transform transform hover:scale-105">
                    </div>
                </div>
                <!-- Comments Section -->
                <div class="mt-6 bg-gray-800 p-6 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold mb-4">Comments</h3>
                    <form class="mb-4">
                        <textarea
                            class="w-full p-3 rounded-lg border border-gray-600 bg-gray-700 text-white resize-none"
                            rows="4" placeholder="Leave a comment..."></textarea>
                        <button
                            class="mt-2 bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition duration-300">Post
                            Comment</button>
                    </form>
                    <div>
                        <div class="mb-4 flex items-start">
                            <img src="images/profil.avif" alt="Profile" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-bold">User123</p>
                                <p>This game is amazing! Highly recommend.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Live Chat -->
            <div class="col-span-1 bg-gray-900 p-6 rounded-lg shadow-lg">
                <div class="mb-6 flex items-center gap-4">
                    <i class="fa-solid fa-circle text-red-500"></i>
                    <h3 class="text-2xl font-bold">Live Chat</h3>
                </div>
                <div class="h-64 bg-gray-800 p-4 rounded-lg overflow-y-scroll no-scrollbar">
                    <?php foreach($afficherMessage as $message): ?>
                    <div class="mb-4">
                        <!-- <p class="font-bold">Support</p> -->
                        <p class="text-gray-400"><?php echo $message['message'] ;?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <form class="mt-4 flex" method="post">
                    <input type="text" class="flex-grow p-3 rounded-lg bg-gray-700 text-white border border-gray-600"
                        placeholder="Type your message..." name="messageLive">
                    <button
                        class="ml-2 bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600 transition duration-300" name="sendLiveChat">Send</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>