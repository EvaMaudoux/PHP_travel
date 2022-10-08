<?php
/**
 * Todo : Ce script déconnectera l'utilisateur connecté
 */

session_unset();
session_destroy();
session_write_close();
header('Location: index.php');
die;