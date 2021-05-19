<?php

namespace Api;

use Api\NI_JWT;
use NI_Api;

class NI_Helper
{

    public static function MangerToken($id)
    {
        /*         if (!NI_JWT::ManagerAuth() || $id != NI_JWT::ManagerAuth()[1]) {
            NI_Api::$response['status'] = 401;
            NI_Api::$response['data'] = [
                'msg' => 'Admin Token not valed'
            ];
            http_response_code(401);
            echo exit('Admin Token not valed');
        } */
    }
}
