<?php

/**
 * Todo : Modifiez le formulaire de login ci-dessous :
 *
 * La méthode du formulaire sera de type : POST
 * Le traitement du formulaire se fera dans le fichier app/user/login.php
 *
 * Sous le formulaire, affichez un lien HTML menant vers le formulaire de création de compte (view/signup)
 *
 */
?>

<form action="index.php?page=app/user/login" method="post">
    <label for="username">Identifiant</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Login">
</form>
<a href="index.php?page=view/user/signup">Créer un compte</a>