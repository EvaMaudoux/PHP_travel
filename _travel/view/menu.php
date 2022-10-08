<?php

/**
 * Todo : Modifiez ce menu afin d'y intégrer les liens suivants :
 * - Profil utilisateur  (intitulé : "Profil")          (cette page ne sera accessible qu'aux utilisateurs connectés)
 * - Réservation de voyages (intitulé : "Voyage")       (cette page ne sera accessible qu'aux utilisateurs possédant le rôle "client")
 * - Liste des aéroports (intitulé : "Aéroports")       (cette page ne sera accessible qu'aux utilisateurs connectés)
 * - Création de compagnie (si aucune compagnie n'existe pour cet utilisateur)  (cette page ne sera accessible qu'aux utilisateurs possédant le rôle "manager")
 * - Profil de compagnie (si une compagnie existe pour cet utilisateur)         (cette page ne sera accessible qu'aux utilisateurs possédant le rôle "manager")
 * - Formulaire de connexion (intitulé : "Login")
 */

?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Air Travel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php?page=view/main" class="nav-link">Accueil</a>
                </li>
                <?php if (!empty($_SESSION['userid'])) { ?>
                <li class="nav-item">
                    <a href="index.php?page=view/client/profile" class="nav-link">Profil</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=view/client/airports" class="nav-link">Aéroports</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?page=view/client/travel" class="nav-link">Voyage</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <?php if (!empty($_SESSION['userid'])) { ?>
                        <a href="index.php?page=view/user/delog" class="nav-link">Delog</a>
                    <?php } else { ?>
                        <a href="index.php?page=view/user/login" class="nav-link">Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>