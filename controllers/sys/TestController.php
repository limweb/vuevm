<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Servit\Restsrv\Libs\Request;

use Servit\Restsrv\Libs\Mobile_Detect; // check device
use Servit\Restsrv\Libs\Linenotify;

class TestController extends BaseController
{
    
    /**
    *@noAuth
    *@url GET /abc/
    */
    public function abc(){
        $leftmenus = Menu::where('status',1)
         ->where('parent_id',0)
         ->where('group',2)
         ->where('menu_position','LEFTSIDEBAR')->orderBy('sort','asc')->get();
         dump($leftmenus);
    }
    
    
    /**
     * @noAuth
     * @url GET  /test
     * @url GET  /test/$id
     * @url GET  /test/$id/$a
     * @url GET  /test/$id/$a/$b
     * @url GET  /test/$id/$a/$b/$c
     * @url POST  /test
     * @url POST  /test/$id
     * @url POST  /test/$id/$a
     * @url POST  /test/$id/$a/$b
     * @url POST  /test/$id/$a/$b/$c
     */
    public function postTest($id = null, $a = null, $b = null, $c = null)
    {

        echo 'test';
        // $token = "WJBGD9HkINjarKGafuGbM3WCDdaZ0YdgveExsmKGiFv"; //ใส่Token ที่copy เอาไว้
        // $ln = new Linenotify($token);
        $ln = new Linenotify();
        $str = "Hello ภาษาไทย "; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
        $ln->message            = $str;
        $rs = $ln->send();
        // echo $ln;
        // dump($rs);

        // dump($this);
        // $this->input->test = 'xxxxx';
        // $this->input->user = 'aaaa';
        // dump($this);
        // require_once $this->server->serverpath.'/page/themes/web/index.php';
        // $user = User::find(3);
        // $cols = $user->getTableColumns();
        // dump($this,$user,$cols);
        // $this->server->setConnection('sys_');
        // $user = User::find(3);
        // $cols = $user->getTableColumns();
        // dump($this,$user,$cols);

        // if($this->server->mode == 'debug'){
        //     $o = new stdClass();
        //     $o->hasRole = $this->rbac->hasRole('admin');
        //     $o->rbac = $this->rbac;
        //     $o->this = $this;
        //     $o->url = $this->server->url;
        //     $o->method = $this->server->method;
        //     $o->params = $this->server->params;
        //     $o->getStatus = $this->jwt->getStatus();
        //     $o->getJwt = $this->jwt->getJwt();
        //     $o->token = $this->jwt->getToken();
        //     $o->getJwtobjdata = $this->jwt->getJwtobjdata();
        //     $o->tokenverify = $this->jwt->tokenverify();
        //     $o->chkauto = $this->jwt->chkauth();
        //     $o->jwtrefreshobj = $this->jwt->jwtrefreshobj();
        //     $o->data = 'tlen work';
        //     $o->format = $this->server->format;
        //     $o->status = 'success';
        //     $o->id = $id;
        //     $o->a = $a;
        //     $o->b = $b;
        //     $o->c = $c;
        //     $o->gentokentest =  $this->jwt->token(json_decode('{"username":"","id":1,"role":"admin","level":"FF"}'));
        //     // dump($this,$o);
        //     return $o;
        // }
    }
}
