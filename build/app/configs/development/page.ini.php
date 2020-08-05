<?php

// These settings are only used if in developement mode

return array(
    'title' => 'The default title in developement',
    'description' => 'The default description in developement',
    'keywords' => 'The default keywords in developement',
    'css' => array(
            'main'
        ),
    'js' => array(
            'main',
            'sw'
        ),
    'author' => 'The default author in developement',
    'custom_head_elements' => [
        ['meta', 'name', 'referrer', 'content', 'no-referrer'],
        ['link', 'rel', 'license', 'href', 'copyright.html']
    ],
    'navbar' => true,
    'footer' => true
   );
