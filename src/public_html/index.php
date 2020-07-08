<?php

//Define standart path
define('ROOT', dirname(__FILE__) . '/..');

//Load Initialization file
require_once ROOT.'/app/core/init.php';

//Create router
$Router = new Router;
