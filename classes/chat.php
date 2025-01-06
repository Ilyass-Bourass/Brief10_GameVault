<?php

class Chat {
    // Attributes
    private $id_chat;
    private $id_jeux;
    private $id_utilisateur;
    private $Message;
    private $connexion;

    // Constructor
    public function __construct($connexion) {
       $this->connexion = $connexion;
    }

    public function EnvoyerMessage($id_jeux, $id_utilisateur, $Message) {
        try {
            $query = "INSERT INTO chat (id_jeu, id_user, message) VALUES (:id_jeu, :id_user, :message)";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':id_jeu' => $id_jeux, ':id_user' => $id_utilisateur, ':message' => $Message]);
            return true;
        } catch (PDOException $e) {
            echo '<p class="text-red-500">Error: ' . $e->getMessage() . '</p>';
            return false;
        }
    }


    public function AfficherChatLive($gameId) {
        try {
            $query = "SELECT * FROM chat WHERE id_jeu = :id_jeu ORDER BY id_chat";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':id_jeu' => $gameId]);
            $messagesLiveChat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $messagesLiveChat;
        } catch (PDOException $e) {
            echo '<p class="text-red-500">Error: ' . $e->getMessage() . '</p>';
            return false;
        }
    }
}
?>
