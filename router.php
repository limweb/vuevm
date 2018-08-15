<?php
date_default_timezone_set("Asia/Bangkok");
// Directory that contains error pages
define("ERRORS", dirname(__FILE__) . "/errors");

// Default index file
define("DIRECTORY_INDEX", "index.php");

// Optional array of authorized client IPs for a bit of security
$config["hostsAllowed"] = [];

if (!function_exists( 'implodeKV' )) {
    function implodeKV($glueKV, $gluePair, $KVarray)  {
      if( is_object($KVarray) ) {
        $KVarray = json_decode(json_encode($KVarray),TRUE);
      }
      $t = array();
      foreach($KVarray as $key=>$val) {
        if(is_array($val)){
          $val = implodeKV(':',',',$val);
        }else if( is_object($val)){
          $val = json_decode(json_encode($val),TRUE);
          $val = implodeKV(':',',',$val);
        }

        if(is_int($key)){
          $t[] = $val;
        } else {
          $t[] = $key . $glueKV . $val;
        }
      }
      return implode($gluePair, $t);
    }
}

if (!function_exists('consolelog') ) {
    function consolelog($status = 200)  {
      $lists = func_get_args();
      $status = '';
      $status = implodeKV( ':' , ' ' , $lists);
      if(isset($_SERVER["REMOTE_ADDR"]) && !empty($_SERVER["REMOTE_ADDR"])){
        $raddr =$_SERVER["REMOTE_ADDR"];
      } else {
        $raddr = '127.0.0.1';
      }
      if(isset($_SERVER["REMOTE_PORT"]) && !empty($_SERVER["REMOTE_PORT"])){
        $rport = $_SERVER["REMOTE_PORT"];
      } else {
        $rport = '8000';
      }

      if(isset($_SERVER["REQUEST_URI"]) && !empty($_SERVER["REQUEST_URI"])){
        $ruri = $_SERVER["REQUEST_URI"];
      } else {
        $ruri = '/console';
      }
      file_put_contents("php://stdout",
        sprintf("[%s] %s:%s [%s]:%s \n",
          date("D M j H:i:s Y"),
          $raddr,$rport,
          $status,
          $ruri
          )
        );
    }
} // end-of-check funtion exist

if(!function_exists( 'logAccess' )){
  function logAccess($status = 200) {
    file_put_contents("php://stdout", sprintf("[%s] %s:%s [%s]: %s\n",
      date("D M j H:i:s Y"), $_SERVER["REMOTE_ADDR"],
      $_SERVER["REMOTE_PORT"], $status, $_SERVER["REQUEST_URI"]));
  }
}

// Parse allowed host list
if (!empty($config['hostsAllowed'])) {
  if (!in_array($_SERVER['REMOTE_ADDR'], $config['hostsAllowed'])) {
   logAccess(403);
   http_response_code(403);
   include ERRORS . '/403.php';
   exit;
 }
}

// if requesting a directory then serve the default index
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$ext = pathinfo($path, PATHINFO_EXTENSION);
if (empty($ext)) {
    $path = rtrim($path, "/") . "/" . DIRECTORY_INDEX;
}

// If the file exists then return false and let the server handle it
if (file_exists($_SERVER["DOCUMENT_ROOT"] . $path)) {
    return false;
}

// public/cliserver.php (router script)
if (php_sapi_name() !== 'cli-server') {
    die('this is only for the php development server');
}

if (is_file($_SERVER['DOCUMENT_ROOT'].'/'.$_SERVER['SCRIPT_NAME'])) {
    // probably a static file...
    return false;
}
$_SERVER['SCRIPT_NAME'] = '/index.php';
// if needed, fix also 'PATH_INFO' and 'PHP_SELF' variables here...
// require the entry point
require 'index.php';