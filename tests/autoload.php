<?php
spl_autoload_register(function($class) { 
    $request = explode('\\', $class);

    $class = __DIR__ . '/../src/app/' . implode(DIRECTORY_SEPARATOR, $request) . '.class.php';
    $controller = __DIR__ . '/../src/app/' . implode(DIRECTORY_SEPARATOR, $request) . '.controller.php';
    $model = __DIR__ . '/../src/app/' . implode(DIRECTORY_SEPARATOR, $request) . '.model.php';
    $helper = __DIR__ . '/../src/app/' . implode(DIRECTORY_SEPARATOR, $request) . '.helper.php';

    if (file_exists($class)) {
        require_once($class);
    } elseif (file_exists($controller)) {
        require_once($controller);
    } elseif (file_exists($model)) {
        require_once($model);
    } elseif (file_exists($helper)) {
        require_once($helper);
    }
});