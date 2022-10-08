<?php

/**
 * Todo : Cette page affichera le profil de la Compagnie dont l'utilisateur connecté est le manager
 *
 * Requête SQL pour obtenir la flotte : "SELECT a.*, ca.serial FROM airplane a, company_airplane ca WHERE ca.airplaneid = a.id AND ca.companyid = ? ORDER BY a.name"
 * Requête SQL pour obtenir les lignes aériennes : "SELECT ls.name as start, ld.name as destination, p.name as plane, ca.serial, p.passengers, a.price FROM airline a, location ls, location ld, company_airplane ca, airplane p WHERE a.startid = ls.id AND a.destinationid = ld.id AND a.airplaneid = ca.id AND ca.airplaneid = p.id AND ca.companyid = ?"
 *
 * Le coût d'un vol peut être obtenu via la fonction getFlightCost()
 *
 */

?>
<h2>...Nom de la compagnie...</h2>
<table class="table" style="max-width:600px;">
    <tr>
        <th>Pays</th>
        <td></td>
    </tr>
    <tr>
        <th>Manager</th>
        <td></td>
    </tr>
    <tr>
        <th>Banque</th>
        <td></td>
    </tr>
</table>
<h3>Flotte</h3>
<a href="index.php?page=view/company/fleet">Commander un avion</a>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Avion</th>
            <th>Coût</th>
            <th>Passagers</th>
            <th>Rayon d\'action</th>
            <th>Vitesse</th>
            <th>Piste</th>
            <th>Coût km/passager<br>max dist & charge</th>
            <th>Coût km/passager<br>(40p/100km)</th>
            <th>Coût km/passager<br>(50p/500km)</th>
            <th>Coût km/passager<br>(100p/1000km)</th>
            <th>Coût km/passager<br>(100p/5000km)</th>
            <th>Coût km/passager<br>(250p/10000km)</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<h3>Lignes aériennes</h3>
<table class="table">
    <thead>
    <tr>
        <th>Départ</th>
        <th>Destination</th>
        <th>Avion</th>
        <th>Serial</th>
        <th>Passagers</th>
        <th>Prix</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>
<a href="index.php?page=view/company/simulation">Définir une ligne aérienne</a>
