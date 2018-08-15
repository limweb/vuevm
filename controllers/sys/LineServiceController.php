<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;
use Servit\Restsrv\Libs\Request;

use Servit\Restsrv\Libs\Mobile_Detect; // check device
use Servit\Restsrv\Libs\Linenotify;

class LineServiceController extends BaseController
{

    /**
     *@noAuth
     *@url GET /
     */
    public function index()
    {
        echo "Line Notify Service";
    }


    /**
     *@noAuth
     *@url GET /send/$msg
     */
    public function send($msg)
    {
        $token = null;
        $this->sendmsg($msg, $token);
    }


    /**
     *@noAuth
     *@url GET /register/
     */
    public function register()
    {
        $queryStrings = [
            'response_type' => 'code',
            'client_id' => env('LINESERVICE_ID'),
            'redirect_uri' => env('LINESERVICE_REDIRECTURL'),
            'scope' => 'notify',
            'state' => 'csrf'
        ];

        $queryStringhttp = env('LINESERVICE_api') . http_build_query($queryStrings);
        echo '<a href="' . $queryStringhttp . '">subscribe เพื่อรับข้อความจาก Line Notify</a>';
    }


    /**
     *@noAuth
     *@url GET /callback/
     */
    public function callback()
    {
        if ($this->input->gets->error) {
            dump($this->input->gets->error);
        } else {
            $code = $this->input->gets->code;
            $state = $this->input->gets->state;
            $data = 'grant_type=authorization_code&code=' . $code .
                '&redirect_uri=' . env('LINESERVICE_REDIRECTURL') .
                '&client_id=' . env('LINESERVICE_ID') .
                '&client_secret=' . env('LINESERVICE_SECRET');
            $headers = array('content-type: application/x-www-form-urlencoded');
            $chOne = curl_init();
            curl_setopt($chOne, CURLOPT_URL, env('LINESERVICE_AUTHTOKEN'));
            curl_setopt($chOne, CURLOPT_POST, 1);
            curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($chOne, CURLOPT_POSTFIELDS, $data);
            curl_setopt($chOne, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
            $this->result = json_decode(curl_exec($chOne), false);
            if (curl_error($chOne)) {
                $this->error = curl_error($chOne);
            }
            curl_close($chOne);
            dump($this->result);
            $this->sendmsg('hello', $this->result->access_token);
        }
    }




    private function sendmsg($msg = null, $token = null)
    {
        if ($msg && $msg != '$msg') {
            if ($token) {
                $ln = new Linenotify($token);
            } else {
                $ln = new Linenotify();
            }
            $ln->message = $msg;
            $rs = $ln->send();
            return $rs;
        }
    }
}
