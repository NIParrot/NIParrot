<?php
require_once 'init.php';
NI_Api::$response['status'] = 200;
NI_Api::$response['data'] = null;
NI_Api::run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
