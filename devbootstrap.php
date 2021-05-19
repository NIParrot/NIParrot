<?php
$DeveloperCode = [
    ...call_app_resources(ROOT . SEP . 'app' . SEP . 'Controller'),
    ...call_app_resources(ROOT . SEP . 'api' . SEP . 'Controller'),
    ...call_app_resources(ROOT . SEP . 'app' . SEP . 'Middleware'),
    ...call_app_resources(ROOT . SEP . 'routes'),
    ...call_app_resources(ROOT . SEP . 'api' . SEP . 'routes'),
    ...call_app_resources(ROOT . SEP . 'app' . SEP . 'Model'),
    ...call_app_resources(ROOT . SEP . 'app' . SEP . 'Paris'),
    ...call_app_resources(ROOT . SEP . 'includes')
];

array_map(
    static function ($file) {
        if (file_exists($file)) {
            include_once $file;
        }
    },
    $DeveloperCode
);
