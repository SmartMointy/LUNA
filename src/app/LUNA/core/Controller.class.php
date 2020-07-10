<?php namespace LUNA\core;

class Controller
{
    protected function model($model)
    {
        require ROOT . '/app/models/' . $model . '.model.php';
        return new $model;
    }

    protected function view($view, $data = [])
    {
        require ROOT . '/app/views/' . $view . '.view.php';
    }

    protected function helper($helper){

        include ROOT . '/app/LUNA/helpers/' . $helper . '.helper.php';

    }
}
