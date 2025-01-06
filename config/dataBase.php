<?php
class Database {
    private $host = "localhost";
    private $db_name = "GameVault";
    private $username = "root";
    private $password = "";
    public $connexion;
    
    public function getConnection() {
        try {
            $this->connexion = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "connexion réussite";
            return $this->connexion;
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            return null;
        }
    }
}