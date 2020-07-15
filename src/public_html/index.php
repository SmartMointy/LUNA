<?php

use LUNA\core\LUNA;

// Require bootstrap file
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'LUNA' . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Create App
$App = new LUNA();

$App->run();
