<?php

/**
 * Todo : Créez une page affichant les informations de l'utilisateur connecté dans le tableau HTML ci-dessous
 *
 * Dans un second temps, affichez la liste des réservations associées à cet utilisateur (table <airline_reservation>)
 * Requête SQL pour les réservations :
 * "SELECT ls.name as start, ld.name as destination, a.price, c.name as company, p.name as plane, ca.serial, ar.created
 * FROM airline_reservation ar, airline a, company_airplane ca, airplane p, location ls, location ld, company c
 * WHERE ar.airlineid = a.id AND a.airplaneid = ca.id AND ca.airplaneid = p.id AND a.startid = ls.id AND a.destinationid = ld.id AND ca.companyid = c.id AND ar.userid = ?"
 */


if (empty($_SESSION['userid'])) {
    header('Location: index.php?page=view/user/login');
    die;
}

$table_reservations = '';
$sql_reservations = "SELECT ls.name as start, ld.name as destination, a.price, c.name as company, p.name as plane, ca.serial, ar.created
            FROM airline_reservation ar, airline a, company_airplane ca, airplane p, location ls, location ld, company c
            WHERE ar.airlineid = a.id AND a.airplaneid = ca.id AND ca.airplaneid = p.id AND a.startid = ls.id AND a.destinationid = ld.id AND ca.companyid = c.id AND ar.userid = ?";

$connect = connect();

// get user
$stmt = $connect->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$_SESSION['userid']]);
$user = $stmt->fetchObject();

if (!is_a($stmt, 'PDOStatement') || !is_object($user)) {
    header('Location: index.php');
    die;
}

// get reservations
$reservations = $connect->prepare($sql_reservations);
$reservations->execute([$_SESSION['userid']]);
$reservations->setFetchMode(PDO::FETCH_OBJ);
foreach ($reservations as $reservation) {
    $table_reservations .= '<tr><td>' . $reservation->start . '</td>
                    <td>' . $reservation->destination . '</td>
                    <td>' . $reservation->company . '</td>
                    <td>' . $reservation->plane . '<br><small>' . $reservation->serial . '</small></td>
                    <td>' . $reservation->price . '€</td>
                    <td>' . $reservation->created . '</td>
               </tr>';
}

?>
<h2>Profil</h2>
<table class="table" style="max-width:600px;">
    <tr>
        <th>Identifiant</th>
        <td><?=$user->username?></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?=$user->email?></td>
    </tr>
    <tr>
        <th>Membre depuis</th>
        <td><?=$user->created?></td>
    </tr>
    <tr>
        <th>Dernière connexion</th>
        <td><?=$user->lastlogin?></td>
    </tr>
</table>
<h3>Réservations</h3>
<table class="table">
    <thead>
    <tr>
        <th>Départ</th>
        <th>Destination</th>
        <th>Compagnie</th>
        <th>Avion</th>
        <th>Prix</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
        <?=$table_reservations?>
    </tbody>
</table>
