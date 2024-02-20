<?php

namespace API\models;

use API\config\Database;

class Users {

    // Propriétés
    private $id;
    private $username;
    private $email;
    private $password;
    private $created_on;
    
    // Constructeur
    public function __construct($id, $username, $email, $password, $created_on) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->created_on = $created_on;
    }

    // Méthode de création d'un nouvel utilisateur
    public static function createUser($username, $email, $password) {
        // Connexion à la base de données
        $database = new Database();
        $pdo = $database->connect();

        // Préparation de la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, created_on) VALUES (:username, :email, :password, NOW())");
        
        // Liaison des paramètres avec les valeurs fournies
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération de l'ID du nouvel utilisateur
        $id = $pdo->lastInsertId();
        
        // Création d'une nouvelle instance de Users avec les données insérées dans la base de données
        return new self($id, $username, $email, $password, date('Y-m-d H:i:s'));
    }

    // Méthode de mise à jour d'un utilisateur
    public function updateUser($username, $email, $password) {
        // Connexion à la base de données
        $database = new Database();
        $pdo = $database->connect();

        // Préparation de la requête de mise à jour
        $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id");
        
        // Liaison des paramètres avec les nouvelles valeurs
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $this->id);
        
        // Exécution de la requête
        $stmt->execute();

        // Mise à jour des propriétés de l'objet avec les nouvelles valeurs
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
}
?>
