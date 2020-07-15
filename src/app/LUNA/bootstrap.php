<?php

use LUNA\core\Autoloader;

// Define directory separator
define('DS', DIRECTORY_SEPARATOR);

// Define standard path
define('ROOT', dirname(__FILE__) . DS .'..' . DS . '..' . DS);

// Require autoloader
require_once ROOT . 'app' . DS . 'LUNA' . DS . 'core' . DS . 'Autoloader.php';

$loader = new Autoloader();
$loader->setNamespacePrefix('LUNA')
    ->setBaseDir('App')
    ->register();
