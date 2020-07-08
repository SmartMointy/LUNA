<?php

class Token
{
    public static function generate()
    {
        return Session::put(Config::get('auth/token'), md5(uniqid()));
    }

    public static function check($token)
    {
        if (Session::exists(Config::get('auth/token')) && Session::get(Config::get('auth/token')) === $token) {
            Session::delete(Config::get('auth/token'));

            return true;
        }
        return false;
    }
}
