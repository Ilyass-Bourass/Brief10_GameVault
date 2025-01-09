<?php 

class Utilisateur {
    private $connexion;
    private $id_utilisateur;
    private $nom;
    private $email;
    private $motpass;

    public $errors = [];
    public $errorsMotPass = [];

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAllutilsateurNotBanni() {
        $sql = "SELECT u.* FROM users u 
                LEFT JOIN user_banni b ON u.id_user = b.id_user 
                WHERE b.id_user IS NULL";
                
        $query = $this->connexion->prepare($sql);
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password) {
        /* 
        ************************************
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

    public function getErrorsPass(){
        return $this->errorsMotPass;
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

    public function supprimerutilsateur($id_user){
        $sql="DELETE from users WHERE id_user=:id_user";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_user"=>$id_user
        ]);
    }

    public function baniUtilsateur($id_user,$raison){
        $sql="INSERT INTO user_banni(id_user,raison) VALUES (:id_user,:raison)";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_user"=>$id_user,
            ":raison"=>$raison
        ]);
    }

    public function débaniUtilsateur($id_user){
        $sql="DELETE FROM user_banni WHERE id_user=:id_user";
        $query=$this->connexion->prepare($sql);
        $query->execute([
            ":id_user"=>$id_user
        ]);
    }

    public function isBanni($id_user) {
        $sql = "SELECT * FROM user_banni WHERE id_user = :id_user";
        $query = $this->connexion->prepare($sql);
        $query->execute([
            ":id_user" => $id_user
        ]);
        return $query->rowCount() > 0;
    }

    public function getAllUtilsateurBani(){
        $sql="SELECT u.*,b.date_bannissement,b.raison FROM users u 
        INNER JOIN user_banni b ON 
        u.id_user=b.id_user " ;
        $query=$this->connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inscrire(){

    }

    public function connecter(){

    }

    public function modifierMonProfil(){

    }

    public function modifierRole($id_user,$role){
        try{
             $sql="UPDATE users SET role=:role WHERE id_user=:id_user";
            $query=$this->connexion->prepare($sql);
            $query->execute([
            ':role'=>$role,
            ':id_user'=>$id_user,
        ]);
        }catch(PDOexception $e){
            echo "message".$e->getmessage();
        }
       
    }

    public function profil($id_utilisateur){
        $query = "SELECT * FROM users WHERE id_user = :id_user";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute([':id_user' => $id_utilisateur]);
        return $stmt->fetch(PDO:: FETCH_ASSOC);
    }
    
    public function resetPassword($user_id, $CurrentPass, $newPassword, $confirmNewPass, $oldPassHach) {
        if (empty($CurrentPass)) {
            array_push($this->errorsMotPass, "Current Password is required");
            return false;
        } elseif (empty($newPassword)) {
            array_push($this->errorsMotPass, "New password is required");
            return false;
        } elseif (empty($confirmNewPass)) {
            array_push($this->errorsMotPass, "Confirm password is required");
            return false;
        } elseif (strlen($newPassword) < 6) {
            array_push($this->errorsMotPass, "Password must be at least 6 characters");
            return false;
        }
    
        if (!password_verify($CurrentPass, $oldPassHach)) {
            array_push($this->errorsMotPass, "Current password does not match");
            return false;
        } elseif ($newPassword !== $confirmNewPass) {
            array_push($this->errorsMotPass, "New password and confirmation do not match");
            return false;
        }
    
        if (empty($this->errorsMotPass)) {
            $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
            $query = "UPDATE users SET mot_passe = :new_Pass WHERE id_user = :id_user";
            $stmt = $this->connexion->prepare($query);
            $stmt->execute([
                ':new_Pass' => $passwordHash,
                ':id_user' => $user_id
            ]);
            return true;
        }
        return false;
    }
    

    public function changerInfoProfil($name, $email, $userId){
        if(empty($name)){
            array_push($this->errors, "Le nom d'utilisateur est requis");
            return false;
        }

        if (strlen($name) < 3 || strlen($name) > 20) {
            array_push($this->errors, "Le nom d'utilisateur doit comporter entre 3 et 20 caracteres");
            return false;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($this->errors, "Format d'email invalide");
            return false;
        }

        if(empty($this->ErrorsChangeInfo)){
            try{
                $query = "UPDATE users SET nom = :nom, email = :email WHERE id_user = :id_user";
                $stmt = $this->connexion->prepare($query);
                $stmt->execute([
                    ':nom' => $name,
                    ':email' => $email,
                    ':id_user' => $userId
                ]);
                return true ;
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
        }
        
    }


    public function uploadImage($fileName, $fileTmpName, $fileSize, $fileError, $user_id) {
        $fileExt = explode('.', $fileName);
        $fileType = strtolower(end($fileExt));
        $allowed = array('png','jpeg','jpg');

        if (!in_array($fileType, $allowed)) {
            array_push($this->errors, "You cannot upload this file type.");
            return false;
        } elseif ($fileError !== 0) {
            array_push($this->errors, "There was an error uploading the file.");
            return false;
        } elseif ($fileSize > 2000000) {
            array_push($this->errors, "Your file is too big.");
            return false;
        } else {
            // if (!file_exists('uploads')) {
            //     mkdir('uploads', 0777, true);
            // }

            $newNameImage = uniqid('', true) . "." . $fileType;
            $fileDestination = 'uploads/' . $newNameImage;

            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                try {
                    $query = "UPDATE users SET profil_photo = :profil_photo WHERE id_user = :id_user";
                    $stmt = $this->connexion->prepare($query);
                    $stmt->execute([
                        ':profil_photo' => $fileDestination,
                        ':id_user' => $user_id
                    ]);
                    return true; 
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                    return false; 
                }
            } else {
                array_push($this->errors, "Something went wrong during the upload!");
                return false;
            }
        }
    }
    
    public function SelectImageProfil($user_id){
        $query = "SELECT profil_photo FROM users WHERE id_user = :user_id";
        $stmt = $this->connexion->prepare($query);
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO:: FETCH_ASSOC);
    }
}

?>