<?php namespace LUNA\core;

class Lang
{
    const LANG_KEY = 'config';

    public static function get(string $messagePath = '', array $data = []) : string
    {
        $messagePath = explode('/', $messagePath);

        self::isLangFileLoaded($messagePath[0]);

        $message = $GLOBALS[self::LANG_KEY];
        foreach ($messagePath as $bit) {
            if (isset($message[$bit])) {
                $message = $message[$bit];
            } else {
                $message = '';
            }
        }

        // Return message, empty if not found
        return vsprintf($message, $data);
    }

    private static function loadLangFile(string $filename): void
    {
        $GLOBALS[self::LANG_KEY][$filename] = require_once ROOT . 'app' . DS . 'lang' . DS . Config::get('app/language') . DS . $filename . '.lang.php';
    }

    private static function isLangFileLoaded(string $filename): void
    {
        // Check if lang file were already saved in the global config var
        if (empty($GLOBALS[self::LANG_KEY][$filename])) {
            self::loadLangFile($filename);
        }
    }
}
