<?php
 
class Jeu {
    private $id_jeu;
    private $titre;
    private $description;
    private $note;
    private $tempsJeu;

    public function __construct($titre = "", $description = "", $note = 0, $tempsJeu = 0) {
        $this->titre = $titre;
        $this->description = $description;
        $this->note = $note;
        $this->tempsJeu = $tempsJeu;
    }

    public function getIdJeu() {
        return $this->id_jeu;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getNote() {
        return $this->note;
    }

    public function getTempsJeu() {
        return $this->tempsJeu;
    }

    public function setIdJeu($id_jeu) {
        $this->id_jeu = $id_jeu;
    }

    public function setTitre($titre) {
        if (!empty($titre)) {
            $this->titre = $titre;
        } else {
            throw new Exception("Le titre ne peut pas être vide");
        }
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setNote($note) {
        if ($note >= 0 && $note <= 5) {
            $this->note = $note;
        } else {
            throw new Exception("La note doit être comprise entre 0 et 5");
        }
    }

    public function setTempsJeu($tempsJeu) {
        if ($tempsJeu >= 0) {
            $this->tempsJeu = $tempsJeu;
        } else {
            throw new Exception("Le temps de jeu ne peut pas être négatif");
        }
    }

    public function ajouterJeu(){

    }

    public function supprimerJeu($Id_jeu){

    }

    public function modifierJeu($Id_jeu){

    }

    public function changerStatuJeu($Id_jeu){

    }

}
?>