<?php

// Setup our theme constants
define('PASSION_IMPACT_THEME_ROOT', __DIR__);

require_once(__DIR__ . '/vendor/autoload.php');

// Autoload our functions
require_once(__DIR__ . '/functions/autoload.php');

// Bootstrap our classes
if (file_exists(__DIR__ . '/PassionImpactBootstrap.php')) {
    require_once(__DIR__ . '/PassionImpactBootstrap.php');
}
