<?php namespace LUNA\core;

class Router
{
    protected $controller = 'Errors';

    protected $method = 'pageNotFound';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (empty($url)) {
            // redirect to default page if url empty
            header('Location: ' . Language::Message('MENU_HOME'));
        }

        // get all posible routes (in all languages) for one route and check if it contains the value of url
        foreach (Config::get('router') as $route => $value) {
            //if the controller contains the typed in url then take the value of the translated_controller
            if (stripos($value, $url[0]) !== false) {
                unset($url[0]);

                $con_met = explode('/', $route);
                $this->controller = ucfirst($con_met[0]);

                // Check if the url accessed has a default method (e.g. 'http://localhost/login' => 'auth/login', controller/method)
                if (isset($con_met[1])) {
                    $this->method = $con_met[1];

                // check if second parameter in url is a method
                } elseif (isset($url[1]) && method_exists($this->controller, $url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                } else {
                    $this->method = 'index';
                }

                break; // stops the loop if the url is found
            }
        }

        $path = ROOT . '/app/controllers/' . $this->controller . '.controller.php';

        if (file_exists($path)) {
            require_once $path;
        }

        $this->params = $url ? array_values($url) : [];

        //Get method details
        $reflection = new \ReflectionMethod($this->controller, $this->method);

        //Check if too much or too less arguments are passed, if so load errors controller and show 404
        if ($this->controller === 'Errors' || count($this->params) > $reflection->getNumberOfParameters() || count($this->params) < $reflection->getNumberOfRequiredParameters()) {
            $this->controller = 'Errors';
            $this->method = 'pageNotFound';
            $this->params = [];

            if (!class_exists($this->controller)) {
                require_once ROOT . '/app/controllers/' . $this->controller . '.controller.php';
            }
        }

        //call method in controller
        call_user_func_array([new $this->controller, $this->method], $this->params);
    }
    
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', rtrim($_GET['url'], '/'));
        }
    }
}
