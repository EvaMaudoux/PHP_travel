<?php

/**
 * Todo : Créez un script de traitement du formulaire d'inscription (view/signup.php)
 *
 * L'identifiant <username>, l'email <email> le mot de passe <password> du formulaire doivent correspondre aux type de données requises en base de données (table <user>).
 * Le mot de passe doit être crypté en base de données !
 * L'adresse e-mail doit être une adresse e-mail valide
 * La date de création <created> contiendra la date et l'heure de la création. Les dates de modification <modified> et de dernière connexion <lastlogin> resteront vides. Le statut <status> sera défini à sa valeur par défaut.
 * Si la création échoue, affichez le message suivant : "Erreur dans la création de l'utilisateur", ainsi qu'un lien HTML permettant de revenir au formulaire d'inscription
 * L'utilisateur nouvellement créé via ce formulaire recevra le rôle 'client' (table <role>). Insérez les données dans la table <user_role> pour cet utilisateur.
 */

if (!empty($_POST['username']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

    $username = trim($_POST['username']);
    $connect = connect();
    $insert = $connect->prepare("INSERT INTO user (username, password, email, created) VALUES (?, ?, ?, NOW())");
    $insert->execute([$username, password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']]);
    if ($insert->rowcount()) {
        echo 'Utilisateur ' . $username . ' avec l\'adresse email ' . $_POST['email'] . ' créé avec succès';
        $client = $connect->prepare("INSERT INTO user_role (userid, roleid) VALUES (?, 3)");
        $client->execute([$connect->lastInsertId()]);
        if ($client->rowcount()) {
            echo 'Votre utilisateur ' . $username . ' a l\'accès client. Il peut accéder à la réservation de voyage.';
        }
    } else {
        echo 'Erreur dans la création de l\'utilisateur';
    }
}
