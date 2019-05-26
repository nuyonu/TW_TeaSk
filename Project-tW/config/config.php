<?php


//https://github.com/Seldaek/monolog


class ConfigurationSettings
{
    public function __construct()
    {
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
        Config::set('passwors', '');
        Config::set('$charset', 'utf8mb4');
        Config::set('dsn',
            "mysql:host=" . Config::get('host') . ";dbname=" . Config::get('dbname') . ";charset=" . Config::get('charset'));


    }
}