<?php

namespace Api;

class NI_JWT
{
    public static function CheckMangerToken($jwt)
    {
        try {
            $decoded = \JWT::decode($jwt, APISK, array('HS256'));
            $data = json_decode(json_encode($decoded->data), true);
            $user = \model\Managers::check($data);
            if (empty($user)) {
                return (array(
                    false,
                    "error" => 'error on token',
                    "data" => $data
                ));
            } else {
                return (array(
                    true,
                    $user->id,
                    'manager'
                ));
            }
        } catch (\Exception $e) {
            return (array(
                false,
                "error" => $e->getMessage()
            ));
        }
    }

    public static function CheckTeacherToken($jwt)
    {
        try {
            $decoded = \JWT::decode($jwt, APISK, array('HS256'));
            $data = json_decode(json_encode($decoded->data), true);
            $user = \model\Teachers::check($data);
            if (empty($user)) {
                return (array(
                    false,
                    "error" => 'error on token',
                    "data" => $data
                ));
            } else {
                return (array(
                    true,
                    $user->id,
                    'teacher'
                ));
            }
        } catch (\Exception $e) {
            return (array(
                false,
                "error" => $e->getMessage()
            ));
        }
    }

    public static function CheckFatherToken($jwt)
    {
        try {
            $decoded = \JWT::decode($jwt, APISK, array('HS256'));
            $data = json_decode(json_encode($decoded->data), true);
            $user = \model\Fathers::check($data);
            if (empty($user)) {
                return (array(
                    false,
                    "error" => 'error on token',
                    "data" => $data
                ));
            } else {
                return (array(
                    true,
                    $user->id,
                    'father'
                ));
            }
        } catch (\Exception $e) {
            return (array(
                false,
                "error" => $e->getMessage()
            ));
        }
    }

    public static function CreateToken(object $data)
    {
        $issuedat_claim = time(); // issued at
        $token = array(
            "iat" => $issuedat_claim,
            "data" => array(
                "username" => $data->username,
                "password" => $data->password
            )
        );
        return \JWT::encode($token, APISK);
    }

    public static function getJWT()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }

    public static function FatherAuth()
    {

        $Token = self::getJWT();
        if ($Token != null) {
            $check = self::CheckFatherToken($Token);
            if ($check[0] == true && $check[2] == 'father') {
                return $check;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function ManagerAuth()
    {
        $Token = self::getJWT();
        if ($Token != null) {
            $check = self::CheckMangerToken($Token);
            if ($check[0] == true && $check[2] == 'manager') {
                return $check;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function TeacherAuth()
    {
        $Token = self::getJWT();

        if ($Token != null) {
            $check = self::CheckTeacherToken($Token);
            if ($check[0] == true && $check[2] == 'teacher') {
                return $check;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
