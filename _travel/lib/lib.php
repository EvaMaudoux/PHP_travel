<?php

/**
 * Get distance (in km) between two locations
 *
 * @param object $a     location from DB or at least with longitude & latitude
 * @param object $b     location from DB or at least with longitude & latitude
 * @return float
 */
function getDistance(object $a, object $b): float
{
    $long = $a->longitude - $b->longitude;
    $dist = sin(deg2rad($a->latitude)) * sin(deg2rad($b->latitude)) + cos(deg2rad($a->latitude)) * cos(deg2rad($b->latitude)) * cos(deg2rad($long));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return round($miles * 1.609344);
}

/**
 * Get Fuel Consumption for a plane by distance & passengers
 *
 * @param float $cons_by_seat
 * @param int $distance
 * @param int $passengers
 * @return float
 */
function getConsByDistanceWithPassengers(float $cons_by_seat, int $distance, int $passengers) : float
{
    return round($cons_by_seat * $distance * $passengers, 2);
}

/**
 * Get Cost of Flight for a number of planes by distance, passengers and stopover
 *
 * @param object $plane
 * @param int $distance
 * @param int $passengers
 * @param int $plane_nbr
 * @param int $stopover
 * @return int
 */
function getFlightCost(object $plane, int $distance, int $passengers, int $plane_nbr = 1, int $stopover = 0) : int
{
    if (($plane_nbr > 1 || $stopover > 0) || ($plane->range >= $distance && $plane->passengers >= $passengers && $plane_nbr == 1 && $stopover == 0)) {
        $cons = getConsByDistanceWithPassengers($plane->cons_by_seat, $distance, min($passengers, $plane->passengers));
        return ((($distance * $plane->engines * 5) + ($plane->pilots * 1000) + ($stopover * 1000) + ($cons * 2) + 5000 + ($plane->price / 100000)) * $plane_nbr);
    } else {
        return 0;
    }
}

/**
 * @param object $plane
 * @param int $distance
 * @param int $passengers
 * @param int $ticket_price
 * @param int $plane_nbr
 * @param int $stopover
 * @param int $dist_mult_margin
 * @return float
 */
function getFlightBenefice(object $plane, int $distance, int $passengers, int $ticket_price = 0, int $plane_nbr = 1, int $stopover = 0, int $dist_mult_margin = 20): float
{
    if (!$ticket_price) {
        $ticket_price = getTicketPrice($plane, $distance, $dist_mult_margin, $stopover);
    }
    return ($ticket_price * $passengers) - getFlightCost($plane, $distance, $passengers, $plane_nbr, $stopover);
}

/**
 * Benefice decreased by available seats income
 *
 * @param float $benefice
 * @param float $ticket_price
 * @param int $free_seats
 * @return float
 */
function getFlightProfitMargin(float $benefice, float $ticket_price, int $free_seats) : float
{
    return $benefice - ($ticket_price * $free_seats);
}

/**
 * Simulate an average Flight Ticket cost
 *
 * @param object $plane
 * @param int $distance
 * @param int $dist_mult_margin
 * @param int $stopover
 * @return float
 */
function getTicketCost(object $plane, int $distance, int $dist_mult_margin = 20, int $stopover = 0): float
{
    return (($distance * $dist_mult_margin) + ($distance * $plane->engines * 5) + ($plane->pilots * 1000) + ($stopover * 1000) + ($plane->cons_by_seat * $plane->passengers * $distance * ($dist_mult_margin / 4)) + 5000) / $plane->passengers;
}

/**
 * Simulate an average Flight Ticket price (with a minimum of 99)
 *
 * @param object $plane
 * @param int $distance
 * @param int $dist_mult_margin
 * @param int $stopover
 * @return int
 */
function getTicketPrice(object $plane, int $distance, int $dist_mult_margin = 20, int $stopover = 0) : int
{
    return ceil(max( 99, getTicketCost($plane, $distance, $dist_mult_margin, $stopover)));
}

/**
 * Get Flight duration in minutes
 *
 * @param int $cruise
 * @param int $distance
 * @param int $stopover
 * @return string
 */
function getFlightDuration(int $cruise, int $distance, int $stopover = 0) : string
{
    return round(60 * (($distance / $cruise) + $stopover));
}

/**
 * Format Flight duration as 'XXHYYmin'
 *
 * @param int $time
 * @return string
 */
function formatFlightDuration(int $time): string
{
    $hours = floor($time / 60);
    $minutes = str_pad(($time % 60), 2, '0', STR_PAD_LEFT);
    return $hours . 'H' . $minutes . 'min';
}

/**
 * Create a random airplane serial number
 *
 * @param int $companyid
 * @param int $airplaneid
 * @return string
 */
function createAirplaneSerial(int $companyid, int $airplaneid)
{
    $characters = '0123456789';
    $length = strlen($characters);
    $randstring = $companyid . '-' . $airplaneid . '-';
    for ($i = 0; $i < 12; $i++) {
        $randstring .= $characters[rand(0, $length - 1)];
    }
    return $randstring;
}

/**
 * Simulate a random passengers demand
 *
 * @param int $distance
 * @return int
 */
function getRandPassengersByDistance(int $distance): int
{
    if ($distance < 500) {
        $passengers_max = 200;
    } else {
        $passengers_max = 500;
    }
    return mt_rand(50, $passengers_max);
}
