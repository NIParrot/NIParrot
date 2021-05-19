<?php

$CoreLoader = [
    ROOT . SEP . 'core' . SEP . 'autoload.php',
    ROOT . SEP . 'core' . SEP . 'Mustache' . SEP . 'Autoloader.php',
];

$coreClassLoader = [
    ROOT . SEP . 'core' . SEP . 'core' . SEP,
    ROOT . SEP . 'core' . SEP . 'SingelLibs' . SEP,
    ROOT . SEP . 'engien' . SEP . 'template' . SEP
];

require_once 'vendor' . SEP . 'autoload.php';

array_map(
    static function ($path) {
        array_map(
            static function ($filename) {
                include_once $filename;
            },
            glob("{$path}/*.php")
        );
    },
    $coreClassLoader
);

array_map(
    static function ($file) {
        if (file_exists($file)) {
            include_once $file;
        }
    },
    $CoreLoader
);
