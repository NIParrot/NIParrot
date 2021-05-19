<?php
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}
if (isset($_POST['changlang'])) {
    if (isset($_SESSION['lang']) && $_SESSION['lang'] == "ar") {
        $_SESSION['lang'] = "en";
    } elseif (isset($_SESSION['lang']) && $_SESSION['lang'] == "en") {
        $_SESSION['lang'] = "ar";
    }
}

use \Whoops\Run as whoops;
use Paymob\PayMob;

if (DEV == true) {
    $NI_whoops = new whoops;
    $NI_whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $NI_whoops->register();
    $NI_bench = new Ubench;
}
if (USEPayMob == true) {
    $config = [
        'PayMob_User_Name' => 'your_username',
        'PayMob_Password' => 'your_password',
        'PayMob_Integration_Id' => 'Integration_Id'
    ];

    $init = new PayMob($config);
    $auth = PayMob::AuthenticationRequest();
}


NI_view::$path = VIEW;


if (USEDB == true) {
    $NI_connect = new NI_connect(HOST, PORT, DBNAME, USER, PASS);
    switch (DBTYPE) {
        case 'mysql':
            $NI_connect->mysql();
            $conn = $NI_connect->connection();
            break;
        case 'sqlsrv':
            $NI_connect->sqlsrv();
            break;
        case 'sqlite':
            $NI_connect->sqlite();
            break;
    }
}

Mustache_Autoloader::register();
$NI_Mustache = new Mustache_Engine;

use SimpleExcel\SimpleExcel;

if (TRACKING == true) {
    $UserInfo = new UserInfo();
    $excel = (new SimpleExcel('csv'));
    if (file_exists(Tracktable)) {
        $excel->parser->loadFile(Tracktable);
        if (strpos($UserInfo->getCurrentURL(), 'dashboard') === false) {
            $excel->writer->addRow(array($UserInfo->getIP(), $UserInfo->getReverseDNS(), $UserInfo->getCurrentURL(), (empty(explode('.', $UserInfo->getRefererURL())[1]) ? "other" : explode('.', $UserInfo->getRefererURL())[1]), $UserInfo->getDevice(), $UserInfo->getOS(), $UserInfo->getBrowser(), $UserInfo->getLanguage(), empty($UserInfo->getCountryCode()) ? 'local' : $UserInfo->getCountryCode(), $UserInfo->getCountryName(), $UserInfo->getRegionCode(), $UserInfo->getRegionName(), $UserInfo->getCity(), $UserInfo->getZipcode(), $UserInfo->getLatitude(), $UserInfo->getLongitude(), $UserInfo->isProxy(), date("F d, Y h:i:s A")));
            $excel->writer->saveFile('Tracktable', Tracktable);
        }
    } else {
        $excel->writer->saveFile('Tracktable', Tracktable);
    }
}
