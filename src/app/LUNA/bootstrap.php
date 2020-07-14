<?php

use LUNA\core\Autoloader;

// Require autoloader
require_once ROOT . DS . 'app' . DS . 'LUNA' . DS . 'core' . DS . 'Autoloader.php';

$loader = new Autoloader();
$loader->setNamespacePrefix('LUNA')
    ->setBaseDir('App')
    ->register();
