<?php


//https://github.com/Seldaek/monolog


use Arrayy\Arrayy;

class ConfigurationSettings
{
    public static function init()
    {

        Config::set("option_db", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => FALSE,
        ]);

        Config::set("unknown_route",
            new Arrayy(array('home', 'contact', 'support', 'about', 'test')));
        Config::set("user_route",
            new Arrayy(array(
                'home',
                'trainings',
                'contact',
                'support',
                'about',
                'events',
                'settings',
                'trainingsfilter',
                'github',
                'linkedln',
                'trainingdetails'
            )));
        Config::set("moderator_route",  new Arrayy(array('adminUsers')));
        Config::set("admin_pass", 'Aa1!asdf');
        Config::set('user_admin', '_admin');
        Config::set('site_name', 'site');
        Config::set('languages', 'ro');
        Config::set('routes', array('default' => '', 'admin' => 'admin'));
        Config::set('default_route', 'default');
        Config::set('default_languages', 'ro');
        Config::set('default_controller', 'Home');
        Config::set('default_action', 'show');
        Config::set('host', '127.0.0.1');
        Config::set('dbname', 'mydb');
        Config::set('user', 'root');
        Config::set('pass', '');
        Config::set('charset', 'utf8mb4');
        Config::set('dsn',
            "mysql:host=" . Config::get('host') . ";dbname=" . Config::get('dbname') . ";charset=" . Config::get('charset'));


    }
}