<?php

// Define directory separator
define('DS', DIRECTORY_SEPARATOR);

// Define standard path
define('ROOT', dirname(__FILE__) . DS . '..' . DS);

// Define app dir
define('APP_DIRNAME', 'app');

// Register autoloader
spl_autoload_register(function($class) {
    $request = explode('\\', $class);

    $file = ROOT . implode(DS, $request) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Error('Class (' . $file . ') not found');
    }
});

