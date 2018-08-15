<?php

// FOR DEBUGING PHP ---- start>
if (env('APPMODE') == 'debug') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}
// FOR DEBUGING PHP ---- end.
date_default_timezone_set($_ENV['TIMEZONE']);
define('NONCE_SECRET', $_ENV['NONCE_SECRET']); // for nonce class
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_HOST', $_ENV['DB_HOST']);
define('DB_CHARSET', $_ENV['DB_CHARSET']);
define('DB_COLLATE', $_ENV['DB_COLLATE']);

define('APPMODE', $_ENV['APPMODE']); // debug or production
define('DEBUG', $_ENV['DEBUG']);
define('CROS', $_ENV['CROS']);
define('EXPTIME', $_ENV['EXPTIME']);  //  60sec * 60 mins * 24 hr * 30 day
define('APP_KEY', $_ENV['APP_KEY']);
define('USEDROLE', $_ENV['USEDROLE']);
define('REFTOKEN', $_ENV['REFTOKEN']);  // reference for  GET POST AJAX token field
define('AUTHTYPE', $_ENV['AUTHTYPE']);  // session // jwt default jwt
define('PERPAGE', $_ENV['PERPAGE']);  // display number rows perpage

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model as Model;
use Carbon\Carbon;
use Servit\Restsrv\Cfg\Config;

$capsule = new Capsule;
$config = [
    'driver'    => env('DB_CONNECTION', 'mysql'),
    'host'      => env('DB_HOST', 'localhost'),
    'port'      => env('DB_PORT', '3306'),     // default port number
    'database'  => env('DB_NAME', 'dbname'),
    'username'  => env('DB_USER', 'dbuser'),
    'password'  => env('DB_PASSWORD', 'dbpass'),
    'charset'   => env('DB_CHARSET', 'utf8'),
    'collation' => env('DB_COLLATE', 'utf8_unicode_ci'),
    'prefix'    => env('DB_PREFIX', ''),
    'strict'    => false,
    ];

$capsule->addConnection($config, 'default');

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$capsule->setEventDispatcher(new Dispatcher(new Container));

// // Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();
$sysconfig = new Config();
$sysconfig->dbconfig = $config;
