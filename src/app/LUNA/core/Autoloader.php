<?php namespace LUNA\core;

class Autoloader {

    protected string $namespacePrefix = '';

    protected string $baseDir = '';

    public function setNamespacePrefix(string $prefix) : Autoloader
    {
        $this->namespacePrefix = $prefix;
        return $this;
    }

    public function setBaseDir(string $dir) : Autoloader
    {
        $this->baseDir = $dir;
        return $this;
    }

    public function register() : void
    {
        spl_autoload_register(function($class) { 
            $request = explode('\\', $class);

            if ($request[0] != $this->namespacePrefix && $request[0] != 'models') {
                return;
            }

            $file = ROOT . DS . $this->baseDir . DS . implode(DS, $request) . '.php';

            if (file_exists($file)) {
                require_once($file);
            }
        });
    }
}
