<?php

use LUNA\core\LUNA;

// Define directory separator
define('DS', DIRECTORY_SEPARATOR);

// Define standard path
define('ROOT', dirname(__FILE__) . DS .'..' . DS);

// Require bootstrap
require_once ROOT . 'app' . DS . 'LUNA' . DS . 'bootstrap.php';

// Create App
$App = new LUNA();

$App->run();
