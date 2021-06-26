<?php
$DeveloperCode = [
    ...call_app_resources(TRAITS),
    ...call_app_resources(CONTROLLER),
    ...call_app_resources(APICONTROLLER),
    ...call_app_resources(MIDDLEWARE),
    ...call_app_resources(ROUTE),
    ...call_app_resources(APIROUTE),
    ...call_app_resources(MODEL),
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
