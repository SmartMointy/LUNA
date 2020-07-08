<?php

class Auth extends Controller
{
    public function login()
    {
        Config::set('page/title', 'Login page');

        $this->view('layout/overall_top');

        echo "<h2>Login</h2>";
        
        $this->view('layout/overall_bottom');
    }
}

?>