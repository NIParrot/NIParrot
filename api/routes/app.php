<?php

use NI_Api;

NI_Api_route::get('/maintenance', function () {
    NI_Api::$response['status'] = 200;
    NI_Api::$response['data'] = [
        'msg' => 'Running',
    ];
    return;
});

NI_Api_route::get('/version', function () {
    NI_Api::$response['status'] = 200;
    NI_Api::$response['data'] = [
        'v' => '0.1',
    ];
    return;
});

NI_Api_route::get('/appname', function () {
    NI_Api::$response['status'] = 200;
    NI_Api::$response['data'] = [
        'name' => Appname,
        'description' => 'plaplapla'
    ];
    return;
});
