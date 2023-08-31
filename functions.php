<?php

// THEME SETUP

/**
 * PSR-4 class autoloader
 */
if (file_exists(__DIR__ . "/" . "vendor/autoload.php")) {
    require_once __DIR__ . "/" . "vendor/autoload.php";
} else {
    error_log("Please, install composer dependencies in a theme directory: " . __DIR__);
}

use App\Theme;
$theme = Theme::getInstance();
