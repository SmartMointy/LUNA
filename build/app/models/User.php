<?php namespace app\models;

// Sample model

use LUNA\core\DB;

class User extends DB
{
    public string $username;

    public function getAllUsers() : array
    {
        return $this->get('users', '*',[1, '=', 1])->results();
    }
}
