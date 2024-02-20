<?php

namespace API\controllers;

use API\models\Users;
// Inclure le fichier contenant la fonction sendJsonResponse


class UsersController {

    public function createUser($username, $email, $password) {
        // Appel à la méthode statique de création d'un utilisateur
        $user = Users::createUser($username, $email, $password);

        $data = [
            "id" => $username,
            'username' => $username,
            'email' => $email,
        ];
        // Vérifie si l'utilisateur a été créé avec succès
        if ($user) {
            // Envoie la réponse JSON avec les informations de l'utilisateur créé
            sendJsonResponse(['success' => true, 'data' => $data], 200);
        } else {
            // Envoie une réponse JSON en cas d'échec de création de l'utilisateur
            sendJsonResponse(['success' => false, 'error' => 'Failed to create user'], 500);
        }
    }

}

