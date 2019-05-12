<?php

class App
{
    protected static $router;

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    public static function run($uri)
    {


        self::$router = new  Router($uri);


        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());
        if ($controller_class == 'test') {
            $test = new TestController();
            $test->show();
        }

        $controller_object = new $controller_class();

        if (method_exists($controller_object, $controller_method)) {
            $result = $controller_object->$controller_method();
        } else {
            $home = new HomeController();
            $home->show();
        }
    }

}