<?php

//main config file

return array(
    'name' => 'Application Name',
    'theme_color' => '#ffffff',
    'icons' => [
        'default' => 'default_icon_path',
        'safari' => 'safari_icon_path'
    ],
    'version' => '0.4.0',
    'mode' => 'developement',
    'language' => 'de',
    'all_languages' => ['de', 'en', 'fr', 'tr'],
    'verification_tokens' => [
        'google-site-verification' => 'XXXX-XXXX-XXXX',
        'yandex-verification' => 'XXXX-XXXX-XXXX',
        'msvalidate.01' => 'XXXX-XXXX-XXXX',
        'wot-verification' => 'XXXX-XXXX-XXXX'
    ],
    'session_last_viewed' => 'page',
    'captcha' => 'captcha_text'
    );
