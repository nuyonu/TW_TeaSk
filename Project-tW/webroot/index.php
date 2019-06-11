<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW', ROOT . DS . 'views' . DS);
define('OK', 200);
define('BAD_REQUEST', 403);
define('TEMPLATES', ROOT . DS . 'webroot' . DS . 'templates' . DS);
define('UPLOADS',ROOT.DS.'webroot'.DS.'UPLOADS'.DS);
require_once "../vendor/autoload.php";


ConfigurationSettings::init();
App::init_database();
App::run($_SERVER['REQUEST_URI']);

