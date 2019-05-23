<?php

require_once "../vendor/autoload.php";

use duncan3dc\Sessions\SessionInstance;

class App
{
    public static function run($uri)
    {
        $session = new SessionInstance("my-app");
        $user = $session->get('user');
        self::$router = new  Router($uri);
        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());
        if (empty($user) && !self::accesible()) {
            $home = new HomeController();
            $home->redirect();
        } else {
            if ($controller_class == 'test') {
                $test = new TestController();
                $test->show();
            } else {
                $controller_object = new $controller_class();
                if (method_exists($controller_object, $controller_method)) {
                    $controller_object->$controller_method();
                } else {
                    $home = new HomeController();
                    $home->show();
                }
            }
        }
    }

    private static function accesible()
    {
        $controller = self::$router->getController();
        if ($controller == 'home' || $controller == 'contact' || $controller == 'suport' || $controller == 'about' || $controller=='test') {
            return true;
        }
        return false;
    }

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    protected static $router;



}