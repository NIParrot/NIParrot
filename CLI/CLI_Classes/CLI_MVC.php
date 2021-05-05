<?php
// phpcs:disable

class CLI_MVC
{
    public static function makeParisModel()
    {
        $dbarr = CLI_Helper::GetDBColumnArray();
        foreach ($dbarr as $table => $ColArr) {
            $tableClass = Inflect::singularize($table);
            $new_model = PARISMODEL . $tableClass . '.php';
            if (is_file($new_model)) {
                echo "\e[1;33;40m Model $tableClass already exists \e[0m\n";
                continue;
            }
            $mymodel = fopen($new_model, "w");
            $code = '<?php   
namespace ParisModel; 
    class ' . $tableClass . " extends \Model
    {
        public static \$_table = '" . strtolower($table) . "';
    }";

            $msg = fwrite($mymodel, $code) ? "\e[1;33;40m Model $tableClass create successfully \e[0m\n" : "\e[1;33;40m Model $table create Error [*_*] \e[0m\n";
            echo $msg;
        }
    }



    public static function hasone(array $input)
    {
        if (!CLI_Helper::HanelForParis($input)[0]) {
            echo CLI_Helper::HanelForParis($input)[1];
            return;
        };

        $model1 = $input[1];
        $model2 = $input[3];
        $ModelPath = PARISMODEL . $model1 . '.php';



        $code = '
        public function profile() {
            return $this->has_one("' . $model2 . '");
        }
        ';

        $contents = file_get_contents($ModelPath);
        $deletelastbractet = rtrim(rtrim($contents), '}');
        $fp = fopen($ModelPath, 'w');
        fwrite($fp, $deletelastbractet);
        fclose($fp);
        $fp = fopen($ModelPath, 'a');
        fwrite($fp, $code);
        fwrite($fp, '}');
        fclose($fp);
    }

    public static function makeModel()
    {
        $dbarr = CLI_Helper::GetDBColumnArray();
        foreach ($dbarr as $table => $ColArr) {
            if (DeleteFlag == true) {
                $deleteFunc = '
                public static function delete(int $id) 
                {
                    $delete = \ORM::for_table("' . strtolower($table) . '")->find_one([$id]);
                    if(is_bool($delete)) return false ;
                    $delete->set("delete_flag",1);
                    if ($delete->save()) {
                        return true;
                    }else{
                        return false;
                    }
                }
                ';
            } else {
                $deleteFunc = '
                public static function delete(int $id) 
                {
                    $delete = \ORM::for_table("' . strtolower($table) . '")->find_one([$id]);
                    if(is_bool($delete)) return false ;
                    if ($delete->delete()) {
                        return true;
                    }else{
                        return false;
                    }
                }
                ';
            }

            $new_model = MODEL . Inflect::singularize($table) . '.php';
            if (!is_file($new_model)) {
                $mymodel = fopen($new_model, "w");
                $code = '<?php 
    namespace model; 
    
    class ' . Inflect::singularize($table) . ' { 
                    public static function create(array $data) 
                    {
                        $new = \ORM::for_table("' . strtolower($table) . '")->create();
                        
                ';
                if (DeleteFlag == true) {
                    $code .= '$new->delete_flag = 0;';
                }
                $code2 = '';
                foreach ($ColArr as $key) {
                    if ($key == 'id' || $key == 'update_at' || $key == 'create_at' || empty($key)) {
                        continue;
                    }
                    $code2 = $code2 . '
                            $new->' . $key . ' = $data["' . $key . '"];
                            ';
                }
                $code = $code . $code2 . '
                        if ($new->save()) {
                            return true;
                        }else{
                            return false;
                        }
                    }

                    public static function update(array $data) 
                    {
                        $update = \ORM::for_table("' . strtolower($table) . '")->find_one([$data["id"]]);
                        if(is_bool($update)) return false ;
                        
                        foreach ($data as $key => $value) {
                            if ($key == "id") continue;
                            $update->set($key,$value);
                        }
                        if($update->save()){
                            return true;
                        }else{
                            return false;
                        }
                    }

                    public static function select() 
                    {
                        return \ORM::for_table("' . strtolower($table) . '")->findArray();
                    }

                    public static function find(int $id) 
                    {
                        return \ORM::for_table("' . strtolower($table) . '")->find_one([$id])->as_array();
                    }
                    ' . $deleteFunc . '
                }
                ';



                fwrite($mymodel, $code);
                echo "\e[1;33;40m Model $table create successfully \e[0m\n";
            } else {
                echo "\e[1;33;40m Model $table already exists \e[0m\n";
            }
        }
    }

