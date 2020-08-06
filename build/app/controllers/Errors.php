<?php namespace app\controllers;

use LUNA\core\Controller;

// this controller is called when the url contains a path that doesn't exists

class Errors extends Controller
{

    public function index() : void
    {      
        // Will be removed
        echo "Unknown error occurred!";
    }

    public function page_not_found() : void
    {
        $this->view('layout/overall_top');
        $this->view('errors/page_not_found');
        $this->view('layout/overall_bottom');
    }

    public function access_forbidden() : void
    {
        $this->view('layout/overall_top');
        $this->view('errors/page_access_forbidden');
        $this->view('layout/overall_bottom');
    }
}
