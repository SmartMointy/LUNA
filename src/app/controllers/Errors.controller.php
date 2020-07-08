<?php

// this controller is called when the url contains a path that doesn't exists

class errors extends Controller
{

    public function index()
    {      
        // Will be removed
        echo "Uknown error occurred!";
    }

    public function pageNotFound()
    {
        $this->view('errors/page_not_found');
    }
}

?>