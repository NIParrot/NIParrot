<?php

class NI_Api_Controller
{
    public static function run($Controller, array $middleware = null)
    {
        $class_method = explode('@', $Controller);

        $class = $class_method[0];
        $method = $class_method[1];

        if ($middleware != null) {

            foreach ($middleware as $middlewareClass => $middlewareMethod) {
                $middlewareClass = 'Middleware\\' . $middlewareClass;


                if (method_exists($middlewareClass, $middlewareMethod)) {
                    $middlewareClass::$middlewareMethod();
                }
            }
        }

        if (!empty($Controller) && method_exists($class, $method)) {
            $Data_for_send = NI_Api::$data ?? null;
            $class::$method($Data_for_send);
        } else {
            NI_Api::$response['status'] = 404;
            NI_Api::$response['data'] = [
                'msg' => 'method dose not exist'
            ];
            return;
        }
    }
}
