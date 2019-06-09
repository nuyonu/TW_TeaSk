<?php

class Router
{
    public function __construct($uri)
    {
        $this->uri = urldecode(trim($uri, '/'));

        $routes = Config::get('routes');
        $this->route = Config::get('default_route');
        $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
        $this->language = Config::get('default_language');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');


        $uri_parts = explode('?', $this->uri);
        $path = $uri_parts[0];
        $query = "";
        if (isset($uri_parts[1])) {
            $query = $uri_parts[1];
        }

        $path_parts = explode('/', $path);

        if (count($path_parts)) {
//            get route
            if (in_array(strtolower(current($path_parts)), array_keys($routes))) {
                $this->route = strtolower(current($path_parts));
                $this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : '';
                array_shift($path_parts);
            }

//            get controller
            if (current($path_parts)) {
                $this->controller = strtolower(current($path_parts));
                array_shift($path_parts);
            }

//            get action
            if (current($path_parts)) {
                $this->action = strtolower(current($path_parts));
                array_shift($path_parts);
            }

//            get params

            $this->params = $this->processQuery($query);
        }
    }

    private function processQuery($query)
    {
        $result = array();
        if (strcmp($query, "") != 0) {
            $values = explode('&', $query);
            foreach ($values as $param) {
                $pair = explode('=', $param);
                if (isset($pair[1])) {
                    array_push($result, [$pair[0] => $pair[1]]);
                }
            }
            $result=$result[0];
        }
        return $result;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return mixed
     */
    public function getMethodPrefix()
    {
        return $this->method_prefix;
    }

    /**
     * @param mixed $method_prefix
     */
    public function setMethodPrefix($method_prefix)
    {
        $this->method_prefix = $method_prefix;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    protected $uri;
    protected $controller;
    protected $action;
    protected $params;
    protected $route;
    protected $method_prefix;
    protected $language;

}