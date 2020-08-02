<?php namespace LUNA\core;

class LUNA
{
    private Router $Router;

    public function __construct()
    {
        // Sets error reporting on/off based on the configuration
        self::setErrorReporting(Config::get('app/mode'));

        // Create Router
        $this->Router = new Router($this->getURL());

        // Sets the default language
        self::setApplicationLanguage($this->Router->getLanguage());

        // Start Session
        session_start();
    }

    private static function setErrorReporting(string $mode) : void
    {
        // Error configuration
        if ($mode === 'development') {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            ini_set('html_errors', 1);
        } else {
            error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            ini_set('html_errors', 1);
            ini_set('log_errors', ROOT . 'app' . DS . 'logs' . DS . 'php_errors.log');
        }
    }

    private function setApplicationLanguage(string $language) : void
    {
        Config::set('app/language', $language);
    }

    public function run() : void
    {
        // dispatch/route
        $this->Router->route();
    }

    private function getURL() : string
    {
        if (empty($_GET['url'])) {
            if (Config::get('app/redirect_empty_url/mode') === true) {
                header('Location: ' . DS . Lang::get(Config::get('app/redirect_empty_url/to')));
            }

            $_GET['url'] = Config::get('app/defaultPage');
        }
        return $_GET['url'];
    }

    private function getPreferredLanguage() : void
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
