<?php

// These settings are saved in a global var in app/core/init.php and are used in the config-class
// Will be used to support multiple languages, so that "home", as well as "startseite", wich is home in germany, will call the home-controller

return array(

    /*
     * German-Deutsch
     */

    'de' => [
        'startseite' => 'home',
    ],

    /*
     * English-Englisch
     */

    'en' => [
        'home' => 'home',
    ],
);
