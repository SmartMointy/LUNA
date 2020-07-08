<?php

function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function dnd($var)
{
    echo '<pre>', var_dump($var), '</pre>';
    die();
}
