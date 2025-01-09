<?php
    require_once "../config/dataBase.php";
    require_once "../classes/bibliothéque.php";
    require_once "../classes/mesFavorits.php";

    session_start();
    $id_user=$_SESSION['user_id'];

    $db=new Database();
    $conn= $db->getConnection();
    $biblio=new Bibliothéque( $conn);

    

    $mesJeux=$biblio->getALLmaBibliotheque($id_user);
   
    $favoris=new Favorits($conn);
    
    
    $mesFavoris=$favoris->getALLmesFavoris($id_user);
    // var_dump($mesFavoris);

    


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Liste - GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-black text-white">

    <header class="bg-orange-700 p-4 fixed w-full z-50">
        <div class="flex justify-between items-center">
            <nav class="flex space-x-4">
                <a href="index.php" class="text-white font-bold hover:text-orange-300 transition duration-300">Accueil</a>
                <a href="index.php" class="text-white font-bold hover:text-orange-300 transition duration-300">Jeux</a>
                <a href="#" class="text-white font-bold hover:text-orange-300 transition duration-300">Découvrir</a>
            </nav>
            <div class="flex items-center space-x-4">
                <span class="text-white">Bienvenue, <?php echo "[".$_SESSION['nom']."]"?></span>
                <a href="logout.php" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition duration-300">
                    <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                </a>
            </div>
        </div>
    </header>

 
    <main class="container mx-auto px-4 pt-24">
        <!-- Conteneur principal avec décoration -->
        <div class="relative">
            <!-- Décoration à droite -->
            <div class="hidden lg:block absolute right-0 top-0 h-full w-1/6">
                <div class="sticky top-24">
                    <div class="border-l-4 border-orange-500 h-96 ml-8"></div>
                    <div class="absolute top-10 left-0 w-16 h-16 bg-orange-500 rounded-full opacity-20"></div>
                    <div class="absolute top-40 left-10 w-8 h-8 bg-orange-400 rounded-full opacity-20"></div>
                    <div class="absolute top-60 left-5 w-12 h-12 bg-orange-600 rounded-full opacity-20"></div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="lg:w-5/6 pr-8">
                <!-- Ma Liste de Jeux -->
                <div class="mb-16 pl-8">
                    <div class="mb-8">
                        <h1 class="text-4xl font-bold text-orange-400">Ma Liste de Jeux</h1>
                    </div>

                    <!-- Grid des jeux -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Carte de jeu -->
                         <?php foreach($mesJeux as $monJeu):?>
                        <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg">
                            <div class="relative">
                                <img src="<?php echo $monJeu['image_url']?>" 
                                     alt="The Last of Us" 
                                     class="w-full h-48 object-cover">
                                <form action="../action/deleteMaliste.php" method="POST">
                                    <input name="id_jeu" type="hidden" value="<?php echo $monJeu['id_jeu'] ?>">
                                    <button class="absolute top-2 right-2 text-red-500 hover:text-red-600 bg-white rounded-full p-2">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                                    
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl font-bold"><?php echo $monJeu['titre']?></h3>
                                    <div class="flex items-center">
                                        <span class="mr-1"><?php echo $monJeu['note']?></span>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                </div>
                                <p class="text-gray-400 mb-4"><?php echo $monJeu['description']?></p>
                                <div class="flex justify-between items-center mb-4">
                                    <div class="flex justify-between w-full gap-10">
                                        <form  method="POST" action="../action/changerStatutjeu.php">
                                            <input name="id_jeu" type="hidden" value="<?php echo $monJeu['id_jeu'] ?>">
                                            <select name="statut" onchange=this.form.submit() class="bg-gray-800 text-white rounded px-3 py-1 border border-gray-700">
                                                <option value="encours" <?php echo ($monJeu['etat']=='encours')? 'selected' :''; ?>>En cours</option>
                                                <option value="termine" <?php echo ($monJeu['etat']=='termine')? 'selected' :''; ?>>Terminé</option>
                                                <option value="abandonne" <?php echo ($monJeu['etat']=='abandonne')? 'selected' :''; ?>>Abandonné</option>
                                            </select>
                                        </form>
                                            
                                        <span class="text-gray-400"><?php echo $monJeu['dateAjoutBiblio']?></span>
                                    </div>
                                    
                                </div>
                                <div class="flex justify-end">
                                    <form action="../action/ajouterMesfavoris.php" method="POST">
                                        <input name="id_jeu" type="hidden" value="<?php echo $monJeu['id_jeu'] ?>">
                                        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                                            <i class="fas fa-star mr-2"></i>Ajouter aux favoris
                                        </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>

                <!-- Mes Favoris -->
                <div class="mb-16 pl-8">
                    <h2 class="text-3xl font-bold text-orange-400 mb-8">Mes Favoris</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Carte de jeu favori -->
                         <?php foreach($mesFavoris as $monFavoris):?>
                        <div class="bg-gray-900 rounded-lg overflow-hidden shadow-lg border-2 border-yellow-400">
                            <div class="relative">
                                <img src="<?php echo $monFavoris['image_url']?>" 
                                     alt="God of War" 
                                     class="w-full h-48 object-cover">
                                
                            </div>
                            <div class="p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-2xl font-bold"><?php echo $monFavoris['titre']?></h3>
                                    <div class="flex items-center">
                                        <span class="mr-1"><?php echo $monFavoris['note']?></span>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                </div>
                                <p class="text-gray-400 mb-4"><?php echo $monFavoris['description']?></p>
                                <div class="flex justify-between items-center mb-4">
                                    <!-- <select class="bg-gray-800 text-white rounded px-3 py-1 border border-gray-700">
                                        <option value="termine">Terminé</option>
                                        <option value="encours">En cours</option>
                                        <option value="abandonne">Abandonné</option>
                                    </select> -->
                                    <span class="text-gray-400"><?php echo $monFavoris['dateAjoutfavoris']?></span>
                                </div>
                                <div class="flex justify-end">
                                    <form method='POST' action="../action/supprimerMesFavoris.php">
                                        <input type="hidden" name="id_jeu" value="<?php echo $monFavoris['id_jeu']?>">
                                        <button class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600 transition duration-300">
                                        <i class="fas fa-star-half-alt mr-2"></i>Retirer des favoris
                                    </button>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
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
                    <p class="text-gray-400">GameVault est votre destination ultime pour découvrir et gérer votre collection de jeux.</p>
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
                <p class="text-gray-400">&copy; 2024 GameVault. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>