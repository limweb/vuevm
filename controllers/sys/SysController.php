<?php

use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Servit\Restsrv\Libs\Request;

use Servit\Restsrv\Libs\Mobile_Detect; // check device
use Servit\Restsrv\Libs\Linenotify;

 //line notify

class SysController extends BaseController
{

    // public function getChkauth(){
    //     if($this->server->mode == 'debug'){
    //         echo 'Server Mode is : Debug  Header Authorization Bearer is  verify validate pass';
    //     }
    // }

    

    /**
     * @noAuth
     */
    private function info($info = null)
    {
        echo "<br/><center><b>API Server JWT v1.".((isset($info) && $info=='tlen') ? $info : null)." is WORK!</b></center>";
    }

    /**
     * @noAuth
     * @url GET /routes
     * @url GET /routes/$info
     * @url GET /routes/$info/$controller
     */
    public function getRoutes($info = null, $controller = null)
    {
        // dump($this, $info, $controller);
        // $this->info($info);
        if ($this->server->mode == 'debug' || $info == 'tlen') {
            echo '<style> .divline { width:100%; text-align:center; border-bottom: 1px dashed #000; line-height:0.1em; margin:10px 0 20px; } 
            </style>
            <center><table><thead><tr><td><b>Route</b></td><td><b>Controller</b></td><td><b>Method</b></td><td><b>$args</b></td><td>null</td><td><b>@noAuth</b></td></tr></thead><tbody>';
            foreach ($this->server->routes() as $routekey => $routes) {
                echo '<tr><td colspan="6"><div style="display:flex;padding-right:10px;height:15px;">
                <div class="divline" style="width:200px;">&nbsp;</div>
                <span style="white-space: pre;">&nbsp;>&nbsp;@url '.$routekey.'&nbsp;</span>
                <div class="divline">&nbsp;</div>
                </div>
                </td></tr>';
                switch ($routekey) {
                    case 'GET':
                        foreach ($routes as $key => $value) {
                            if ($info == 'tlen' && $controller) {
                                if (strtolower($value[0])==strtolower($controller)) {
                                    echo "<tr><td>".($routekey =='GET' ? '<a href="http://'.$_SERVER['HTTP_HOST'].'/'.$key.'">'.( empty($key) ? '/' : $key ).'</a>'    : $key)."</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                                }
                            } else {
                                echo "<tr><td>".($routekey =='GET' ? '<a href="http://'.$_SERVER['HTTP_HOST'].$this->server->root.$key.'">'.( empty($key) ? '/' : $key ).'</a>'    : $key)."</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                            }
                        }
                        break;
                    case 'POST':
                    case 'OPTIONS':
                    default:
                        foreach ($routes as $key => $value) {
                            if ($info == 'tlen' && $controller) {
                                if (strtolower($value[0])==strtolower($controller)) {
                                    echo "<tr><td style='cursor:pointer;' onclick='alert(\"".$key."\")'>$key</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                                }
                            } else {
                                echo "<tr><td style='cursor:pointer;' onclick='alert(\"".$key."\")'>$key</td><td>$value[0]</td><td>$value[1]</td><td><pre>".json_encode($value[2])."</pre></td><td>".json_encode($value[3])."</td><td>".json_encode($value[4])."</td></tr>";
                            }
                        }
                        break;
                }
            }
            echo '<tr><td colspan="6"><div style="display:flex;padding-right:10px;height:15px;">
            <div class="divline">&nbsp;</div>
            <span style="white-space: pre;">&nbsp;>&nbsp;END.&nbsp;</span>
            </div></td></tr>';
            echo '</tbody></table></center>';
        }
        exit(0);
    }


    /**
     * @noAuth
     */
    public function getServerinfo($info = null, $show = null)
    {
        $this->info($info);
        if ($this->server->mode == 'debug' || $info == 'tlen') {
            dump($this);
            if ($info=='tlen' && $show) {
                phpinfo();
            }
        }
        exit(0);
    }

    /**
     * @url GET /info
     * @noAuth
     */
    public function homeinfo($info = null)
    {
        $this->info($info);
        $magic = __DIR__.'/../home/magic.html';
        if (file_exists($magic)) {
            echo '<center>';
                require $magic;
            echo '</center>';
        }
        exit(0);
    }

    /**
     * @url GET /
     * @noAuth
     */
    public function home()
    {
        $this->info();
        // // echo '<center>';require __DIR__.'/../home/magic.html'; echo '</center>';
        // // require __DIR__.'/../page/app.php';
        // require $this->server->serverpath.'/page/themes/web/index.php';
        exit(0);
    }

    /**
     * Throws an error
     * @noAuth
     * @Test
     * @url GET /error
     */
    public function throwError()
    {
        throw new RestException(401, "Empty password not allowed");
    }

    /**
     *@noAuth
     *@url GET  /myadmin
     *@url POST /myadmin
     */
    public function myadmin()
    {
        $myadmin = __DIR__.'/../utils/mysqladmin.php';
        if (file_exists($myadmin) && $this->server->mode == 'debug') {
            require_once $myadmin;
        } else {
            echo 'MyAdmin No Found';
        }
    }

    /**
     *@noAuth
     *@url GET  /explorer
     *@url POST /explorer
     */
    public function phpexplorer()
    {
        $phpexp = __DIR__.'/../utils/phpexplorer.php';
        if (file_exists($phpexp) && $this->server->mode == 'debug') {
            require_once $phpexp;
        } else {
            echo 'Explorer Not Found!';
        }
    }
}
