<?php namespace LUNA\core;

class Language
{
    public static function Message(string $message = '', array $data = []) : string
    {
        // TODO: Load messages only once instead of everytime the function is called
        // TODO: New usage Language::Message('menu/home') => src/app/lang/en/menu.lang.php

        $messages = require_once ROOT . 'app' . DS . 'lang' . DS . Config::get('locales/language') . '.locale.php';

        return vsprintf($messages[$message], $data);
    }
}
