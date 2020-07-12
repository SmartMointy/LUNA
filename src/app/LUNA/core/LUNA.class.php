<?php namespace LUNA\core;

class LUNA
{
    public function __construct()
    {
        self::init();
    }

    public function run()
    {
        // dispatch/route
        new Router;
    }

    private function init()
    {
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
}
