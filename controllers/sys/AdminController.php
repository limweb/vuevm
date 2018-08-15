<?php
use \Servit\Restsrv\RestServer\RestException;
use Servit\Restsrv\RestServer\ThemeController;
use \Servit\Restsrv\Libs\Request;

class AdminController extends AdminThemeController
{



    /**
    *@noAuth
    *@url GET /
    */
    public function admin()
    {   
        $this->get_header();
        echo 'admin Index';
        $this->get_footer();
    }


    /**
    *@noAuth
    *@url GET /test/
    */
    public function test()
    {
        echo 'admin test';
    }
}
