<?php

/**
 * Todo : Créez une page affichant la liste des lignes aériennes possibles au départ et à destination des aéroports définis dans le formulaire view/client/travel
 *
 * Les aéroports devront être des destinations valides
 * La page devra respecter le tri en fonction du mode défini dans le formulaire ou l'url et également permettre de trier les résultats par prix du billet (mode eco), consommation de carburant (mode green) ou durée du voyage (mode speed)
 *
 * La consommation peut être obtenue via la fonction getConsByDistanceWithPassengers()
 * Le prix du billet peut être obtenu via la fonction getTicketPrice()
 * La durée du vol peut être obtenue via la fonction getFlightDuration()
 *
 * La colonne "réservation" contiendra un lien ou un formulaire créant une réservation pour l'utilisateur, dont le résultat sera géré dans le fichier app/client/reservation. Cette action nécessitera d'être connecté et d'avoir le rôle de client.
 *
 * La requête SQL permettant de récupérer la liste des lignes aériennes :
 */

$connect = connect();
$loc = $connect->prepare("SELECT l.*, (SELECT MAX(r.length) as length FROM location_runway lr, runway r WHERE lr.runwayid = r.id AND lr.locationid = l.id) as runway FROM location l WHERE l.id = ?");
$loc->execute([$_GET['start']]);
$start = $loc->fetchObject();
$loc->execute([$_GET['destination']]);
$destination = $loc->fetchObject();

if (!is_object($start) || !is_object($destination)) {
    $_SESSION['alert'] = 'Votre lieu de départ ou de destination est incorrect';
    $_SESSION['alert_level'] = 'danger';
    header('Location: index.php?page=view/client/travel');
    die;
} elseif ($start->id == $destination->id) {
    $_SESSION['alert'] = 'Votre lieu de départ doit être différent de votre lieu de destination';
    $_SESSION['alert_level'] = 'warning';
    header('Location: index.php?page=view/client/travel');
    die;
}

if (!in_array($_GET['mode'], ['eco', 'green', 'speed'])) {
    $_GET['mode'] = 'eco';
}

$distance = getDistance($start, $destination);

$airline_table = '';
$flights = [];
$sql = "SELECT CONCAT(id, '-0') as flightid,id as plane,`name`,`range`,fuel,cruise,passengers,landing,takeoff,cons_by_seat,pilots,engines,0 as price FROM airplane 
        UNION
        SELECT a.id as flightid,p.id as plane,CONCAT(p.name, ' (', c.name,' ', ca.serial,')') as `name`,p.range,p.fuel,p.cruise,p.passengers,p.landing,p.takeoff,p.cons_by_seat,p.pilots,p.engines,a.price 
        FROM airline a, location ls, location ld, company_airplane ca, airplane p, company c 
        WHERE a.startid = ls.id AND a.destinationid = ld.id AND a.airplaneid = ca.id AND ca.airplaneid = p.id AND ca.companyid = c.id AND a.startid = ? AND a.destinationid = ?";
$airlines = $connect->prepare($sql);
$airlines->execute([$start->id, $destination->id]);
$airlines->setFetchMode(PDO::FETCH_OBJ);
foreach ($airlines as $plane) {
    if ($plane->landing <= $destination->runway && $plane->takeoff <= $start->runway) {
        $cons = getConsByDistanceWithPassengers($plane->cons_by_seat, $distance, $plane->passengers);
        // Escales
        if ($plane->range >= $distance || $plane->fuel >= $cons) {
            $stopover = 0;
            $escale_txt = 'Pas d\'escale';
        } else {
            $stopover = floor($cons / $plane->fuel);
            $escale_txt = $stopover . ' escale(s)';
        }
        if (!$plane->price) {
            $ticket = getTicketPrice($plane, $distance, 20, $stopover);
        } else {
            $ticket = $plane->price;
        }
        if ($ticket) {
            $duration = getFlightDuration($plane->cruise, $distance, $stopover);
            $flights[$plane->flightid] = ['id' => $plane->flightid,
                'plane' => $plane->plane,
                'cons' => $cons,
                'name' => $plane->name,
                'ticket' => $ticket,
                'duration' => $duration,
                'stopover' => $stopover,
            ];
        }
    }
}


if ($_GET['mode'] == 'eco') {
    $sort_col = 'ticket';
} elseif ($_GET['mode'] == 'green') {
    $sort_col = 'cons';
} elseif ($_GET['mode'] == 'speed') {
    $sort_col = 'duration';
} else {
    $sort_col = 'name';
}
array_multisort(array_column($flights, $sort_col), SORT_ASC, $flights);
foreach ($flights as $flight) {
    $airline_table .= '<tr><td>' . $flight['name'] . '</td>
                        <td>' . $flight['ticket'] . '€</td>
                        <td>' . formatFlightDuration($flight['duration']) . '</td>
                        <td>' . $flight['stopover'] . '</td>
                        <td>' . $flight['cons'] . 'L</td>
                        <td></td>
                        </tr>';
}

?>
<h2>Vol</h2>
De <?=$start->name?> à <?=$destination->name?>
<br>Distance <?=$distance?> km
<br>Mode : <?=$_GET['mode']?>
<table class="table">
    <thead>
    <tr>
        <th>Avion</th>
        <th>Prix</th>
        <th>Durée</th>
        <th>Escales</th>
        <th>Conso</th>
        <th>Réservation</th>
    </tr>
    </thead>
    <tbody>
        <?=$airline_table?>
    </tbody>
</table>