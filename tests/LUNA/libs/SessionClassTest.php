<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../autoload.php';

use LUNA\libs\Session;

class SessionClassTest extends TestCase
{
    public function testSessionInsertion()
    {
        $key = 'user_id';
        $firstValue = 50;
        $secondValue = 50;

        Session::put($key, $firstValue);

        $this->assertEquals($firstValue, Session::get($key));

        Session::put($key, $secondValue);
        
        $this->assertEquals($secondValue, Session::get($key));
    }

    public function testSessionDeletion()
    {
        $key = 'user_id';
        $value = 50;

        Session::put($key, $value);

        Session::delete($key);

        $this->assertEquals(null, Session::get($key));
    }
}
?>