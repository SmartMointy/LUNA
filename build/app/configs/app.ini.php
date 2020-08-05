<?php

//main config file

return array(
    'name' => 'LUNA',
    'version' => '0.4.0',
    'mode' => 'development',
    'default_page' => 'home',
    'redirect_empty_url' => true,
    'theme_color' => '#ffffff',
    'icons' => [
        'default' => 'default_icon_path',
        'safari' => 'safari_icon_path'
    ],
    'language' => 'en',
    'default_language' => 'en',
    'all_languages' => ['de', 'en'],
    'verification_tokens' => [
        'google-site-verification' => 'XXXX-XXXX-XXXX',
        'yandex-verification' => 'XXXX-XXXX-XXXX',
        'msvalidate.01' => 'XXXX-XXXX-XXXX',
        'wot-verification' => 'XXXX-XXXX-XXXX'
    ],
);
