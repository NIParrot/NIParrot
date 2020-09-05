<?php

class NI_Controller
{
    public static function run($Controller)
    {
        $class_method = explode('@', $Controller);

        $class = $class_method[0];
        $method = $class_method[1];

        if (!empty($Controller) && method_exists($class, $method)) {
            $Data_for_send = NI_request::$data ?? null;
            $class::$method($Data_for_send);
            exit;
        } else {
            echo 'method dose not exist';
        }
    }
}
