<?php
/**
 * Todo : Modifiez le formulaire d'inscription ci-dessous, comprenant les champs suivants :
 * - identifiant
 * - mot de passe
 * - email
 * - bouton de validation
 *
 * La méthode du formulaire sera de type : POST
 * L'identifiant, l'email et le mot de passe sont des champs obligatoires
 * Le traitement du formulaire se fera dans le fichier app/user/signup.php
 */
?>
<form action="index.php?page=app/user/signup" method="post">
    <label for="username">Identifiant</label>
    <input type="text" id="username" name="username" class="form-control" required>
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" class="form-control" required>
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control" required>
    <input type="submit" value="Valider">
</form>
