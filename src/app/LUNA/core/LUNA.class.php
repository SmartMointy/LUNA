<?php namespace LUNA\core;

class LUNA
{
    private function __construct()
    {
        self::init();
    }

    private function run()
    {
        // dispatch/route
        new Router;
    }

    private function init()
    {
        // Define standard path
        define('ROOT', dirname(__FILE__) . '/..');

        // register autoloader
        self::autoload();

        // Error configuration
        if (Config::get('app/mode') === 'developement') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('html_errors', 1);
        } else {
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            ini_set('html_errors', 1);
            ini_set('log_errors', ROOT . '/app/logs/php_errors.log');
        }

        // sets the default language
        self::setApplicationLanguage();

        // Start Session
        session_start();
    } 

    private function setApplicationLanguage()
    {
        $prefLocales = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

        foreach ($prefLocales as $preflocale) {
            if (in_array(substr($preflocale, 0, 2), Config::get('app/all_languages'))) {
                Config::set('app/language', substr($preflocale, 0, 2));
                break; // end loop if language is found
            }
        }
    } 

    private function autoload()
    {
        spl_autoload_extensions(".php"); // comma-separated list
        spl_autoload_register();
    }
}
