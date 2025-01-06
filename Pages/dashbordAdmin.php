<?php
    require_once '../config/dataBase.php';
    require '../classes/jeu.php';
    require '../classes/utilsateur.php';
    session_start();
    if(!$_SESSION['is_admin']){
        header('location: index.php');
    }
    $db=new Database();
    $connex=$db->getConnection();

    $jeu=new Jeu($connex,"","","");
    $Jeux=$jeu->getAllJeux();
    //var_dump($Jeux);
    $utilsateur=  new Utilisateur($connex);
    $utilsateurs=$utilsateur->getAllutilsateur();
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - GameVault</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
         #users, #bans {
            display: none;
        }
    </style>
</head>
<body class="bg-black text-white">
    
    <div class="fixed h-full w-64 bg-orange-700 p-4 flex flex-col justify-between">
        <div>
            <div class="mb-8">
                <h1 class="text-2xl font-bold">GameVault Admin</h1>
            </div>
            
            <nav class="space-y-2">
                <a href="#" onclick="showGames()" class="block p-3 rounded hover:bg-orange-600">
                    <i class="fas fa-gamepad mr-2"></i> Gestion des Jeux
                </a>
                <a href="#" onclick="showUsers()" class="block p-3 rounded hover:bg-orange-600">
                    <i class="fas fa-users mr-2"></i> Gestion Utilisateurs
                </a>
                <a href="#" onclick="showBans()" class="block p-3 rounded hover:bg-orange-600">
                    <i class="fas fa-ban mr-2"></i> Gestion Bannissements
                </a>
            </nav>
        </div>
        
        
        <div class="mb-4">
            <a href="logout.php" class="block p-3 rounded bg-red-600 hover:bg-red-700 text-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </a>
        </div>
    </div>

    
    <div class="ml-64 p-8">
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-900 p-6 rounded-lg">
                <h3 class="text-orange-400 text-lg">Total Utilisateurs</h3>
                <p class="text-3xl font-bold">1,234</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg">
                <h3 class="text-orange-400 text-lg">Total Jeux</h3>
                <p class="text-3xl font-bold">567</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg">
                <h3 class="text-orange-400 text-lg">Utilisateurs Actifs</h3>
                <p class="text-3xl font-bold">890</p>
            </div>
            <div class="bg-gray-900 p-6 rounded-lg">
                <h3 class="text-orange-400 text-lg">Utilisateurs Bannis</h3>
                <p class="text-3xl font-bold">12</p>
            </div>
        </div>

        
        <div id="games">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Gestion des Jeux</h2>
                <button onclick="openModal('addGameModal')" 
                        class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">
                    <i class="fas fa-plus mr-2"></i> Ajouter un Jeu
                </button>
            </div>
            
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-orange-700">
                        <tr>
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-left">Titre</th>
                            <th class="p-4 text-left">Note</th>
                            <th class="p-4 text-left">Date d'ajout</th>
                            <th class="p-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($Jeux as $Jeu): ?>
                        <tr class="border-b border-gray-800">
                                <td class="p-4"><?php echo $Jeu['id_jeu'] ?></td>
                                <td class="p-4"><?php echo $Jeu['titre'] ?></td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <span class="mr-1"><?php echo $Jeu['note'] ?></span>
                                        <i class="fas fa-star text-yellow-400"></i>
                                    </div>
                                </td>
                                <td class="p-4"><?php echo $Jeu['date_ajoute_jeu'] ?></td>
                                <td class="p-4">
                                    <a href="#" 
                                       onclick="openEditModal('<?php echo $Jeu['id_jeu']; ?>', '<?php echo $Jeu['titre']; ?>', '<?php echo $Jeu['description']; ?>', '<?php echo $Jeu['image_url']; ?>')"
                                       class="text-blue-400 hover:text-blue-300 mr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="../action/supprimerJeuBaseDonnées.php?id_supprimer=<?php echo $Jeu['id_jeu']; ?>" 
                                       class="text-red-400 hover:text-red-300">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div id="users" class="hidden">
            <h2 class="text-2xl font-bold mb-6">Gestion des Utilisateurs</h2>
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-orange-700">
                        <tr>
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-left">Nom</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Date d'inscription</th>
                            <th class="p-4 text-center">Rôle</th>
                            <th class="p-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($utilsateurs as $utilsateur): ?>
                            <tr class="border-b border-gray-800">
                                <td class="p-4"><?php echo $utilsateur['id_user'] ?></td>
                                <td class="p-4"><?php echo $utilsateur['nom'] ?></td>
                                <td class="p-4"><?php echo $utilsateur['email'] ?></td>
                                <td class="p-4"><?php echo $utilsateur['date_inscription'] ?></td>
                                
                                <td class="p-4 text-center">
                                    <select class="bg-gray-800 text-white rounded p-2">
                                        <option value="USER" <?php echo ($utilsateur['role'] == 'USER') ? 'selected' : ''; ?>>
                                            Utilisateur
                                        </option>
                                        <option value="ADMIN" <?php echo ($utilsateur['role'] == 'ADMIN') ? 'selected' : ''; ?>>
                                            Administrateur
                                        </option>
                                    </select>
                                </td>

                                <td class="p-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <?php if($utilsateur['role'] != 'ADMIN'): ?>
                                            <a href="#" 
                                               onclick="openBanModal('<?php echo $utilsateur['id_user']; ?>', '<?php echo $utilsateur['nom']; ?>')"
                                               class="text-yellow-400 hover:text-yellow-300">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <a href="../action/supprimerUtilsateur.php?id_supprimer=<?php echo $utilsateur['id_user']; ?>" 
                                           class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div id="bans" class="hidden">
            <h2 class="text-2xl font-bold mb-6">Gestion des Bannissements</h2>
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-orange-700">
                        <tr>
                            <th class="p-4 text-left">ID</th>
                            <th class="p-4 text-left">Utilisateur</th>
                            <th class="p-4 text-left">Email</th>
                            <th class="p-4 text-left">Date de ban</th>
                            <th class="p-4 text-left">Raison</th>
                            <th class="p-4 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-800">
                            <td class="p-4">1</td>
                            <td class="p-4">Jane Smith</td>
                            <td class="p-4">jane@example.com</td>
                            <td class="p-4">2024-01-10</td>
                            <td class="p-4">Spam</td>
                            <td class="p-4">
                                <button class="text-green-400 hover:text-green-300">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <div id="addGameModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg w-1/2">
            <h2 class="text-2xl font-bold mb-4">Ajouter un Jeu</h2>
            <form class="space-y-4" method="POST" action="../action/addJeuBaseDonnée.php">
                <div>
                    <label class="block mb-2">Titre</label>
                    <input type="text" name="titre" class="w-full bg-gray-800 rounded p-2 text-white" required>
                </div>
                <div>
                    <label class="block mb-2">Description</label>
                    <textarea name="description" class="w-full bg-gray-800 rounded p-2 text-white" required></textarea>
                </div>
                <div>
                    <label class="block mb-2">URL de l'image</label>
                    <input type="url" name="image_url"
                           placeholder="https://exemple.com/image.jpg" 
                           class="w-full bg-gray-800 rounded p-2 text-white" 
                           required>
                    <p class="text-sm text-gray-400 mt-1">Entrez l'URL de l'image du jeu</p>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addGameModal')" 
                            class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">Annuler</button>
                    <button type="submit" class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

  
    <div id="editGameModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg w-1/2">
            <h2 class="text-2xl font-bold mb-4">Modifier le Jeu</h2>
            
            <form class="space-y-4" method="POST" action="../action/modifierJeu.php">
                <input type="hidden" id="edit_game_id" name="id_jeu">
                
                <div>
                    <label class="block mb-2">Titre</label>
                    <input type="text" 
                           name="titre" 
                           id="edit_titre"
                           class="w-full bg-gray-800 rounded p-2 text-white" 
                           required>
                </div>

                <div>
                    <label class="block mb-2">Description</label>
                    <textarea name="description" 
                              id="edit_description"
                              class="w-full bg-gray-800 rounded p-2 text-white h-32" 
                              required></textarea>
                </div>

                <div>
                    <label class="block mb-2">URL de l'image</label>
                    <input type="url" 
                           name="image_url"
                           id="edit_image_url"
                           class="w-full bg-gray-800 rounded p-2 text-white" 
                           required>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="closeEditModal()"
                            class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-orange-500 px-4 py-2 rounded hover:bg-orange-600">
                        Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Bannissement -->
    <div id="banModal" style="display: none;" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-gray-900 p-8 rounded-lg w-1/2">
            <h2 class="text-2xl font-bold mb-4">Bannir l'utilisateur</h2>
            
            <form class="space-y-4" method="POST" action="../action/bani_utilisateur.php">
                <!-- ID caché -->
                <input type="hidden" id="ban_user_id" name="id_user" value="<?php echo $utilsateur['id_user'] ?>">
                
                <!-- Nom de l'utilisateur (en lecture seule) -->
                <div>
                    <label class="block mb-2">Utilisateur</label>
                    <input type="text" 
                           id="ban_user_name" 
                           class="w-full bg-gray-800 rounded p-2 text-white" 
                           readonly>
                </div>

                <!-- Raison du bannissement -->
                <div>
                    <label class="block mb-2">Raison du bannissement</label>
                    <textarea name="ban_raison" 
                              class="w-full bg-gray-800 rounded p-2 text-white h-32" 
                              required></textarea>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end space-x-4">
                    <button type="button" 
                            onclick="closeBanModal()"
                            class="bg-gray-700 px-4 py-2 rounded hover:bg-gray-600">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">
                        Bannir
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showGames() {
            document.getElementById('games').style.display = 'block';
            document.getElementById('users').style.display = 'none';
            document.getElementById('bans').style.display = 'none';
        }

        function showUsers() {
            document.getElementById('games').style.display = 'none';
            document.getElementById('users').style.display = 'block';
            document.getElementById('bans').style.display = 'none';
        }

        function showBans() {
            document.getElementById('games').style.display = 'none';
            document.getElementById('users').style.display = 'none';
            document.getElementById('bans').style.display = 'block';
        }

        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }


        function openEditModal(id, titre, description, image_url) {
            document.getElementById('edit_game_id').value = id;
            document.getElementById('edit_titre').value = titre;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_image_url').value = image_url;
            document.getElementById('editGameModal').style.display = 'flex';
        }

        function closeEditModal() {
            document.getElementById('editGameModal').style.display = 'none';
        }

        function openBanModal(userId, userName) {
            document.getElementById('ban_user_id').value = userId;
            document.getElementById('ban_user_name').value = userName;
            document.getElementById('banModal').style.display = 'flex';
        }

        function closeBanModal() {
            document.getElementById('banModal').style.display = 'none';
        }
    </script>
</body>
</html> 