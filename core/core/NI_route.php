<?php 
class NI_route{

    public static $routes = [];
    public static $PostRoutes = [];
    public static $PutRoutes = [];
    public static $DeleteRoutes = [];
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

    public static function put($action, Closure $callback){
        NI_request::$data = NI_request::FromatPostData(file_get_contents("php://input"));
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$PutRoutes))  exit;
        self::$PutRoutes[$routepath] = $callback;
    }

    public static function delete($action, Closure $callback){
        NI_request::$data = NI_request::FromatPostData(file_get_contents("php://input"));
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$DeleteRoutes))  exit;
        self::$DeleteRoutes[$routepath] = $callback;
    }

    public static function any($action, Closure $callback){
        $routepath = '/'.implode('',explode('/',explode("?", $action)[0]));
        if (key_exists($routepath,self::$any))  exit;
        self::$any[$routepath] = $callback;
    }

    public static function run($action){
        $routekey = preg_replace('/\d+/', '', $action );

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (array_key_exists($routekey,  self::$routes)) {
                    preg_match_all('/[\d.]+/si', $action, $num);
                    $asnum = (is_array($num) && array_key_exists(0,$num[0])) ?$num[0][0] :null;
                    $callback =  self::$routes[$routekey];
                    echo call_user_func($callback,$asnum);
                }else if(array_key_exists($routekey,  self::$any)){
                    $callback =  self::$any[$routekey];
                    echo call_user_func($callback);
                }else{
                    require_once ROOT.SEP.'ServerErrorHandeler.php';
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    exit;
                }	
                break;	

            case 'POST':
                if (array_key_exists($routekey,  self::$PostRoutes)) {
                    preg_match_all('/[\d.]+/si', $action, $num);
                    $asnum = (is_array($num) && array_key_exists(0,$num[0])) ?$num[0][0] :null;
                    $callback =  self::$PostRoutes[$routekey];
                    echo call_user_func($callback,$asnum);
                }else if(array_key_exists($routekey,  self::$any)){
                    $callback =  self::$any[$routekey];
                    echo call_user_func($callback);
                }else{
                    require_once ROOT.SEP.'ServerErrorHandeler.php';
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    exit;
                }
                break;	

            case 'PUT':
                if (array_key_exists($routekey,  self::$PutRoutes)) {
                    preg_match_all('/[\d.]+/si', $action, $num);
                    $asnum = (is_array($num) && array_key_exists(0,$num[0])) ?$num[0][0] :null;
                    $callback =  self::$PutRoutes[$routekey];
                    echo call_user_func($callback,$asnum);
                }else if(array_key_exists($routekey,  self::$any)){
                    $callback =  self::$any[$routekey];
                    echo call_user_func($callback);
                }else{
                    require_once ROOT.SEP.'ServerErrorHandeler.php';
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    exit;
                }
                break;

            case 'DELETE':
                if (array_key_exists($routekey,  self::$DeleteRoutes)) {
                    preg_match_all('/[\d.]+/si', $action, $num);
                    $asnum = (is_array($num) && array_key_exists(0,$num[0])) ?$num[0][0] :null;
                    $callback =  self::$DeleteRoutes[$routekey];
                    echo call_user_func($callback,$asnum);
                }else if(array_key_exists($routekey,  self::$any)){
                    $callback =  self::$any[$routekey];
                    echo call_user_func($callback);
                }else{
                    require_once ROOT.SEP.'ServerErrorHandeler.php';
                    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                    exit;
                }
                break;
            
            default:
            if (array_key_exists($routekey,  self::$any)) {
                preg_match_all('/[\d.]+/si', $action, $num);
                $asnum = (is_array($num) && array_key_exists(0,$num[0])) ?$num[0][0] :null;
                $callback =  self::$any[$routekey];
                echo call_user_func($callback,$asnum);
            }else{
                require_once ROOT.SEP.'ServerErrorHandeler.php';
                header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
                exit;
            }	
            break;	
            
        }
    }	
}	
