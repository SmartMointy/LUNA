<?php namespace LUNA\libs;

class Session
{
    public static function exists($name)
    {
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function put($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($path)
    {
        if (is_string($path)) {
            return (isset($_SESSION[$path])) ? $_SESSION[$path] : '';
        } else {
            $result = $_SESSION;
        
            foreach ($path as $as) {
                $result = $result[$as];
            }
            return $result;
        }
    }

    public static function delete($name)
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
}
