<?php namespace LUNA\core;

class Autoloader {
    /**
     * @type string
     */
    protected $namespacePrefix = '';

    /**
     * @type string
     */
    protected $baseDir = '';

    /**
     * Sets the namespace's prefix.
     * Only classes with this namespace will be autoloaded.
     * 
     * @param string $prefix
     * @return \Autoloader
     */
    public function setNamespacePrefix($prefix) {
        $this->namespacePrefix = $prefix;
        return $this;
    }

    /**
     * Sets the base directory, where we can find our php files.
     * 
     * @param string $dir
     * @return \Autoloader
     */
    public function setBaseDir($dir) {
        $this->baseDir = $dir;
        return $this;
    }

    /**
     * Register autoloader.
     * 
     * @return void
     */
    public function register() {
        spl_autoload_register(function($class) { 
            $request = explode('\\', $class);

            if ($request[0] != $this->namespacePrefix) {
                return;
            }

            $file = ROOT . DIRECTORY_SEPARATOR . $this->baseDir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $request) . '.class.php';

            if (file_exists($file)) {
                require_once($file);
            }
        });
    }
}
