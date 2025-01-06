<?php 

class Utilisateur {
    private $connexion;
    private $id_utilisateur;
    private $nom;
    private $email;
    private $motpass;

    public $errors = [];

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function register($name, $email, $password) {
        /* *********************************
        ************ validation ************
        ************************************
        */
        if(empty($name)){
            array_push($this->errors, "Le nom d'utilisateur est requis");
        }

        if (strlen($name) < 3 || strlen($name) > 20) {
            array_push($this->errors, "Le nom d'utilisateur doit comporter entre 3 et 20 caracteres");
        } 

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errors, "Format d'email invalide");
        }

        if(empty($password)){
            array_push($this->errors, "Le mot de passe est requis");
        }

        if(strlen($password) < 6){
            array_push($this->errors, "Le mot de passe doit comporter au moins 6 caracteres");
        }

        if(empty($this->errors)){
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':email' => $email]);
            $userExist = $stmt->fetch(PDO::FETCH_ASSOC);
            if($userExist){
                array_push($this->errors, "Cet email est deja enregistre");
                return false;
            }
            
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (nom, email, mot_passe) VALUES (:nom, :email, :mot_passe)";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':nom' => $name, ':email' => $email, ':mot_passe' => $passwordHash]);
            return true;
        } else {

            return false;
        }
    }

    public function signin($email, $password){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errors, "Format d'email invalide");
        }
        if(empty($password)){
            array_push($this->errors, "Le mot de passe est requis");
        }

        if(empty($errors)){
            $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([':email' => $email]);
            $userExists = $stmt->fetch(PDO:: FETCH_ASSOC);
            if(!$userExists){
                array_push($this->errors, "Cet email n'a pas ete trouve");
                return false;
            }else{
                if(password_verify($password, $userExists['mot_passe'])){
                    session_start();
                    $_SESSION['is_login'] = true ;
                    $_SESSION['user_id'] = $userExists['id_user'] ;
                    $_SESSION['nom'] = $userExists['nom'];
                    $_SESSION['role'] = $userExists['role'];
                    return true;
                }else {
                    array_push($this->errors, "Mot de passe invalide");
                }
            }
        }
    }

    public function getErrors() {
        return $this->errors;
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