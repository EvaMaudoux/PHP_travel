<?php

/**
 * Todo : Modifiez le formulaire de simulation de vol ci-dessous, comprenant les champs suivants :
 * - compagnie, parmi la liste des compagnies dont l'utilisateur connecté est manager, triés par ordre alphabétique (table <company>)
 * - aéroport de départ, parmi la liste des aéroports (table <location>), triés par ordre alphabétique
 * - aéroport de destination, parmi la liste des aéroports (table <location>), triés par ordre alphabétique
 * - nombre de passagers
 * - marge bénéficiaire souhaitée
 * - bouton de validation
 *
 * Ce formulaire ne sera accessible qu'aux utilisateurs ayant le rôle de 'manager' ou 'admin'
 * La méthode du formulaire sera de type : POST
 * Le traitement du formulaire se fera dans le fichier app/company/simulation.php
 */
?>

<h2>Simulation de Voyage</h2>
<hr>
<form action="">
    <label for="company">Compagnie</label>
    <select name="company" id="company" class="form-control form-300">
    </select>
    <label for="start">Départ</label>
    <select name="start" id="start" class="form-control form-300">
    </select>
    <label for="destination">Destination</label>
    <select name="destination" id="destination" class="form-control form-300">
    </select>
    <label for="passengers">Passagers</label>
    <input type="number" name="passengers" id="passengers" min="1" max="999" class="form-control form-300">
    <label for="margin">Marge souhaitée</label>
    <input type="number" name="margin" id="margin" min="1" max="2147483647" class="form-control form-300">
    <input type="submit">
</form>
