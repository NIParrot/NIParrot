<?php
class CLI_Routes
{
    public static function GetRoutes()
    {
        $routes = array_keys(NI_route::$routes);
        $PostRoutes = array_keys(NI_route::$PostRoutes);
        $PutRoutes = array_keys(NI_route::$PutRoutes);
        $DeleteRoutes = array_keys(NI_route::$DeleteRoutes);
        $any = array_keys(NI_route::$any);
        echo "\e[1;33;40m Get Routes \e[0m\n";
        foreach ($routes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Post Routes \e[0m\n";
        foreach ($PostRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Put Routes \e[0m\n";
        foreach ($PutRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Delete Routes \e[0m\n";
        foreach ($DeleteRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Any Routes \e[0m\n";
        foreach ($any as $key) {
            echo $key . "\n";
        }
    }

    public static function GetApiRoutes()
    {
        $routes = array_keys(NI_Api_route::$routes);
        $PostRoutes = array_keys(NI_Api_route::$PostRoutes);
        $PutRoutes = array_keys(NI_Api_route::$PutRoutes);
        $DeleteRoutes = array_keys(NI_Api_route::$DeleteRoutes);
        $any = array_keys(NI_Api_route::$any);
        echo "\e[1;33;40m Get Routes \e[0m\n";
        foreach ($routes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Post Routes \e[0m\n";
        foreach ($PostRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Put Routes \e[0m\n";
        foreach ($PutRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Delete Routes \e[0m\n";
        foreach ($DeleteRoutes as $key) {
            echo $key . "\n";
        }
        echo "\e[1;33;40m Any Routes \e[0m\n";
        foreach ($any as $key) {
            echo $key . "\n";
        }
    }
}
