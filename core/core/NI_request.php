<?php

class NI_request{

    public static function all(){
        foreach ($_POST as $key => $value) {
            if (is_array($_POST[$key])) {
                $var =implode(',', $_POST[$key]);
                $_POST[$key] = NI_security::anti_XSS($var);
            }else{
                $_POST[$key] = NI_security::anti_XSS($value);
            }
           
        }
        return $_POST;
    }
    
    public static function validate($data = array()){
        $TempErrorCheck = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = NI_security::PoolFilterus($value, self::all()[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }else{
                    $data[$key] = NI_security::Filterus($value, self::all()[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }
            }
        }
        if (empty($TempErrorCheck)) {
            return $data;
        }else {

            if (DEV == true) {
                throw new Exception(implode(', ',$TempErrorCheck), 1);
            }else{
                echo '<pre>';
                var_dump($TempErrorCheck);
                exit();
            }
        }
        
    }

    public static function APiall(array $arr){
        foreach ($arr as $key => $value) {
            if (is_array($arr[$key])) {
                $var =implode(',', $_POST[$key]);
                $arr[$key] = NI_security::anti_XSS($var);
            }else{
                $arr[$key] = NI_security::anti_XSS($value);
            }
           
        }
        return $arr;
    }

    public static function API_validate(array $post_data,$data = array()){
        $TempErrorCheck = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    $data[$key] = NI_security::PoolFilterus($value, $post_data[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }else{
                    $data[$key] = NI_security::Filterus($value, $post_data[$key] ?? false)[1] ?? false ;
                    if ($data[$key] == false) $TempErrorCheck[] =  $key.' not valid';
                }
            }
        }
        if (empty($TempErrorCheck)) {
            return self::APiall($data);
        }else {

            if (DEV == true) {
                throw new Exception(implode(', ',$TempErrorCheck), 1);
            }else{
                echo '<pre>';
                var_dump($TempErrorCheck);
                exit();
            }
        }
        
    }

    public static function validate_obj(object $object, array $data) : bool
    {
        $arr = self::validate($data);
        foreach ($arr as $key => $value) {
            $object->$key = $value;
        }
        if($object->save()){
            return true;
        }else{
            return false;
        }

    }



}
