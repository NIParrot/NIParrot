<?php 
class NI_Api_route{

    public static $routes = [];
    public static $PostRoutes = [];
    public static $any = [];

    public static function get($action, Closure $callback){
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$routes))  exit;
        self::$routes[$routepath] = $callback;
    }

    public static function post($action, Closure $callback){
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$PostRoutes))  exit;
        self::$PostRoutes[$routepath] = $callback;
    }

    public static function any($action, Closure $callback){
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$any))  exit;
        self::$any[$routepath] = $callback;
    }

}	
