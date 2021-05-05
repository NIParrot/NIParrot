<?php
require_once 'config.php';
require_once 'core/core/Inflect.php';
require_once 'core/core/NI_route.php';
require_once 'api/core/NI_Api_route.php';
require_once 'CLI/CLI_Classes/CLI_Helper.php';
require_once 'CLI/CLI_Classes/CLI_Plugin.php';
require_once 'CLI/CLI_Classes/CLI_Routes.php';
require_once 'CLI/CLI_Classes/CLI_DB.php';
require_once 'CLI/CLI_Classes/CLI_MVC.php';
define("MARKET", ROOT . SEP . 'market-place' . SEP);
define("API_MODEL", ROOT . SEP . 'api' . SEP . 'Controller' . SEP);
define("JS", ROOT . SEP . 'app' . SEP . 'static' . SEP . 'js' . SEP);
define("CSS", ROOT . SEP . 'app' . SEP . 'static' . SEP . 'css' . SEP);
echo "\e[0;34m
 ____  _____  _____       _       ____  ____ 
|_   \|_   _||_   _|     / \     |_   ||   _|
  |   \ | |    | |      / _ \      | |__| |  
  | |\ \| |    | |     / ___ \     |  __  |  
 _| |_\   |_  _| |_  _/ /   \ \_  _| |  | |_ 
|_____|\____||_____||____| |____||____||____|
\e[0m\n";

class NI_CLI
{
    public static function run($input = array())
    {
        switch ($input[0]) {
        case 'serve':
            $randport = random_int(6000, 9999);
            $ip = system("(ip addr | grep -Po '(?!(inet 127.\d.\d.1))(inet \K(\d{1,3}\.){3}\d{1,3})')");
            $ip = ($ip > 0) ? $ip : '127.0.0.1';
            system("php -S $ip:$randport");
            break;
        case 'Git':
            CLI_Plugin::GitPluginFrom_github($input);
            break;
        case 'Check':
            CLI_Plugin::CheckPluginFiles($input);
            break;
        case 'Install':
            CLI_Plugin::InstallPlugin($input);
            break;
        case 'GetRoutes':
            CLI_Routes::GetRoutes();
            break;
        case 'GetApiRoutes':
            CLI_Routes::GetRoutes();
            break;

        case 'MFunc':
            $tttmethod = $input[1];
            $tttclass = 'CLI_MVC';
            $tttclass::$tttmethod($input);
            break;

        case 'PMFunc':
            $tttmethod = $input[2];
            $tttclass = 'CLI_MVC';
            $tttclass::$tttmethod($input);
            break;
                /*
                break;
            case 'ControllerAddFunc':
                self::make($input);
                break;
                 */

        case 'make':
            switch ($input[1]) {
            case 'DB':
                CLI_DB::CreateDataBase();
                break;

            case 'Migrate':
                CLI_DB::CreateTables();
                break;

            case 'Seeds':
                CLI_DB::InsertIntoDB();
                break;

            case 'Relation':
                CLI_DB::CreateRelation($input);
                break;

            case 'Model':
                CLI_MVC::makeModel();
                break;

            case 'ParisModel':
                CLI_MVC::makeParisModel();
                break;
                    /*
                case 'Route':
                    CLI_MVC::relation($args);
                    break;

                case 'ApiRoute':
                    CLI_MVC::relation($args);
                    break;

                case 'Controller':
                    CLI_MVC::relation($args);
                    break;
                */
            default:
                echo "command dose not correct use --h to get help";
                break;
            }
            break;

        default:
            echo "command dose not correct use --h to get help";
            break;
        }
    }
}

echo "welcome to NI_Parrot CLI Version. How Can I Help You: ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$input = explode(" ", $line);
$input[count($input) - 1] = str_replace("\n", '', $input[count($input) - 1]);

if ($input[0] == '?' || $input[0] == 'help' || $input[0] == 'h' || $input[0] == '--h' || $input[0] == '-h') {
    echo '
php NI Git "username" "repo"
php NI Check "plugin"
php NI Install "plugin"
php NI GetRoutes
php NI GetApiRoutes
php NI MFunc "Function" "Model" --> (Mfunc for ModelAddFunction)
php NI MPFunc "Function" "Model" --> (Mfunc for ParisModelAddFunction)
php NI ControllerAddFunc "Function" "Controller"
php NI make DB
php NI make Migrate
php NI make Seeds
php NI make Relation
php NI make Relation master.id slave [update=$OPTION,delete=$OPTION]
php NI make Model
php NI make ParisModel
php NI make Route
php NI make ApiRoute
php NI make Controller
';
    //var_dump(CLI_Helper::GetDBColumnArray());
} else {
    NI_CLI::run($input);
}