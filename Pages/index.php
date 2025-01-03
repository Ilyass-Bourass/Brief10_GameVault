<?php
    require_once '../config/dataBase.php';
    $db=new Database();
    $connex=$db->getConnection();
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

<body class="bg-black text-white">
    <!-- Navbar -->
    <header class="bg-orange-700 p-4 fixed w-full z-50">
        <div class="flex justify-between items-center">
            <nav class="flex space-x-4">
                <a href="index.php" class="text-white font-bold hover:text-orange-300 transition duration-300">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="#jeux" class="text-white font-bold hover:text-orange-300 transition duration-300">Jeux</a>
                <a href="dashbordAdmin.php"
                    class="text-white font-bold hover:text-orange-300 transition duration-300">dashbordAdmin</a>
            </nav>
            <div class="flex space-x-4">
                <button onclick="openModal('loginModal')"
                    class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                    <i class="fas fa-sign-in-alt"></i> Connexion
                </button>
                <button onclick="openModal('registerModal')"
                    class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                    <i class="fas fa-user-plus"></i> Inscription
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section centralisée -->
    <div class="relative h-screen">
        <img src="https://images.unsplash.com/photo-1511512578047-dfb367046420" alt="Gaming Background"
            class="w-full h-full object-cover">
        <div
            class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/70 to-black/70 flex items-center justify-center">
            <div class="text-center max-w-2xl px-6">
                <h1 class="text-6xl font-bold text-orange-400 mb-4">GameVault</h1>
                <p class="text-3xl text-white mb-8">Explorez, collectionnez et partagez vos jeux préférés dans un seul
                    endroit.</p>
                <a href="#jeux"
                    class="bg-orange-500 text-white px-8 py-3 rounded-lg text-lg font-bold hover:bg-orange-600 transition duration-300 inline-flex items-center">
                    Explorer les jeux
                    <i class="fas fa-chevron-down ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Modal Connexion -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg w-96">
            <h2 class="text-2xl font-bold mb-4">Connexion</h2>
            <form action="login.php" method="POST" class="space-y-4">
                <div>
                    <label class="block mb-2">Email</label>
                    <input type="email" name="email" required class="w-full bg-gray-800 rounded p-2 text-white">
                </div>
                <div>
                    <label class="block mb-2">Mot de passe</label>
                    <input type="password" name="password" required class="w-full bg-gray-800 rounded p-2 text-white">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('loginModal')"
                        class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Annuler</button>
                    <button type="submit" class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">Connexion</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Inscription -->
    <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg w-96">
            <h2 class="text-2xl font-bold mb-4">Inscription</h2>
            <form action="register.php" method="POST" class="space-y-4">
                <div>
                    <label class="block mb-2">Nom</label>
                    <input type="text" name="nom" required class="w-full bg-gray-800 rounded p-2 text-white">
                </div>
                <div>
                    <label class="block mb-2">Email</label>
                    <input type="email" name="email" required class="w-full bg-gray-800 rounded p-2 text-white">
                </div>
                <div>
                    <label class="block mb-2">Mot de passe</label>
                    <input type="password" name="password" required class="w-full bg-gray-800 rounded p-2 text-white">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('registerModal')"
                        class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Annuler</button>
                    <button type="submit"
                        class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Section Jeux avec ID pour la navigation -->
    <main id="jeux" class="p-6 max-w-7xl mx-auto pt-24">
        <h2 class="text-4xl font-bold mb-8 text-orange-400">Jeux Populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Carte 1 -->
            <div
                class="bg-gray-900 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1552820728-8b83bb6b773f" alt="The Last of Us"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold">The Last of Us</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="text-yellow-400 font-bold">4.8</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Une aventure post-apocalyptique captivante...</p>
                    <div class="flex justify-between items-center">
                        <a href="maListe.php?id=1"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>Ma Liste
                        </a>
                        <a href="détails.php?id=1"
                            class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                            <i class="fas fa-info-circle mr-2"></i>Voir plus
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte 2 -->
            <div
                class="bg-gray-900 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1509198397868-475647b2a1e5" alt="God of War"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold">God of War</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="text-yellow-400 font-bold">4.9</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Une épopée nordique légendaire...</p>
                    <div class="flex justify-between items-center">
                        <a href="maListe.php?id=2"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>Ma Liste
                        </a>
                        <a href="détails.php?id=2"
                            class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                            <i class="fas fa-info-circle mr-2"></i>Voir plus
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carte 3 -->
            <div
                class="bg-gray-900 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e" alt="Horizon Zero Dawn"
                    class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold">Horizon Zero Dawn</h3>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="text-yellow-400 font-bold">4.7</span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">Un monde ouvert futuriste...</p>
                    <div class="flex justify-between items-center">
                        <a href="maListe.php?id=3"
                            class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">
                            <i class="fas fa-plus mr-2"></i>Ma Liste
                        </a>
                        <a href="détails.php?id=3"
                            class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                            <i class="fas fa-info-circle mr-2"></i>Voir plus
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">À propos</h3>
                    <p class="text-gray-400">GameVault est votre destination ultime pour découvrir et gérer votre
                        collection de jeux.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Jeux</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Suivez-nous</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-400">&copy; 2025 GameVault. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'flex';
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }
    </script>
</body>

</html>