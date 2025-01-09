<?php
    class Favorits {
        private $id_favori;
        private $id_user;
        private $id_jeu;
        private $date_ajout;
        private $connexion;


        public function __construct($db){
            $this->connexion=$db;
        }

        public function ajoutermesFavoris($id_user,$id_jeu){
            $sql="INSERT INTO bibliotheques(id_user,id_jeu) VALUES (:id_user,:id_jeu)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user,
                ":id_jeu"=>$id_jeu,
            ]);
        }

        public function getALLmesFavoris($id_user){
            $sql="SELECT f.id_user,j.*,u.nom,f.date_ajout as dateAjoutfavoris FROM favoris f
                    join users u on f.id_user=u.id_user
                    join jeux j on j.id_jeu=f.id_jeu
                    where f.id_user=:id_user;
                    ";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user
            ]);

            return $query->fetchALL(PDO::FETCH_ASSOC);
        }

        public function deletemesFaoris($id_jeu){
            $sql="DELETE FROM favoris WHERE id_jeu=:id_jeu";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_jeu"=>$id_jeu
            ]);
        }

    }
?>