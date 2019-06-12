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
            new Arrayy(array('home', 'contact', 'support', 'about', 'test', 'rest')));
        Config::set("user_route",
            new Arrayy(array(
                'statistics',
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
                'trainingdetails',
                'test'
            )));
        Config::set("moderator_route", new Arrayy(array('adminUsers')));
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
            "mysql:host=" . Config::get('host') . ";dbname=" . Config::get('dbname') . ";charset=" . Config::get('charset'));;

        Config::set("KEY",
            "GwZetTD0wic5Fg8XkrrB-8xb9XQ4eP9T1ExatIFY_DKNh3Z_9uocXxupaxdAGDF3GGv3OarItJSKXG-4m4KYPA_wb7ndJotDQ0dUqCt-uvQyV7jnXIHC-TcZAqmAAkfPnJZY5cpCpmpMWwaUO7EdX5sZVDJlg0FbpdjrJ3NW-o9OXcZaauueKIOQA6h7_MZ10SteBFkO9gJQYuRhmwM_cP21NZFu6ivwC20jnVtou3Eiu-_MscMnZvClVuoCeEIgfyOJOhvaqqrAStagMTdCI3RHvOKDYczah_lrCm8UMY5A54BBQI7abBXl3nFQWW4vnp3GlasOrO_EglthYFnomQ");
        Config::set("ISS", "https://localhost/");
        Config::set("AUD", "https://localhost/");
        Config::set("IAT", 1356999524);
        Config::set("NBF", 1357000000);
        Config::set("ID_LINKEDLN",'77fdnuwkav2mba');
        Config::set("KEY_LINKEDLN",'AhO9z1daHL7uy6W8');

    }
}
