<?php 
/**
 * @author Ahmed Hisham -> ahmedhesham2012@yahoo.com
 * @version 1.0
 * init.php call everything on app 
 * All requests redirect to index using .htaccess
 */
require_once 'config.php';
require_once 'init.php';
NI_route::run('/'.implode('',explode('/',explode("?", $_SERVER['REQUEST_URI'])[0])));