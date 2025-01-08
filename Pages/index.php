<?php 
require_once '../action/afficherJeux.php';
require_once '../action/cheakSession.php';


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
    <header class="bg-orange-700 p-4 w-full z-50">
        <div class="flex justify-between items-center">
            <nav class="flex space-x-4">
                <a href="index.php" class="text-white font-bold hover:text-orange-300 transition duration-300">
                    <i class="fas fa-home"></i> Home
                </a>
                <a href="#jeux" class="text-white font-bold hover:text-orange-300 transition duration-300">Jeux</a>
                <a href="maListe.php" class="text-white font-bold hover:text-orange-300 transition duration-300">Ma List</a>
                <a href="profil.php?user_id=<?php  echo $_SESSION['user_id'];?>"
                    class="text-white font-bold hover:text-orange-300 transition duration-300">Profil</a>
            </nav>
            <div class="flex space-x-4">
                <?php if(isset($_SESSION['is_login']) && $_SESSION['role'] == 'USER') : ?>
                <div class="flex items-center space-x-4">
                    <span class="text-white">Bienvenue, <?php echo $_SESSION['nom']; ?></span>
                    <a href="logout.php"
                        class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">
                        <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                    </a>
                </div>
                <?php else : ?>
                <a href="signin.php"><button
                        class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                        <i class="fas fa-sign-in-alt"></i> Connexion
                    </button></a>
                <a href="signup.php"><button
                        class="bg-orange-500 text-white font-bold py-2 px-4 rounded hover:bg-orange-600 transition duration-300">
                        <i class="fas fa-user-plus"></i> Inscription
                    </button></a>
                <?php endif; ?>
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

    <!-- Section Jeux avec ID pour la navigation -->
    <main id="jeux" class="p-6 max-w-7xl mx-auto pt-24">
        <h2 class="text-4xl font-bold mb-8 text-orange-400">Jeux Populaires</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Carte 1 -->
            <?php foreach($allgames as $games): ?>
            <div
                class="bg-gray-900 rounded-lg overflow-hidden shadow-lg transform hover:scale-105 transition-transform duration-300">
                <img src="<?php echo $games['image_url'] ;?>" alt="The Last of Us" class="w-full h-48 object-cover">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold"><?php echo $games['titre']; ?></h3>
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 mr-1"></i>
                            <span class="text-yellow-400 font-bold"><?php echo $games['note'];?></span>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4"><?php echo $games['description'];?></p>
                    <div class="flex justify-between items-center">
                        <form action="" method="post">
                            <input type="hidden" name="userId"
                                value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';?>">
                            <button type="submit"
                                class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300"
                                name="maliste">
                                <i class="fas fa-plus mr-2"></i>Ma Liste
                            </button>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="idGame" value="<?php echo $games['id_jeu'];?>">
                            <button type="submit"
                                class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300"
                                name="VoirPlus">
                                <i class="fas fa-info-circle mr-2"></i>Voir plus
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            <?php endforeach ; ?>
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

</body>

</html>