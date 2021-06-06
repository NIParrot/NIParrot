<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class NI_Eloquent
{
    public static function run()
    {
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => DBTYPE,
            'host' => HOST,
            'database' => DBNAME,
            'username' => USER,
            'password' => PASS,
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        // Setup the Eloquent ORM… 
        $capsule->bootEloquent();
    }
}
