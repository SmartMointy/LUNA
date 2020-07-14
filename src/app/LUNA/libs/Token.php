<?php namespace LUNA\libs;

use LUNA\core\Config;

class Token
{
    public static function generate() : string
    {
        return Session::put(Config::get('auth/token'), md5(uniqid()));
    }

    public static function check(string $token) : bool
    {
        if (Session::exists(Config::get('auth/token')) && Session::get(Config::get('auth/token')) === $token) {
            Session::delete(Config::get('auth/token'));

            return true;
        }

        return false;
    }
}
