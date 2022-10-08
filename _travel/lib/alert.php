<?php


/**
 * @param string $text
 * @param string $level
 * @param string $redirect
 * @return void
 */
function createAlert(string $text, string $level = 'info', string $redirect = 'index.php?page=view/main'): void
{
    $_SESSION['alert'] = $text;
    $_SESSION['alert_level'] = $level;
    header('Location: ' . $redirect);
    die;
}

/**
 * @return void
 */
function manageAlerts(): void
{
    if (!empty($_SESSION['alert']) && !empty($_SESSION['alert_level'])) {
        echo '<div class="alert alert-' . checkAlertLevel() . '">' . $_SESSION['alert'] . '</div>';
        unset($_SESSION['alert']);
        unset($_SESSION['alert_level']);
    }
}

/**
 * @return string
 */
function checkAlertLevel(): string
{
    if (!empty($_SESSION['alert_level'])) {
        if (in_array($_SESSION['alert_level'], ['success', 'danger', 'info'])) {
            return $_SESSION['alert_level'];
        } else {
            return 'info';
        }
    }
    return '';
}
