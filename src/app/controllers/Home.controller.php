<?php

// Controller that is used when the url doesn't contain anything

class Home extends Controller
{
    //default method
    public function index($name = '')
    {
        $user = $this->model('user');
        $user->username = $name;

        Config::set('page/title', 'My first page');

        $this->view('layout/overall_top');

        $this->view('home/index', [
            'username' => $user->username,
            'headline' =>  Config::get('page/title')
        ]);

        $this->view('layout/overall_bottom');
    }

    public function someMethod()
    {
    }
}
