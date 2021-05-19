<?php

/**
 * @author  Ahmed Hisham -> ahmedhesham2012@yahoo.com
 * @version 4.4.1
 * init.php call everything on app
 * All requests redirect to index using .htaccess
 */
require_once 'config.php';
require_once 'functions.php';
require_once 'corebootstrap.php';
require_once 'init.php';
require_once 'devbootstrap.php';
if (startsWith(parse_url($_SERVER['REQUEST_URI'])['path'], '/api')) {
    require_once ROOT . SEP . 'api' . SEP . 'index.php';
}
NI_route::run(parse_url($_SERVER['REQUEST_URI'])['path']);
