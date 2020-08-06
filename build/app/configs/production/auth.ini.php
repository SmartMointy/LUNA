<?php

//authentication

return array(
    'session' => 'user_id',
    'csrf' => 'FRSCT',
    'remember' => 'RUSE',
    'device' => 'DID',
    'max_login_attempts' => 5,
    'max_login_attempts_DID' => 5,
    'captcha_attempts' => 4,
    'block_user' => 'PT15M'
);
