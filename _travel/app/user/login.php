<?php

/**
 * Todo : Créez un script de traitement du formulaire de login (view/login.php)
 *
 * L'identifiant et le mot de passe du formulaire doivent correspondre à un identifiant et un mot de passe d'utilisateur valide en base de données (table <user>), validant la connexion
 * Si un paramètre est manquant ou si l'identification échoue, affichez un message d'erreur, ainsi qu'un lien HTML permettant de revenir au formulaire de login
 * Si la connexion est validée, la date de la dernière connexion <lastlogin> de l'utilisateur sera mise à jour avec la date et l'heure courante, et l'utilisateur sera connecté (session), lui donnant accès aux pages réservées de l'app.
 */

if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $connect = connect();
    $request = $connect->prepare('SELECT * FROM user WHERE username = ?');
    $request->execute([$_POST['username']]);
    $user = $request->fetchObject();
    if (password_verify($_POST['password'], $user->password)) {
        $update = $connect->prepare('UPDATE user SET lastlogin = NOW() WHERE id = ?');
        $update->execute([$user->id]);
        $_SESSION['userid'] = $user->id;
        createAlert('Bienvenue ' . $user->username, 'success', 'index.php?page=view/client/profile');
    } else {
        echo "Paramètres invalides!";
    }
}
