<?php

$files = glob(PASSION_IMPACT_THEME_ROOT . "/functions/*.php"); // return array files

foreach($files as $phpFile) {
    require_once("$phpFile");
}
