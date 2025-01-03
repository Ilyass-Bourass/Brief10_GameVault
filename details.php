<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
    .livechat::-webkit-scrollbar {
        display: none;
    }
    </style>
</head>

<body class="bg-black text-white">
    <div class="flex justify-center items-center h-ful l">
        <main
            class="absolute top-0 z-10 bg-white bg-opacity-10 backdrop-filter backdrop-blur-md p-6 max-w-7xl grid grid-cols-1 md:grid-cols-3 gap-8 rounded-lg shadow-lg">
            <div class="col-span-1 md:col-span-2">
                <div class="bg-gray-900 p-4 rounded shadow-lg">
                    <img src="images/image_49.png" alt="The Last of Us" class="w-full rounded shadow-md mb-4">
                    <div class="grid grid-cols-4 gap-4 mb-4 overflow-x-scroll no-scrollbar livechat">
                        <img src="images/image_49.png" alt="Image 1" class="w-full h-32 rounded shadow-md">
                        <img src="images/image_49.png" alt="Image 2" class="w-full h-32 rounded shadow-md">
                        <img src="images/image_49.png" alt="Image 3" class="w-full h-32 rounded shadow-md">
                        <img src="images/image_49.png" alt="Image 4" class="w-full h-32 rounded shadow-md">
                    </div>
                    <h2 class="text-2xl font-bold mb-4">The Last of Us: Part 1</h2>
                    <p class="text-gray-400 mb-4">
                        Experience the emotional journey of Ellie and Joel in this critically acclaimed adventure game.
                        Immerse yourself in a post-apocalyptic world and discover the lengths people will go to survive.
                    </p>
                </div>

                <!-- Comment Section -->
                <div class="mt-6 bg-white bg-opacity-20 backdrop-filter backdrop-blur-md p-4 rounded shadow-lg">
                    <h2 class="text-2xl font-bold mb-4 text-black">Comments</h2>
                    <form>
                        <textarea class="w-full p-2 rounded border border-gray-300 bg-gray-100 text-black" rows="4"
                            placeholder="Leave a comment..."></textarea>
                        <button
                            class="mt-2 bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">Post
                            Comment</button>
                    </form>
                    <div class="mt-4">
                        <!-- Example Comments -->
                        <div class="mb-4 border-t border-gray-300 pt-4 flex items-start">
                            <img src="images/profil.avif" alt="Profile" class="w-12 h-12 rounded-full mr-4">
                            <div>
                                <p class="font-bold text-black">User123</p>
                                <p class="text-black">This game is amazing! Highly recommend.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Live Chat -->
            <div class="col-span-1 bg-gray-900 p-4 rounded shadow-lg">
                <div class="flex items-center justify-start gap-4 mb-4">
                    <i class="fa-solid fa-circle" style="color: #ff0000;"></i>
                    <h2 class="text-2xl font-bold">Live Chat</h2>
                </div>
                <div class="h-64 bg-gray-800 p-4 rounded overflow-y-scroll no-scrollbar livechat">
                    <!-- Chat Messages -->
                    <div class="mb-4">
                        <p class="font-bold">Support</p>
                        <p class="text-gray-400">How can I help you today?</p>
                    </div>
                </div>
                <form class="mt-4 flex">
                    <input type="text" class="flex-grow p-2 rounded bg-gray-800 text-white"
                        placeholder="Type your message...">
                    <button
                        class="ml-2 bg-orange-500 text-white py-2 px-4 rounded hover:bg-orange-600 transition duration-300">Send</button>
                </form>
            </div>
        </main>
    </div>

</body>

</html>