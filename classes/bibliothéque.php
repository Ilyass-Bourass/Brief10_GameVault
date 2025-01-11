<?php
    class Bibliothéque {
        private $id_bibliothéque;
        private $id_user;
        private $id_jeu;
        private $date_ajout;
        private $connexion;


        public function __construct($db){
            $this->connexion=$db;
        }

        public function ajouterMabiliothetique($id_user, $id_jeu, $game_name){
            $sql="INSERT INTO bibliotheques (id_user, id_jeu) VALUES (:id_user, :id_jeu)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user,
                ":id_jeu"=>$id_jeu,
            ]);

            $query = "INSERT INTO history (user_id, game_name) VALUES (:user_id, :game_name);";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([
                ':user_id' => $id_user,
                ':game_name' => $game_name
            ]);
        }

        public function selectNameGame($id_jeu){
            $query = "SELECT titre FROM jeux WHERE id_jeu = :id_jeu";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([
                ':id_jeu'=> $id_jeu
            ]);
            return $stmt->fetch(PDO:: FETCH_ASSOC);
        }
        public function selectHistory($user_id){
            $query = "SELECT * FROM history WHERE user_id = :id_user";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([
                ':id_user'=> $user_id
            ]);
            return $stmt->fetchAll(PDO:: FETCH_ASSOC);
        }

        


        public function getALLmaBibliotheque($id_user){
            $sql="SELECT b.id_user,j.*,u.nom,b.date_ajout as dateAjoutBiblio,b.etat FROM bibliotheques b
                    join users u on b.id_user=u.id_user
                    join jeux j on j.id_jeu=b.id_jeu
                    where b.id_user=:id_user;";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user
            ]);

            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function deleteMaliste($id_jeu){
            $sql="DELETE FROM bibliotheques WHERE id_jeu=:id_jeu";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_jeu"=>$id_jeu
            ]);
        }

        public function updateEtatjeu($id_jeu,$new_statut){
            $sql="UPDATE bibliotheques set etat =:new_statut where id_jeu=:id_jeu;";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":new_statut"=>$new_statut,
                ":id_jeu"=>$id_jeu,
            ]);
        }

    }
?>