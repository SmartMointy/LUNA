<?php

//main config file

return array(
    'name' => 'LUNA',
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
    'redirect_empty_url' => [
        'mode' => true,
        'to' => 'MENU_HOME'
    ]
    );
