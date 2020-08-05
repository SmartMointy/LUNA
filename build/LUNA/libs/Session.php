<?php namespace LUNA\libs;

class Session
{
    public static function exists(string $name) : bool
    {
        return isset($_SESSION[$name]);
    }

    public static function put(string $name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function get(string $name) : string
    {
        return self::exists($name) ? $_SESSION[$name] : '';
    }

    public static function delete(string $name) : void
    {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }
}
