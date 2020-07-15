<?php

use LUNA\core\Router;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../autoload.php';

class RouterTest extends TestCase
{
    public function invokeMethod(object &$object, string $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);

        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testRouterControllerSelection()
    {
        $url = 'home';

        $Router = new Router($url);

        $selectedController = $this->invokeMethod($Router, 'getControllerByURL', [$this->invokeMethod($Router, 'parseURL', [$url])]);

        $this->assertEquals(ucfirst($url), $selectedController);

        $url = 'hoMe';

        $Router = new Router($url);

        $selectedController = $this->invokeMethod($Router, 'getControllerByURL', [$this->invokeMethod($Router, 'parseURL', [$url])]);

        $this->assertEquals(ucfirst(strtolower($url)), $selectedController);



    }

}