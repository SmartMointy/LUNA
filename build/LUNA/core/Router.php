<?php declare(strict_types=1); namespace LUNA\core;

use Error;

class Router
{
    private array $URL;

    private string $controller = 'Errors';

    private string $method = 'page_not_found';

    private string $lang = '';

    /*
     * [controller] or [controller, method]
     */
    private array $route;

    private array $params = [];

    public function __construct(string $url)
    {
        $this->URL = $this->parseURL($url);

        $this->controller = $this->getControllerByURL($this->URL);

        $this->method = $this->getMethodByURL($this->URL);

        $this->params = $this->getParamsByURL($this->URL);

        //Check if too much or too less arguments are passed, if so load errors controller and show 404
        if ($this->checkParamCount()) {
            $this->controller = 'Errors';
            $this->method = 'pageNotFound';
            $this->params = [];
        }
    }

    public function route() : void
    {
        $controller = APP_DIRNAME . "\\controllers\\" . $this->controller;
        $controller = new $controller;

        $controller->beforeAction();

        // Call selected method in the selected controller and pass params
        call_user_func_array([$controller, $this->method], $this->params);

        $controller->afterAction();
    }

    private function getControllerByURL(array $url) : string
    {
        // The default controller if nothing is found
        $controller = $this->controller;

        $possibleController = strtolower($url[0]);

        // Get all possible routes (in all languages) for one route and check if it contains the value of url
        foreach (Config::get('router') as $language => $routes) {
            // If the controller contains the typed in url then take the value of the translated_controller
            if (!array_key_exists($possibleController, $routes)) {
                continue;
            }

            $this->route = explode('/', $routes[$possibleController]);

            // Return controller name with uc first character
            $controller = ucfirst($this->route[0]);

            // Remove controller from url
            unset($this->URL[0]);

            // Language by url
            $this->setLanguage($language);

            // Stop when url is found
            break;
        }

        return $controller;
    }

    private function getMethodByURL(array $url) : string
    {
        // The default method
        $method = 'index';

        // Check if the route has a strict method given like "http://example.com/auth/login" --> 'auth/login' = 'controller/method'
        if (!empty($this->route[1])) {
            $method = $this->route[1];
        } elseif (!empty($url[1]) && method_exists(APP_DIRNAME . "\\controllers\\" . $this->controller, $url[1])) {
            $method = $url[1];

            // Remove method from url
            unset($this->URL[1]);
        }

        return $method;
    }

    private function getParamsByURL(array $url) : array
    {
        return $url ? array_values($url) : [];
    }

    private function checkParamCount() : bool
    {
        //Get method details
        try {
            $reflection = new \ReflectionMethod(APP_DIRNAME . "\\controllers\\" . $this->controller, $this->method);
        } catch (\ReflectionException $e) {
            throw new Error('Unable to reflect class method!');
        }

        return count($this->params) > $reflection->getNumberOfParameters() || count($this->params) < $reflection->getNumberOfRequiredParameters();
    }

    private function parseURL(string $url) : array
    {
        return $url = explode('/', rtrim($url, '/'));
    }

    public function setLanguage(string $language)
    {
        $this->lang = $language;
    }

    public function getLanguage()
    {
        return $this->lang;
    }
}
