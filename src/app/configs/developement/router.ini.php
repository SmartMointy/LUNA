<?php

// These settings are saved in a global var in app/core/init.php and are used in the config-class
// Will be used to support multiple languages, so that "home", as well as "startseite", wich is home in germany, will call the home-controller

return array(
      'home' => 'startseite, home, anasayfa',
      'auth/login' => 'anmelden, login, giris',
      'auth/register' => 'registrieren, register, kayit',
      'auth/logout' => 'abmelden, loggout',
      'captcha' => 'captcha'
   );
