<?php

/**
 * Todo : Modifiez le formulaire de création de Compagnie ci-dessous, comprenant les champs suivants :
 * - nom
 * - pays, parmi la liste des pays, triés par ordre alphabétique (table <country>)
 * - une image comme logo
 * - bouton de validation
 *
 * Ce formulaire ne sera accessible qu'aux utilisateurs ayant le rôle de 'manager' ou 'admin'
 * La méthode du formulaire sera de type : POST
 * Le nom est un champ obligatoire
 * Le traitement du formulaire se fera dans le fichier app/company/create.php
 */

$connect = connect();
$countries = '';
$loc = $connect->query("SELECT * FROM country ORDER BY name", PDO::FETCH_OBJ);
foreach ($loc as $country) {
    $countries .= '<option value="' . $country->id . '">' . $country->name . '</option>';
}

?>
<form action="index.php?page=app/company/create" method="post" enctype="multipart/form-data">
    <label for="name">Nom</label>
    <input type="text" id="name" name="name" class="form-control" required>
    <label for="country">Pays</label>
    <select name="country" id="country" class="form-control">
        <?= $countries ?>
    </select>
    <input type="file" name="logo">
    <input type="submit" value="Créer">
</form>
