<?php

/**
 * Tish class calls Controllers and inject request data from NI_request
 */

class NI_Controller
{
    /**
     * Run Controller depend on passed param
     *
     * @param  [string] $Controller
     * @param  [array] $middleware
     * @return void
     */
    public static function run(string $Controller, array $middleware = null)
    {
        // Convert Param to method and class
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
        // check if class and method are exist
        if (!empty($Controller) && method_exists($class, $method)) {
            // inject request data as Param to method
            $Data_for_send = NI_request::$data ?? null;
            $class::$method($Data_for_send);

            //stop any other call
            exit;
        } else {
            echo 'method dose not exist';
        }
    }
}
