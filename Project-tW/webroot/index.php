<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW', ROOT . DS . 'views' . DS);
require_once "../vendor/autoload.php";

new ConfigurationSettings();
App::init_database();
App::run($_SERVER['REQUEST_URI']);
