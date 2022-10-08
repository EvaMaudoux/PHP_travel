<?php

/**
 * Todo : Créez un script de traitement du formulaire de création de compagnie (view/company/create.php)
 *
 * Les champs du formulaire doivent correspondre aux types de données requises en base de données (table <company>).
 * Le managerid sera l'identifiant de l'utilisateur connecté.
 * Le cash contiendra la valeur par défaut.
 * Si la création échoue, affichez le message suivant : "Erreur dans la création de le Compagnie"
 */

if (!empty($_POST['name']) && !empty($_POST['country'])) {

    $name = trim($_POST['name']);
    $output = '';

    $connect = connect();
    $c = $connect->prepare("SELECT * FROM country WHERE id = ?");
    $c->execute([$_POST['country']]);
    $country = $c->fetchObject();
    if (!is_object($country)) {
        createAlert('Pays invalide', 'danger', 'index.php?page=view/company/create');
    }

    //create company
    $insert = $connect->prepare("INSERT INTO company (name, countryid, managerid) VALUES (?, ?, ?)");
    $insert->execute([$name, $_POST['country'], $_SESSION['userid']]);
    if ($insert->rowcount()) {
        $companyid = $connect->lastInsertId();
        $output .= 'Compagnie ' . $name . ' créée avec succès';
    } else {
        echo 'Erreur dans la création de la Compagnie';
        exit;
    }

    // manage logo
    if ($_FILES['logo']['tmp_name'] &&
        $_FILES['logo']['name'] &&
        ($_FILES['logo']['type'] == 'image/png' || $_FILES['logo']['type'] == 'image/jpg' || $_FILES['logo']['type'] == 'image/jpeg')
    ) {
        $imagepath = str_replace( '\\', '/', getcwd() . '/image/company/logo');
        if (!is_dir($imagepath)) {
            mkdir($imagepath, 0755, true);
        }
        $ext = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
        $move = move_uploaded_file($_FILES['logo']['tmp_name'], $imagepath . '/' . $companyid . '.' . $ext);
        if ($move) {
            $output .= '<p>Votre logo a été créé</p>';
            $output .= '<img src="image/company/logo/' . $companyid . '.' . $ext . '" alt="' . $name . '">';
        } else {
            $output .= 'Votre logo n\'a pas été créé';
        }
    }
    echo $output;

}