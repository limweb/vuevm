<?php
use \Servit\Restsrv\RestServer\RestException;
use Servit\Restsrv\RestServer\ThemeController;
use \Servit\Restsrv\Libs\Request;

class RootThemeController extends ThemeController
{

    protected $theme = '';
    protected $themeurl = "/page/themes/lcrm";

    protected function getthemepath(){
        return $this->themepath.'/lcrm';
    }


    protected function get_themeurl()
    {
        return '/page/themes/lcrm/';
    }

    public function __construct()
    {
        $this->themepath = __DIR__.'/../../page/themes/';
        parent::__construct();
    }

    public function handle404()
    {
        $login = $_SESSION['login'];
        if($login){
            $phproute = Menu::where('permalink',$this->server->url)->first();
            if($phproute) {
                $_SESSION['url'] = '/'.$phproute->permalink;
            } else {
                $_SESSION['url'] = '';
            }
             $this->input  = $this->server->data;
            // dump($this); exit();
            if($phproute){
                //---- vue route----------
                include_once __DIR__.'/../../page/themes/lcrm/index.php';
            } else {
                Header('Location: /home');
            }
        } else {
            Header('Location: /login');
        }
        // $this->get_header();
        // $path404 = $this->themepath.$this->theme.'/errors/404.php';
        // if (file_exists($path404)) {
        //     require_once $path404;
        // } else {
        //     echo '<h2><b>Error:</b>404</h2>';
        // }
        // $this->get_footer();
    }
    
    public function handle401()
    {
        $this->get_header();
        $path401 = $this->themepath.'/lcrm/errors/401.php';
        if (file_exists($path401)) {
            require_once $path401;
        } else {
            echo '<h2><b>Error:</b>401</h2>';
        }
        $this->get_footer();
    }
}
