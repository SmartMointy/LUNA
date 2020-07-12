<?php namespace LUNA\core;

class Controller
{
    protected function model($model)
    {
        require_once ROOT . '/app/models/' . $model . '.model.php';
        return new $model;
    }

    protected function view($view, $data = [])
    {
        require_once ROOT . '/app/views/' . $view . '.view.php';
    }

    protected function helper($helper)
    {
        require_once ROOT . '/app/LUNA/helpers/' . $helper . '.helper.php';
    }
}
