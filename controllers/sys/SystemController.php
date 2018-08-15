<?php
use \Servit\Restsrv\RestServer\RestException;
use Servit\Restsrv\RestServer\ThemeController;
use \Servit\Restsrv\Libs\Request;

class SystemController extends SystemThemeController
{



    /**
    *@noAuth
    *@url GET /
    */
    public function index()
    {
        echo 'system Index';
    }


    /**
    *@noAuth
    *@url GET /test/
    */
    public function test()
    {
        echo 'system test';
    }
}
