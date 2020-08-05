<?php namespace LUNA\core;

class Lang
{
    const LANG_KEY = 'lang';

    public static function get(string $messagePath = '', array $data = []) : string
    {
        $messagePath = explode('/', $messagePath);

        if (!self::isLangFileLoaded($messagePath[0])) {
            self::loadLangFile($messagePath[0]);
        }

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
        $GLOBALS[self::LANG_KEY][$filename] = require_once ROOT . APP_DIRNAME . DS . 'lang' . DS . Config::get('app/language') . DS . $filename . '.lang.php';
    }

    private static function isLangFileLoaded(string $filename): bool
    {
        // Check if lang file were already saved in the global lang var
        if (empty($GLOBALS[self::LANG_KEY][$filename])) {
            return false;
        }

        return true;
    }
}
