<?php
class CLI_MVC
{
    public static function makeModel()
    {
        $dbarr = CLI_Helper::GetDBColumnArray();
        foreach ($dbarr as $table => $ColArr) {
            $new_model = MODEL . $table . '.php';
            if (!is_file($new_model)) {
                $mymodel = fopen($new_model, "w");
                $code = '<?php 
namespace model; 
class ' . $table . ' { 
    public static function create(array $data) 
    {
        $new = \ORM::for_table("' . $table . '")->create();
        $new->delete_flag = 0;
        ';
                $code2 = '';
                foreach ($ColArr as $key) {
                    if ($key == 'id' || $key == 'update_at' || $key == 'create_at') continue;
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
        $update = \ORM::for_table("' . $table . '")->find_one([$data["id"]]);
        if(is_bool($update)) return false ;
        
        foreach ($data as $key => $value) {
            if ($key == "id") continue;
            $update->set($key,$value);
        }
        if($object->save()){
            return true;
        }else{
            return false;
        }
    }

    public static function delete(int $id) 
    {
        $delete = \ORM::for_table("' . $table . '")->find_one([$id]);
        if(is_bool($delete)) return false ;
        $delete->set("delete_flag",1);
        if ($delete->save()) {
            return true;
        }else{
            return false;
        }
    }

    public static function select() 
    {
        return \ORM::for_table("' . $table . '")->findArray();
    }
}
';

                fwrite($mymodel, $code);
                echo "\e[1;33;40m Model $table create successfully \e[0m\n";
            } else {
                echo "\e[1;33;40m Model $table already exists \e[0m\n";
            }
        }
    }
}
