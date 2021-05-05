<?php

/**
 * @var SEP = / or \ Based on OS
 * @var ROOT = App directory path
 *
 * @var VIEW = VIEW directory path
 * @var MODEL = MODEL directory path
 * @var CONTROLLER = CONTROLLER directory path
 * @var STORAGE = STORAGE directory path
 * @var Tracktable = Tracktable directory path
 *
 * @author Ahmed Hisham --> ahmedhesham2012@yahoo.com
 * Do not replace or change anything of this constants
 */


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SERVER['SERVER_NAME'])) {
    define("URL", $_SERVER['SERVER_NAME']);
}
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    define('csrf', sha1($_SERVER['HTTP_USER_AGENT']));
}

define("SEP", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__);

define("VIEW", ROOT . SEP . 'app' . SEP . 'View' . SEP);
define("ROUTE", ROOT . SEP . 'routes' . SEP);
define("APIROUTE", ROOT . SEP . 'api' . SEP . 'routes' . SEP);
define("MODEL", ROOT . SEP . 'app' . SEP . 'Model' . SEP);
define("PARISMODEL", ROOT . SEP . 'app' . SEP . 'Paris' . SEP);
define("MIDDLEWARE", ROOT . SEP . 'app' . SEP . 'Middleware' . SEP);
define("CONTROLLER", ROOT . SEP . 'app' . SEP . 'Controller' . SEP);
define("STORAGE", ROOT . SEP . 'storage' . SEP);
define("Tracktable", ROOT . SEP . 'engien' . SEP . 'Tracktable.csv');
define("RelationFile", ROOT . SEP . 'CLI' . SEP . 'relation.txt');
/**
 * relation file syntax
 * Parent_Table.Parent_Column child_Table [update=@var,delete=@var];
 *
 * @var = ['NO ACTION','CASCADE','SET NULL','SET DEFAULT']
 */

/**
 * @var TRACKING = True or False, if you want using @method 'Track site visits'
 *      if it true -> give @var Tracktable permissions 666
 * @var HTTPS_PROTOCOL = True or False, if you using https make it True to auto redirect at https
 * @var Dev it's = True on During the construction and development stage
 * @var USEDB = True or False, if your app using database
 */
define("TRACKING", false);
define("HTTPS_PROTOCOL", false);
define("DEV", true);
define("USEDB", true);
define("USEFIREBASE", true);
define("USEPayMob", false);
define("DeleteFlag", false);
define("FrontFrame", 'all');
/**
 * FrontFrame : UIkit
 * FrontFrame : Bootstrap
 * FrontFrame : all
 */
/**
 * DataBase Connection data
 */
define("HOST", '127.0.0.1');
define("PORT", '3306');
define("USER", 'ahmed');
define("PASS", '741852963');
define("DBNAME", 'Kindergarten');
define("DBTYPE", 'mysql');
/**
 * DBTYPE : mysql
 * DBTYPE : sqlserv
 * DBTYPE : sqlite --> HOST = /path/to/database.db
 */
/**
 * @var APISK and @var Appname using in Api with JWT
 */
define('APISK', 'Kindergarten');
define('Appname', 'دار الشيماء');

/**
 * @var NOTICE_MAIL = True or False, if you want using @method 'Email notifications'
 *      if it true -> SMTP Server Connection Data [@var Mail_Host, @var Mail_Username, @var Mail_Password, @var Mail_Port]
 */
define('notice_mail', false);
define('Mail_Host', 'NI Parrot');
define('Mail_Username', 'NI Parrot');
define('Mail_Password', 'NI Parrot');
define('Mail_Port', 'NI Parrot');

/**
 * init firebase key here while it true
 */
define("FIREBASE_KEY", 'AAAASXy2Ex0:APA91bF49cGV0ggkf6OVxngHP4SFPFzj6K_wRjOBZ7A8FFEtWj_HBitmUWhNOzvsRbUBLAIAUmYH8KNJ_84CmczSYTIM99IiaQ0nR9oSTJXb9pzSzIYeo8fu6KWAjDiaXqUN6Sz2hjS8');

/**
 * init patmob here
 * username and password and integration id
 */
define('PayMob_User_Name', 'username');
define('PayMob_Password', 'password');
define('PayMob_Integration_Id', 'Integration_Id');