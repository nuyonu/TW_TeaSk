<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
define('VIEW', ROOT . DS . 'views' . DS);
require_once "../vendor/autoload.php";

echo "ok";
new ConfigurationSettings();
App::run($_SERVER['REQUEST_URI']);
