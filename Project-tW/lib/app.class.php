<?php

class App
{
    protected static $router;
    private static $db;

    public static function init_database()
    {
        $host = '127.0.0.1';
        $dbname   = 'mydb';
        $user = 'root';
        $password = '';
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            self::$db = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getDatabase()
    {
        return self::$db;
    }

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