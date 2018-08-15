<?php
(session_status() == PHP_SESSION_NONE ? session_start() : null);
require_once __DIR__ . '/vendor/autoload.php'; // Autoload files using Composer autoload
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
require_once __DIR__ . '/configs/config.php';
require_once __DIR__ . '/configs/sysmodels.php';
define('SRVPATH', __DIR__);
$server = new \Servit\Restsrv\RestServer\RestServer($sysconfig, APPMODE); // config = class config and  mode = debug / production see config.php
$server->addClass('SysController','/system','sys'); // main route
if (AUTHTYPE == 'session' || AUTHTYPE == 'all') {
    $server->addClass('AuthController', '/api/v1/auth', 'sys'); //session
}
$server->addClass('Auth1Controller', '/api/v2/auth', 'sys'); //jwt
$server->addClass('Auth2Controller', '/api/v3/auth', 'sys'); //jwt + refresh
include __DIR__ . '/route/routes.php';
$server->includeDir(__DIR__ . '/models/');
$server->includeDir(__DIR__ . '/services/'); // can add anather dir if you want
$server->handle();
