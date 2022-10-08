<?php

session_start();

if (!isset($_SESSION['userid'])) {
    $_SESSION['userid'] = 0;
}

require_once __DIR__ . '/lib/pdo.php';
require_once __DIR__ . '/lib/output.php';
require_once __DIR__ . '/lib/lib.php';
require_once __DIR__ . '/lib/alert.php';

$connect = connect();

include_once __DIR__ . '/view/header.php';
include_once __DIR__ . '/view/menu.php';
include_once __DIR__ . '/view/main.php';
include_once __DIR__ . '/view/footer.php';