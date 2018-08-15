<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;

use Illuminate\Database\Capsule\Manager as Capsule;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\ValidationData;
use Carbon\Carbon;

class Auth1Controller extends BaseController
{

    /**
     * @url GET /chktoken
     * @url OPTIONS /chktoken
     * @url POST /chktoken
    */
    public function chktoken()
    {
        if (APPMODE == 'debug') {
            return $this->jwt->chkauth();
        }
    }


    /**
     * @url OPTIONS /refresh
     * @noAuth
    */
    public function optionsRefresh()
    {
        return ["status" =>true,'msg'=>'success'];
    }

        
    /**
     *@noAuth
     *@url POST /login
    */
    public function postLogin()
    {
        $username = $this->input->posts->username;
        $password = $this->input->posts->password;
        $user = User::where('username', $username)->first();
        // dump($username, $password, $user);
        if ($user) {
            if (password_verify($password, $user->password)) {
                $now = time();
                $remotehost = $this->server->server['REMOTE_ADDR'];
                $host = $_SERVER['HTTP_HOST'];
                $builder = new Builder();
                $builder->setIssuer($host) // Configures the issuer (iss claim)
                    ->setAudience($remotehost) // Configures the audience (aud claim)
                    ->setId(uuid(), true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt($now)
                    ->setExpiration($now + EXPTIME)
                    ->set('username', $user->username)
                    ->set('uid', $user->id)
                    ->set('role', $user->role_id)
                    ->set('level', $user->level)
                    ->sign($this->jwt->signer, APP_KEY);
                    $this->server->token = $builder->getToken()->__toString();
                    setcookie(REFTOKEN, $this->server->token, $now + EXPTIME, '/');
                    setcookie('authorised', $user->username, $now+EXPTIME, '/');
                    return [
                        'status' => true,
                        'method'=>'postLogin',
                        'user'=>$user,
                        'remotehost'=>$remotehost ,
                        'token'=> $this->server->token,
                        'msg'=> 'success',
                    ];
            } return ['status'=>false,'msg'=>'username/password not valid'];
        } else {
            throw new RestException(401, "You are not authorized to access this resource.");
        }
    }


        /**
         * @Test
         * @url GET /user
        */
    public function user()
    {
        $o = new \stdClass();
        $o->username   = $this->jwt->getJwt()->getClaim('username');
        $o->uid = $this->jwt->getJwt()->getClaim('uid');
        $o->role     = $this->jwt->getJwt()->getClaim('role');
        $o->level    = $this->jwt->getJwt()->getClaim('level');
        $o->token = $this->jwt->getJwt()->__toString();
        list($header,$payload,$signature) = explode('.', $o->token);
        $o->data = json_decode(base64_decode($payload));
        // $o->date = date(1500551216);
        $o->date = (new Carbon())->__toString();
        // $o->user = User::find(jwt->getJwt()->getClaim('uid'));
        return array('status' => 'success','data'=>$o);
    }


    public function postLogout()
    {

        setcookie(REFTOKEN, null, 0, '/');
        setcookie('authorised', null, 0, '/');
        return [
        'status' => 'success',
        'msg' => 'Logged out Successfully.'
        ];
    }

    public function tokenverify()
    {
        // dump($this->input->token);
        // dump($_COOKIE[env('USECOOKIES')]);
        if ($this->jwt) {
            return $this->jwt->tokenverify();
        } else {
            return false;
        }
    }

    protected function updateJwtcookie()
    {
        if (isset($_COOKIE['authorised'])) {
            $username = $this->token->getClaim('username');
            ( !empty($username) ? $this->setJwt($username) : null );  //change if custome
        }
    }
}
