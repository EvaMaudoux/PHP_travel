<?php

/**
 * @param string $view
 * @return void
 */
function getView(string $view): void
{
    $exts = ['html', 'php'];
    if (!empty($view)) {
        foreach ($exts as $ext) {
            $complete_path = $view . '.' . $ext;
            if (file_exists($complete_path)) {
                include_once $complete_path;
            }
        }
    } else {
        header('Location: index.php?page=view/main');
        die;
    }
}
