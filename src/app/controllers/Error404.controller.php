<?php
// this controller is called when the url contains a path that doesn't exists
class Error404 extends Controller
{

    public function index()
    {

        echo 'This page doesnt exists!';
    }

}

?>