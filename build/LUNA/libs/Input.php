<?php namespace LUNA\libs;

class Input
{
    public static function exists($type = 'post') 
    {
        switch($type)
        {
            case 'post':
                return !empty($_POST);
            break;
            case 'get':
                return !empty($_GET);
            break;
            default:
                return false;
            break;
        }

    }

    public static function get($item)
    {
        // chech if input exists
        if(isset($_POST[$item]))
        {
            // return input
            return self::escape($_POST[$item]);
        } else if(isset($_GET[$item])) {
            // same for GET method
            return self::escape($_GET[$item]);
        }

        // else return empty string
        return '';
    }

    public static function escape($string)
    {
        return htmlentities($string, ENT_QUOTES, 'UTF-8');
    }
}
