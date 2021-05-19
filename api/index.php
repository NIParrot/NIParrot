<?php
require_once '../config.php';
require_once '../functions.php';
require_once '../corebootstrap.php';
require_once '../init.php';
require_once '../devbootstrap.php';
NI_Api::$response['status'] = 200;
NI_Api::$response['data'] = null;
NI_Api::run(substr(parse_url($_SERVER['REQUEST_URI'])['path'], 4));
