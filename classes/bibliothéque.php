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

        public function ajouterMabiliothetique($id_user,$id_jeu){
            $sql="INSERT INTO bibliotheques(id_user,id_jeu) VALUES (:id_user,:id_jeu)";
            $query=$this->connexion->prepare($sql);
            $query->execute([
                ":id_user"=>$id_user,
                ":id_jeu"=>$id_jeu,
            ]);
        }

        public function getALLmaBibliotheque($id_user){
            $sql="SELECT b.id_user,j.*,u.nom,b.date_ajout as dateAjoutBiblio FROM bibliotheques b
                    join users u on b.id_user=u.id_user
                    join jeux j on j.id_jeu=b.id_jeu
                    where b.id_user=:id_user;
                    ";
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

    }
?>