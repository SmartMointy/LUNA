<?php

class Language
{
    public static function Message($message = '', $data = [])
    {
        $messages = require ROOT . '/app/locales/' . Config::get('locales/language') . '.locale.php';
        //return $messages;
        return vsprintf($messages[$message], $data);
    }
}
