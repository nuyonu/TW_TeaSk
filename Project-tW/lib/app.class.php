<?php

require_once "../vendor/autoload.php";

use Arrayy\Arrayy as A;
use duncan3dc\Sessions\SessionInstance;
use Arrayy\StaticArrayy as SA;

class App
{
    /**
     * @return mixed
     */
    public static function getRouter(): Router
    {
        return self::$router;
    }

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
        $session = new SessionInstance(Constants::NAME_APP);
        $user = $session->get(Constants::USER);
        $grade = $session->get(Constants::GRADE);
        self::$router = new  Router($uri);

        if (!self::isUnknown($user) && !self::isAdmin($user, $grade) && !self::isModerator($user, $grade)) {
            self::isNormal();
        }


    }

    private static function isAdmin(
        string $user,
        $grade
    ): bool {
        if (strcmp(Config::get('user_admin'), $user) == 0 && strcmp($grade['grade'], "1") == 0) {
            if (!self::existActionController()) {
                self::REDIRECT_HOME();
            }
            return TRUE;
        }
        return FALSE;
    }


    private static function isModerator(
        $user
    ) {
        if (FALSE) {
            self::existActionController();
            return TRUE;
        }
        return FALSE;
    }

    private static function isNormal(): bool {
        if (self::accessibleNormalUser()) {
            self::existActionController();
            return TRUE;
        }
        Response::redirect(Constants::HOME);
        return FALSE;
    }


    private static function isUnknown($user): bool {
        if (self::accessibleUnkownUser() && $user == NULL) {
            self::existActionController();
            return TRUE;
        }
        return FALSE;
    }


    private static function existActionController(): bool
    {
        $controller_class = ucfirst(self::$router->getController()) . 'Controller';
        $controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());
        $controller_object = new $controller_class();
        if (method_exists($controller_object, $controller_method)) {
            $controller_object->$controller_method();
            return TRUE;
        }
        $controller_object->show();
        return FALSE;
    }


    private final static function REDIRECT_HOME()
    {
        $home = new HomeController();
        $home->show();
    }

    private static function accessibleUnkownUser()
    {
        $controller = self::$router->getController();
        $controller = strtolower($controller);
        return Config::get("unknown_route")->find(
                function ($value) use ($controller) {
                    return $controller == $value;
                }) != FALSE;
    }

    private static function accessibleNormalUser()
    {
        $controller = self::$router->getController();
        return Config::get("user_route")->find(
                function ($value) use ($controller) {
                    return $controller == $value;
                }) != FALSE;
    }


    protected static $router;
    private static $db;

}