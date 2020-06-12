<?php
/**
 * @method call_app_resources take @param RootDirectory $rootDir to read All inner Files
 * then @return allData  As array Have All Files Path
 */
function call_app_resources(string $rootDir, $allData = array()) : array
{
    $invisibleFileNames = array(".", "..", ".htaccess", ".htpasswd");
    $dirContent = scandir($rootDir);
    foreach ($dirContent as $key => $content) {
        $path = $rootDir . SEP . $content;
        if (!in_array($content, $invisibleFileNames)) {
            if (is_file($path) && is_readable($path)) {
                $allData[] = $path;
            } elseif (is_dir($path) && is_readable($path)) {
                $allData = call_app_resources($path, $allData);
            }
        }
    }
    return $allData;
}

/**
 * @var all_app_files =  [@var array_model_files + @var array_controller_files + @var array_some_core_files + @var array_routes_files]
 * @var all_app_files is array have all app files path
 * @var array_some_core_classes have other classes path
 */
$array_controller_files = call_app_resources(ROOT . SEP . 'app' . SEP . 'Controller');
$array_routes_files = call_app_resources(ROOT . SEP . 'routes');
$array_model_files = call_app_resources(ROOT . SEP . 'app' . SEP . 'Model');

$array_some_core_files = array(
    ROOT . SEP . 'includes' . SEP . 'autoload.php',
    ROOT . SEP . 'core' . SEP . 'autoload.php',
    ROOT . SEP . 'core' . SEP . 'Mustache' . SEP . 'Autoloader.php',
);
$array_some_core_classes = array(
    ROOT . SEP . 'core' . SEP . 'core' . SEP,
    ROOT . SEP . 'core' . SEP . 'SingelLibs' . SEP,
    ROOT . SEP . 'engien' . SEP . 'template' . SEP
);
$all_app_files = array_merge($array_controller_files, $array_some_core_files, $array_model_files, $array_routes_files);

/**
 * 2 Array Map for Calling everything on App
 */
array_map(static function ($path) {
    array_map(static function ($filename) {
        require_once $filename;
    }, glob("{$path}/*.php"));
}, $array_some_core_classes);

array_map(static function ($file) {
    if (file_exists($file)) require_once $file;
}, $all_app_files);

// call vendor library
require_once 'vendor' . SEP . 'autoload.php';

/**
 * set default lang 
 */
if (!isset($_SESSION['lang'])) $_SESSION['lang'] = 'en';
if (isset($_POST['changlang'])) {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] == "ar") {
        $_SESSION['lang'] = "en";
    } elseif (isset($_SESSION['lang']) && $_SESSION['lang'] == "en") {
        $_SESSION['lang'] = "ar";
    }
}

/**
 * use Erro Handel @method Whoops
 * using Dev Tools for test ram and cpu Ubench
 */
use \Whoops\Run as whoops;

if (DEV == true) {
    $NI_whoops = new whoops;
    $NI_whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $NI_whoops->register();
    $NI_bench = new Ubench;
}
//set main path for @class View 
NI_view::$path = VIEW;

//calling DB connection
if (USEDB == true){
    $NI_connect = new NI_connect(HOST, PORT, DBNAME, USER, PASS);
    switch (DBTYPE) {
        case 'mysql':
            $NI_connect->mysql();
            $conn = $NI_connect->connection();
            break;
        case 'sqlsrv':
            $NI_connect->sqlsrv();
            break;
    }
}

// using Mustache template 
Mustache_Autoloader::register();
$NI_Mustache = new Mustache_Engine;
/**
 * using @method TRACKING 
 * it's write users data on Tracktable files
 */
use SimpleExcel\SimpleExcel;


if (TRACKING == true) {
    $UserInfo = new UserInfo();
    $excel = (new SimpleExcel('csv'));
    if (file_exists(Tracktable)) {
        $excel->parser->loadFile(Tracktable);
        if (strpos($UserInfo->getCurrentURL(), 'dashboard') === false) {
            $excel->writer->addRow(array($UserInfo->getIP(), $UserInfo->getReverseDNS(), $UserInfo->getCurrentURL(), (empty(explode('.',$UserInfo->getRefererURL())[1]) ? "other" : explode('.',$UserInfo->getRefererURL())[1]) , $UserInfo->getDevice(), $UserInfo->getOS(), $UserInfo->getBrowser(), $UserInfo->getLanguage(), empty($UserInfo->getCountryCode()) ? 'local' : $UserInfo->getCountryCode(), $UserInfo->getCountryName(), $UserInfo->getRegionCode(), $UserInfo->getRegionName(), $UserInfo->getCity(), $UserInfo->getZipcode(), $UserInfo->getLatitude(), $UserInfo->getLongitude(), $UserInfo->isProxy(), date("F d, Y h:i:s A")));
            $excel->writer->saveFile('Tracktable', Tracktable);
        }
    } else {
        $excel->writer->saveFile('Tracktable', Tracktable);
    }
}
