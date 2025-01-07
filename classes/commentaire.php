<?php

class Commentaire {
    
    private $id_chat;
    private $id_jeux;
    private $id_utilisateur;
    private $commentaire;
    private $connexion;

    // Constructor
    public function __construct($connexion) {
       $this->connexion = $connexion;
    }

    public function EnvoyerCommentaire($id_jeux, $id_utilisateur, $commentaire) {
        try {
            $query = "INSERT INTO commentaire (id_jeu, id_user, commentaire) VALUES (:id_jeu, :id_user, :commentaire)";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':id_jeu' => $id_jeux, ':id_user' => $id_utilisateur, ':commentaire' => $commentaire]);
            return true;
        } catch (PDOException $e) {
            echo '<p class="text-red-500">Error: ' . $e->getMessage() . '</p>';
            return false;
        }
    }


    public function getAllCommentaires($id_jeu) {
        $sql="SELECT u.nom, c.* FROM commentaire c
                JOIN users u 
                ON u.id_user=c.id_user
                JOIN jeux j
                ON 
                j.id_jeu=c.id_jeu
                where c.id_jeu=:id_jeu
                ";
        $query=$this->connexion->prepare($sql);
        $query->execute([":id_jeu"=>$id_jeu]);
        return $query->fetchALL(PDO::FETCH_ASSOC);
    }
}
?>
