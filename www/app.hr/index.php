<?php
// čitati
//https://www.giuseppemaccario.com/how-to-build-a-simple-php-mvc-framework/
//https://medium.com/@noufel.gouirhate/create-your-own-mvc-framework-in-php-af7bd1f0ca19
//https://www.google.com/search?q=php+simple+mvc+from+scratch&sxsrf=ALiCzsbTNau9EKOxmI3KahiVTptP__6XcA:1661785857577&source=lnms&tbm=isch&sa=X&ved=2ahUKEwi05O7dquz5AhWJiv0HHXyKBAcQ_AUoAnoECAEQBA&biw=928&bih=554&dpr=1.1#imgrc=3azUg2uoqbXKMM
//phpinfo();

//echo 'hello';

//echo '<pre>';
//print_r($_SERVER);
//echo '</pre>';
//echo $_SERVER['REDIRECT_PATH_INFO'];

session_start();

define('BP', __DIR__ . DIRECTORY_SEPARATOR);
define('BP_APP', BP . 'app' . DIRECTORY_SEPARATOR);
//echo BP, '<br />';
//echo BP_APP, '<br />';

$zaAutoload = [
    BP_APP . 'controller',
    BP_APP . 'model',
    BP_APP . 'core'
];

$putanje = implode(PATH_SEPARATOR,$zaAutoload);

set_include_path($putanje);

//echo $putanje , '<br />';

//https://www.php.net/manual/en/function.spl-autoload-register.php
spl_autoload_register(function($klasa){
   //echo 'U spl_autoload_register funkciji sam, tražim klasu ' . $klasa , '<br />'; 
   $putanje = explode(PATH_SEPARATOR,get_include_path());
    foreach($putanje as $p){
        //echo $p, '<br />';
        $datoteka = $p . DIRECTORY_SEPARATOR . $klasa . '.php';
        //echo $datoteka, '<br />';
        if(file_exists($datoteka)){
            require_once $datoteka;
            break;
        }
    }
});

//Log::log($_SERVER);
App::start();


//require  BP_APP . 'controller/SmjerController.php';
//$c = new SmjerController(); //ovdje se okida poziv funkcija spl_autoload_register
//$c->index();