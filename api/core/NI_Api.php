<?php
class NI_Api
{
    public static $url;
    public static $method;
    public static $data = [];

    public static $response = [];


    public static function run()
    {
        $args = func_get_args();
        $clean_url_from_char = $url = explode("?", $args[0]);
        $url = explode('/', $clean_url_from_char[0]);
        array_shift($url);
        array_shift($url);
        self::$url = '/' . implode('', $url);
        self::$method = $args[1];
        self::$data = self::CatchAndHandelRequestData();
        self::HandelMethod();
        NI_Api::Api_Handeler();
    }

    public static function HandelMethod()
    {
        switch (self::$method) {
            case 'GET':
                if (array_key_exists(self::$url, NI_Api_route::$routes)) {
                    $callback =  NI_Api_route::$routes[self::$url];
                    call_user_func($callback);
                } elseif (array_key_exists(self::$url, NI_Api_route::$any)) {
                    $callback =  NI_Api_route::$any[self::$url];
                    call_user_func($callback);
                } else {
                    NI_Api::$response['status'] = 404;  // not api url
                    NI_Api::$response['data'] = 'Not Found no api run on this url';
                    return NI_Api::$response;
                }
                break;

            case 'POST':
                if (empty(self::$data)) {
                    NI_Api::$response['status'] = 400;  // not api url
                    NI_Api::$response['data'] = 'bad request no data';
                    return NI_Api::$response;
                    exit;
                }
                if (array_key_exists(self::$url, NI_Api_route::$PostRoutes)) {
                    $callback =  NI_Api_route::$PostRoutes[self::$url];
                    call_user_func($callback);
                } elseif (array_key_exists(self::$url, NI_Api_route::$any)) {
                    $callback =  NI_Api_route::$any[self::$url];
                    call_user_func($callback);
                } else {
                    NI_Api::$response['status'] = 404;  // not api url
                    NI_Api::$response['data'] = 'Not Found no api run on this url';
                    return NI_Api::$response;
                }
                break;

            case 'PUT':
                if (empty(self::$data)) {
                    NI_Api::$response['status'] = 400;  // not api url
                    NI_Api::$response['data'] = 'bad request no data';
                    return NI_Api::$response;
                    exit;
                }
                if (array_key_exists(self::$url, NI_Api_route::$PutRoutes)) {
                    $callback =  NI_Api_route::$PutRoutes[self::$url];
                    call_user_func($callback);
                } elseif (array_key_exists(self::$url, NI_Api_route::$any)) {
                    $callback =  NI_Api_route::$any[self::$url];
                    call_user_func($callback);
                } else {
                    NI_Api::$response['status'] = 404;  // not api url
                    NI_Api::$response['data'] = 'Not Found no api run on this url';
                    return NI_Api::$response;
                }
                break;

            case 'DELETE':
                if (empty(self::$data)) {
                    NI_Api::$response['status'] = 400;  // not api url
                    NI_Api::$response['data'] = 'bad request no data';
                    return NI_Api::$response;
                    exit;
                }
                if (array_key_exists(self::$url, NI_Api_route::$DeleteRoutes)) {
                    $callback =  NI_Api_route::$DeleteRoutes[self::$url];
                    call_user_func($callback);
                } elseif (array_key_exists(self::$url, NI_Api_route::$any)) {
                    $callback =  NI_Api_route::$any[self::$url];
                    call_user_func($callback);
                } else {
                    NI_Api::$response['status'] = 404;  // not api url
                    NI_Api::$response['data'] = 'Not Found no api run on this url';
                    return NI_Api::$response;
                }
                break;
            default:

                if (array_key_exists(self::$url, NI_Api_route::$any)) {
                    $callback =  NI_Api_route::$any[self::$url];
                    call_user_func($callback);
                } else {
                    NI_Api::$response['status'] = 404;  // not api url
                    NI_Api::$response['data'] = 'Not Found no api run on this url';
                    return NI_Api::$response;
                }
                break;
        }
    }
    public static function CatchAndHandelRequestData()
    {
        if (!isset($_SERVER["CONTENT_TYPE"])) {
            return null;
        }
        if (strpos($_SERVER["CONTENT_TYPE"], 'x-www-form-urlencoded') !== false) {
            $arr = explode('&', file_get_contents("php://input"));
            $newarr = [];
            foreach ($arr as $temp) {
                $temparr = explode('=', $temp);
                $key = $temparr[0];
                $value = is_numeric($temparr[1]) ? (int) $temparr[1] : str_replace('%40', '@', (string) $temparr[1]);
                $newarr[$key] = $value;
            }
            return $newarr;
        } elseif (strpos($_SERVER["CONTENT_TYPE"], 'form-data') !== false) {
            if (empty($_POST) && empty($_FILES)) {
                return null;
            }
            return [$_POST, $_FILES];
        }
    }

    public static function Api_Handeler()
    {
        $http_response_code = array(
            100 => 'Continue',
            101 => 'Switching Protocols',
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            306 => '(Unused)',
            307 => 'Temporary Redirect',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported'
        );
        header('HTTP/1.1 ' . self::$response['status'] . ' ' . $http_response_code[self::$response['status']]);
        header("Access-Control-Allow-Origin: * ");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: *");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        $json_response = is_object(self::$response['data']) ? self::$response['data'] : json_encode(self::$response['data']);
        echo($json_response);
        exit;
    }
}
