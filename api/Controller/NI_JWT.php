<?php 

class NI_JWT{
    public static function CheckToken($jwt){
        try {
            $decoded = JWT::decode($jwt, APISK, array('HS256'));
            $data =json_decode(json_encode($decoded->data), true);
             $check_user = ORM::for_table('users')
            ->where_any_is(
                    array(
                        array('mail' => $data['mail'], 'password' => $data['password']),
                        array('phone' => $data['mail'], 'password' => $data['password'])
                    )
                )
            ->find_array(); 
            if (!empty($check_user)) {
                return (array(
                    true,
                    $check_user[0]['id']
                ));
            }else{
                return (array(
                    false,
                     "error" => 'error on token'
                 ));
            }
        }catch (Exception $e){             
            return (array(
               false,
                "error" => $e->getMessage()
            ));
        }
    }

    public static function CreateToken(array $data)
    {
        $issuedat_claim = time(); // issued at
        $token = array(
            "iat" => $issuedat_claim,
            "data" => array(
                "mail" => $data['mail'],
                "password" => $data['password']
        ));
        return JWT::encode($token, APISK);
    }
}