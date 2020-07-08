<?php

// These settings are saved in a global var in app/core/init.php and are used in the config-class

return array(
    'title' => 'The default title in production',
    'description' => 'The default description in production',
    'keywords' => 'The default keywords in production',
    'css' => array(
            'main'
        ),
    'js' => array(
            'main',
            'sw'
        ),
    'author' => 'The default author',
    'custom_head_elements' => [
        ['meta', 'name', 'referrer', 'content', 'no-referrer'],
        ['link', 'rel', 'license', 'href', 'copyright.html']
    ],
    'navbar' => true,
    'footer' => true
   );
