<?php

// Validation settings for registration

return array(
    'username' => array(
        'required' => true,
        'min' => 3,
        'max' => 20,
        'unique' => 'users',
        'allowed_chars' => 'a-zA-Z0-9'
    ),
    'profilename' => array(
        'required' => true,
        'min' => 3,
        'max' => 20,
        'allowed_chars' => 'a-zA-Z0-9'
    ),
    'email' => array(
        'required' => true,
        'min' => 5,
        'max' => 40,
        'allowed_chars' => 'a-zA-Z0-9@.'
    ),
    'password' => array(
        'required' => true,
        'min' => 6,
        'max' => 20
    ),
    'password_again' => array(
        'required' => true,
        'matches' => 'password'
    )
   );
