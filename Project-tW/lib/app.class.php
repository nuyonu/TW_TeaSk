<?php

require_once "../vendor/autoload.php";

use duncan3dc\Sessions\SessionInstance;

class App
{
    public static function init_database()
    {
        $host = '127.0.0.1';
        $dbname = 'mydb';
        $user = 'root';
        $password = '';
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        ];
        try {
            self::$db = new PDO($dsn, $user, $password, $options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getDatabase(): PDO
    {
        return self::$db;
    }


    public static function run($uri)
    {
        $session = new SessionInstance("my-app");
        $user = $session->get('user');
        self::$router = new  Router($uri);
        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());
        if (strlen($user) == 0 && !self::accessible()) {
            $home = new HomeController();
            $home->show();
        } else {
            if ($controller_class == 'test') {
                $test = new TestingController();
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

    private static function accessible()
    {
        $controller = self::$router->getController();
        if ($controller == 'home' || $controller == 'contact' || $controller == 'support' || $controller == 'about' || $controller == 'test') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @return mixed
     */
    public static function getRouter(): Router
    {
        return self::$router;
    }

    protected static $router;
    private static $db;


}