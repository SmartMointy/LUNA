<?php

use LUNA\core\Controller;
use LUNA\core\Config;
use LUNA\core\Lang;
use models\User;

// Controller that is used when the url doesn't contain anything

class Home extends Controller
{
    //default method
    public function index(string $name = '') : void
    {
        Config::set('page/title', Lang::get('home/MENU_HOME'));

        $this->view('layout/overall_top');

        // TODO: echo Message::de('WELCOME', ['param1', 'param2']);;
        
        $this->view('home/index', [
            'headline' =>  Config::get('app/name')
        ]);

        $this->view('layout/overall_bottom');
    }

    public function someMethod() : void
    {
    }
}
