<?php 

use LUNA\core\Controller;
use LUNA\core\Config;
use LUNA\core\Language;

// Controller that is used when the url doesn't contain anything

class Home extends Controller
{
    //default method
    public function index($name = '')
    {
        Config::set('page/title', Language::Message('MENU_HOME'));

        $this->view('layout/overall_top');
        
        $this->view('home/index', [
            'headline' =>  Config::get('app/name')
        ]);

        $this->view('layout/overall_bottom');
    }

    public function someMethod()
    {
    }
}
