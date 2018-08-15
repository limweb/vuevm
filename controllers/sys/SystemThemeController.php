<?php
use \Servit\Restsrv\RestServer\RestException;
use Servit\Restsrv\RestServer\ThemeController;
use \Servit\Restsrv\Libs\Request;

class SystemThemeController extends ThemeController
{

    protected $theme = 'system';


    public function gettheme(){
        return $this->theme;
    }

    public function __construct()
    {
        $this->themepath = __DIR__.'/..';
        parent::__construct();
    }

    public function handle404()
    {
        // $this->get_header();
        $path404 = $this->themepath.'/../page/themes/'.$this->theme.'/errors/404.php';
        if (file_exists($path404)) {
            require_once $path404;
        } else {
            echo '<h2><b>system Error:</b>404</h2>';
        }
        // $this->get_footer();
    }
    
    public function handle401()
    {
        $this->get_header();
        $path401 = $this->themepath.'/../page/themes/'.$this->theme.'/errors/401.php';
        if (file_exists($path401)) {
            require_once $path401;
        } else {
            echo '<h2><b>system Error:</b>401</h2>';
        }
        $this->get_footer();
    }
} 