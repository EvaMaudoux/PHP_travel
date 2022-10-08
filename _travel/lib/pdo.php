<?php

/**
 * Todo : Créez ici une fonction de connexion à la base de données (utilisez PDO)
 * Cette fonction devra être utilisée partout dans l'app lorsqu'une connexion à la DB sera nécessaire
 */

/**
 * @return PDO|void
 */
function connect()
{
    global $connect;

    if (is_a($connect, 'PDO')) {
        return $connect;
    } else {
        try {
            $connect = new PDO('mysql:dbname=travel;host=localhost;charset=utf8', 'root', '');
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die ('Erreur: ' . $exception->getMessage());
        }
        return $connect;
    }
}