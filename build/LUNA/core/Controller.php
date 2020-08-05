<?php namespace LUNA\core;

class Controller
{
    public function beforeAction() : void
    {
    }

    public function afterAction() : void
    {
    }

    protected function view(string $view, array $data = []) : void
    {
        require_once ROOT . APP_DIRNAME . DS . 'views' . DS . $view . '.php';
    }

    protected function helper(string $helper) : void
    {
        require_once ROOT . 'LUNA' . DS . 'helpers' . DS . $helper . '.php';
    }
}
