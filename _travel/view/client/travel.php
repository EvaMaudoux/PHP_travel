<?php

/**
 * Todo : Créez un formulaire permettant à un client de sélectionner un voyage. Le formulaire comprendra :
 * - un lieu de départ (parmi la liste des aéroports, table <location>)
 * - un lieu de destination (parmi la liste des aéroports, table <location>)
 * - un mode (eco, green ou speed)
 *
 * Le formulaire sera traité par le fichier app/client/travel.php
 * Le résultat du formulaire devra être accessible via une URL directe
 */
$locations = '';
$connect = connect();
$locs = $connect->query("SELECT * FROM location ORDER BY name", PDO::FETCH_OBJ);
foreach ($locs as $loc) {
    $locations .= '<option value="' . $loc->id . '">' . $loc->name . '</option>';
}
?>
<h2>Réservation de vol</h2>
<form action="index.php?page=app/client/travel">
    <input type="hidden" name="page" value="app/client/travel">
    <label for="start">Départ</label>
    <select name="start" id="start" class="form-control">
        <?=$locations?>
    </select>
    <label for="destination">Destination</label>
    <select name="destination" id="destination" class="form-control">
        <?=$locations?>
    </select>
    <input type="radio" name="mode" value="eco" id="eco" checked><label for="eco">Eco</label>
    <input type="radio" name="mode" value="green" id="green"><label for="green">Green</label>
    <input type="radio" name="mode" value="speed" id="speed"><label for="speed">Speed</label>
    <br>
    <input type="submit">
</form>
