<?php namespace LUNA\libs;

class Redirect
{
    public static function to(string $location = null) : void
    {
        if ($location) {
            if (is_numeric($location)) {
                header('HTTP/1.0 ' . $location);
            } else {
                header('Location: ' . $location);
            }
            
            exit();
        }
    }
}
