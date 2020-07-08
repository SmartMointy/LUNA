<?php

// Config class is to get default configs with the get method that can be changed with the set or add method.

class Config
{
    const CONFIG_KEY = 'config';

    public static function get(String $path = null)
    {
        if ($path) {
            //Define global config variable, if its undefined
            if (empty($GLOBALS[self::CONFIG_KEY])) {
                $GLOBALS[self::CONFIG_KEY] = array();
            }

            $path = explode('/', $path);

            //Check if settings were already saved in the global config var
            if (empty($GLOBALS[self::CONFIG_KEY][$path[0]])) {
                //if not loaded, than it will load it now
                $filename = $path[0];
                //add the config array returned from the file to the global config array
                
                if ($filename === 'app') {
                    $GLOBALS[self::CONFIG_KEY][$filename] = require_once ROOT . '/app/configs/' . $filename . '.ini.php';
                } else {
                    $GLOBALS[self::CONFIG_KEY][$filename] = require_once ROOT . '/app/configs/' . self::get('app/mode') . '/' . $filename . '.ini.php';
                }
                
                // NEED A TRY CATCH HERE FOR FILE REQUIRE!!!!!!!
            }

            $config = $GLOBALS[self::CONFIG_KEY];
            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                } else {
                    $error = true;
                }
            }

            //only return if configs exist
            if (!isset($error)) {
                return $config;
            }
        }

        return false;
    }

    public static function set($path = null, $value = null)
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
            
            return true;
        }
        
        return false;
    }

    public static function add($path = null, $new_value = null)
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
                return true;
            } else {
                Config::set($path, [Config::get($path)[0], $new_value]);
                return true;
            }
            return false;
        }
        
        return false;
    }
}
