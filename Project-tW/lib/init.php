<?php

//
//spl_autoload_register("autoload");
//require_once(ROOT . DS . 'config' . DS . 'config.php');
//
//
//function autoload($class_name)
//{
//
//    $lib_path = ROOT . DS . 'lib' . DS . strtolower($class_name) . '.class.php';
//    $controllers_path = ROOT . DS . 'controllers' . DS . str_replace('controller', '', strtolower($class_name)) . '.controller.php';
//    $model_path = ROOT . DS . 'models' . DS . strtolower($class_name) . '.model.php';
//    $dao_path = ROOT . DS . 'models' . DS . 'DAO' . strtolower($class_name) . '.DAO.php';
//
//    $file = 'C:\github\TW_TeaSk2\Project-tW\vendor\league\container\src\\' . $class_name . '.php';
//    if (file_exists($file)) {
//        require_once $file;
//    } elseif (file_exists($lib_path)) {
//        require_once($lib_path);
//    } elseif (file_exists($controllers_path)) {
//        require_once($controllers_path);
//    } elseif (file_exists($model_path)) {
//        require_once($model_path);
//    } elseif (file_exists($dao_path)) {
//        require_once($model_path);
//    } else {
//        throw new Exception('Failed to include class:' . $class_name);
//    }
//
//}
//
//;
//
