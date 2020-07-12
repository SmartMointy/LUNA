<?php

use LUNA\core\LUNA;
use LUNA\core\Autoloader;

// Define standard path
define('ROOT', dirname(__FILE__) . '\..');

// Require autoloader
require_once ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'LUNA' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Autoloader.class.php';

$loader = new Autoloader();
$loader->setNamespacePrefix('LUNA')
       ->setBaseDir('App')
       ->register();

// Create App
$App = new LUNA();

$App->run();
