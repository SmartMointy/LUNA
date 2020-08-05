<?php namespace LUNA\core;

// Config class is to get default configs with the get method that can be changed with the set or add method.

class Config
{
    const CONFIG_KEY = 'config';

    public static function get(string $path = '')
    {
        if (empty($path)) {
            return '';
        }

        // Define global config and load main config if not done
        self::checkMainConfigFile();

        $path = explode('/', $path);

        //Check if settings were already saved in the global config var
        if (empty($GLOBALS[self::CONFIG_KEY][$path[0]])) {
            self::loadConfig($path[0]);
        }

        $config = $GLOBALS[self::CONFIG_KEY];
        foreach ($path as $bit) {
            if (isset($config[$bit])) {
                $config = $config[$bit];
            } else {
                $config = '';
            }
        }

        // Return if config exist else empty
        return $config;
    }

    public static function set($path = null, $value = null) : void
    {
        // check if $path and $value is not empty (check if $value is a bool to make the if condition true, when $value is false)
        if ($path and ($value or is_bool($value))) {
            $keys = explode('/', $path);
            
            //Check if settings are loaded, if not than load them
            if (empty($GLOBALS[self::CONFIG_KEY][$keys[0]])) {
                Config::get($keys[0]);
            }

            $reference = &$GLOBALS[self::CONFIG_KEY];
            foreach ($keys as $key) {
                if (!array_key_exists($key, $reference)) {
                    $reference[$key] = [];
                }
                $reference = &$reference[$key];
            }
            $reference = $value;
            unset($reference);
        }
    }

    public static function add($path = null, $new_value = null) : void
    {
        // check if $path and $value is not empty (check if $value is a bool to make the if condition true, when $value is false)
        if ($path and ($new_value or is_bool($new_value))) {
            $keys = explode('/', $path);
            
            //Check if settings are loaded, if not than load them
            if (empty($GLOBALS['config'][$keys[0]])) {
                Config::get($keys[0]);
            }

            if (count(Config::get($path)) > 1) {
                $all_values = implode(", ", Config::get($path));
                Config::set($path, [$all_values, $new_value]);
            } else {
                Config::set($path, [Config::get($path)[0], $new_value]);
            }
        }
    }

    private static function checkMainConfigFile() : void
    {
        if (empty($GLOBALS[self::CONFIG_KEY])) {
            $GLOBALS[self::CONFIG_KEY] = [];

            // Load main config file
            $GLOBALS[self::CONFIG_KEY]['app'] = require_once ROOT . APP_DIRNAME . DS . 'configs' . DS . 'app.ini.php';
        }
    }

    private static function loadConfig(string $filename) : void
    {
        $GLOBALS[self::CONFIG_KEY][$filename] = require_once ROOT . APP_DIRNAME . DS . 'configs' . DS . self::get('app/mode') . DS . $filename . '.ini.php';
    }
}
