<?php
class NI_Api_route
{
    public static $routes = [];
    public static $PostRoutes = [];
    public static $PutRoutes = [];
    public static $DeleteRoutes = [];
    public static $any = [];

    public static function get($action, Closure $callback)
    {
        $routepath = '/'.implode('', explode('/', explode("?", $action)[0]));
        if (!key_exists($routepath, self::$routes)) {
            self::$routes[$routepath] = $callback;
        }
    }

    public static function put($action, Closure $callback)
    {
        $routepath = '/'.implode('', explode('/', explode("?", $action)[0]));
        if (!key_exists($routepath, self::$PutRoutes)) {
            self::$PutRoutes[$routepath] = $callback;
        }
    }

    public static function delete($action, Closure $callback)
    {
        $routepath = '/'.implode('', explode('/', explode("?", $action)[0]));
        if (!key_exists($routepath, self::$DeleteRoutes)) {
            self::$DeleteRoutes[$routepath] = $callback;
        }
    }

    public static function post($action, Closure $callback)
    {
        $routepath = '/'.implode('', explode('/', explode("?", $action)[0]));
        if (!key_exists($routepath, self::$PostRoutes)) {
            self::$PostRoutes[$routepath] = $callback;
        }
    }

    public static function any($action, Closure $callback)
    {
        $routepath = '/'.implode('', explode('/', explode("?", $action)[0]));
        if (!key_exists($routepath, self::$any)) {
            self::$any[$routepath] = $callback;
        }
    }
}
