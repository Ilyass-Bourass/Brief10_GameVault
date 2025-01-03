<?php
   
class Utilisateur {
    private $connexion;
    private $id_utilisateur;
    private $nom;
    private $email;
    private $motpass;

    public function __construct($nom = "", $email = "", $motpass = "") {
        $this->nom = $nom;
        $this->email = $email;
        $this->motpass = $motpass;
    }

   
    public function getIdUtilisateur() {
        return $this->id_utilisateur;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotpass() {
        return $this->motpass;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setMotpass($motpass) {
        $this->motpass = password_hash($motpass, PASSWORD_DEFAULT);
    }

    public function inscrire(){

    }

    public function connecter(){

    }

    public function modifierMonProfil(){

    }

}
?>