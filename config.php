<?php

define('GLPI_ROOT', '../..');
include (GLPI_ROOT . "/inc/includes.php");
require __DIR__ . '/vendor/autoload.php';

Session::checkRight("config", UPDATE);

// To be available when plugin in not activated
Plugin::load('advtickets');

Html::header("ADV Tickets", $_SERVER['PHP_SELF'], "config", "plugins");



Html::footer();