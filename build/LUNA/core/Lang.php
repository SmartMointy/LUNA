<?php namespace LUNA\core;

use Error;

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
        $path = ROOT . APP_DIRNAME . DS . 'lang' . DS . Config::get('app/language') . DS . $filename . '.lang.php';

        if (file_exists($path)) {
            $GLOBALS[self::LANG_KEY][$filename] = require_once $path;
        } else {
            trigger_error( 'Tried to load lang file that doesn\'t exist!', E_USER_NOTICE);
            $GLOBALS[self::LANG_KEY][$filename] = [];
        }
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
