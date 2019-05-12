<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW', ROOT . DS . 'views' . DS);
define('OK',200);
define('BAD_REQUEST',403);
require_once "../vendor/autoload.php";


new ConfigurationSettings();
App::run($_SERVER['REQUEST_URI']);