    public static function ModelAuth(array $input)
    {
        $ModelName = $input[2];
        $ModelPath = MODEL . $input[2] . '.php';
        $code = '
        public static function check(array $data)
        {

            $check = \ORM::for_table("' . strtolower($ModelName) . '")->where(
                array(
                ';
        for ($i = 3; $i <= count($input) - 1; $i++) {
            $coma = ($i == count($input) - 1) ? '' : ',';
            $code = $code . "'$input[$i]' => \$data['$input[$i]'] $coma";
        }

        $code = $code . '
                )
                    )->find_one();

                return $check;

            }
        ';
        if (file_exists($ModelPath)) {
            $contents = file_get_contents($ModelPath);
            $deletelastbractet = rtrim(rtrim($contents), '}');
            $fp = fopen($ModelPath, 'w');
            fwrite($fp, $deletelastbractet);
            fclose($fp);
            $fp = fopen($ModelPath, 'a');
            fwrite($fp, $code);
            fwrite($fp, '}');
            fclose($fp);
        } else {
            echo 'model dose not exist';
        }
    }


    public static function ModelUniqe(array $input)
    {
        $ModelName = $input[2];
        $ModelPath = MODEL . $input[2] . '.php';
        $code = '
        public static function uniqe(array $data)
        {

            $check = \ORM::for_table("' . strtolower($ModelName) . '")->where_any_is(
                array(
                ';
        for ($i = 3; $i <= count($input) - 1; $i++) {
            $coma = ($i == count($input) - 1) ? '' : ',';
            $code = $code . 'array("' . $input[$i] . '" => $data["' . $input[$i] . '"])' . $coma;
        }

        $code = $code . '
                )
                    )->where_not_equal("id",$data["id"])->find_one();

                if (empty($check)) {
                    return true;
                } else {
                    return false;
                }
            }
        ';
        if (file_exists($ModelPath)) {
            $contents = file_get_contents($ModelPath);
            $deletelastbractet = rtrim(rtrim($contents), '}');
            $fp = fopen($ModelPath, 'w');
            fwrite($fp, $deletelastbractet);
            fclose($fp);
            $fp = fopen($ModelPath, 'a');
            fwrite($fp, $code);
            fwrite($fp, '}');
            fclose($fp);
        } else {
            echo 'model dose not exist';
        }
    }
    public static function ModelUniqeRegister(array $input)
    {
        $ModelName = $input[2];
        $ModelPath = MODEL . $input[2] . '.php';
        $code = '
        public static function uniqregister(array $data)
        {
            $check = \ORM::for_table("' . strtolower($ModelName) . '")->where_any_is(
                array(
                ';
        for ($i = 3; $i <= count($input) - 1; $i++) {
            $coma = ($i == count($input)) ? '' : ',';
            $code = $code . 'array("' . $input[$i] . '" => $data["' . $input[$i] . '"])' . $coma;
        }
        $code = $code . '
                )
                )->find_one();

            if (empty($check)) {
                return true;
            } else {
                return false;
            }
        }
        ';
        if (file_exists($ModelPath)) {
            $contents = file_get_contents($ModelPath);
            $deletelastbractet = rtrim(rtrim($contents), '}');
            $fp = fopen($ModelPath, 'w');
            fwrite($fp, $deletelastbractet);
            fclose($fp);
            $fp = fopen($ModelPath, 'a');
            fwrite($fp, $code);
            fwrite($fp, '}');
            fclose($fp);
        } else {
            echo 'model dose not exist';
        }
    }

    public static function ModelMultAuth(array $input)
    {
        $ModelName = $input[2];
        $ModelPath = MODEL . $input[2] . '.php';
        $code = '
        public static function MultAuth(array $data)
        {
            $check = \ORM::for_table("' . strtolower($ModelName) . '")->where_any_is(
                array(
                ';
        for ($i = 3; $i <= count($input) - 1; $i++) {
            $coma = ($i == count($input)) ? '' : ',';
            $code = $code . 'array("' . $input[$i] . '" => $data["username"], "password" => $data["password"])' . $coma;
        }
        $code = $code . '
                )
                )->find_one();

            return empty($check) ? false : true ;
        }
        ';
        if (file_exists($ModelPath)) {
            $contents = file_get_contents($ModelPath);
            $deletelastbractet = rtrim(rtrim($contents), '}');
            $fp = fopen($ModelPath, 'w');
            fwrite($fp, $deletelastbractet);
            fclose($fp);
            $fp = fopen($ModelPath, 'a');
            fwrite($fp, $code);
            fwrite($fp, '}');
            fclose($fp);
        } else {
            echo 'model dose not exist';
        }
    }
}