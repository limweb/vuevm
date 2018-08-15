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
use \Curl\Curl;

class Auth2Controller extends BaseController
{

    /**
     *@noAuth
     *@url POST /register
     */
    public function register()
    {
        $u = User::where('username', $this->input->posts->username)->orwhere('email', $this->input->posts->username)->first();
        if ($u) {
            return ['db'=>false,'user'=>'','status'=>true ,'msg'=>'user Dupicated' ];
        } else {
            $u = new User();
            $u->email = $this->input->posts->username;
            $u->username = $this->input->posts->username;
            $u->password = password_hash($this->input->posts->password, PASSWORD_BCRYPT);
            $u->save();
            return ['db'=>true,'user'=>$u,'status'=>true ,'msg'=>'created user successed' ];
        }
    }


    /**
     *@noAuth
     *@url POST /auth
     */
    public function auth()
    {
        $password = $this->input->posts->password;
        $username = $this->input->posts->username;
        $user = User::where('username', $username)->first();
        $token = '';
        if ($user) {
            if (password_verify($password, $user->password)) {
                if ($user->ref_token) {
                    $token = $user->ref_token;
                } else {
                    $signer = new Sha256();
                    $remotehost = $_SERVER['REMOTE_ADDR'];
                    $host = $_SERVER['HTTP_HOST'];
                    $now = time();
                    $exp = (int)(EXPTIME) ;
                    $expiretime = $now + $exp;
                    if ($user->expire_date) {
                        $dt = new Carbon();
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $user->expire_date);
                        $expiretime = $now + $dt->diffInSeconds($to);
                    }
                    $builder = new Builder();
                    $builder->setIssuer($host) // Configures the issuer (iss claim)
                    ->setAudience($remotehost) // Configures the audience (aud claim)
                    ->setId(uuid(), true) // Configures the id (jti claim), replicating as a header item
                    ->setIssuedAt($now)
                    ->setExpiration($expiretime)
                    ->set('username', $user->username)
                    ->set('uid', $user->id)
                    ->set('role', $user->role_id)
                    ->set('level', $user->level)
                    ->sign($signer, APP_KEY);
                    $user->ref_token = $builder->getToken()->__toString();
                    $user->expire_date = Carbon::now()->addDays(7);  //expire in 7 days
                    $user->save();
                    $token =$user->ref_token;
                }
                return ['status'=>true,'user'=>$user,'token'=> $token,'msg'=>'auth successed'];
            }
            return ['status'=>false,'user'=>'','token'=> $token,'msg'=>'password not valid'];
        }
        return ['status'=>false,'user'=>'','token'=> $token,'msg'=>'not auth'];
    }


    /**
     *@url POST /refresh
     */
    public function refresh()
    {
        // dump($this->input->token);
        $user = User::where('ref_token', $this->input->token)->first();
        $access_token = '';
        if ($user) {
                $signer = new Sha256();
                $remotehost = $_SERVER['REMOTE_ADDR'];
                $host = $_SERVER['HTTP_HOST'];
                $now = time();
                $builder = new Builder();
                $builder->setIssuer($host) // Configures the issuer (iss claim)
                ->setAudience($remotehost) // Configures the audience (aud claim)
                ->setId(uuid(), true) // Configures the id (jti claim), replicating as a header item
                ->setIssuedAt($now)
                ->setExpiration($now + 60)
                ->set('username', $user->username)
                ->set('uid', $user->id)
                ->set('level', $user->level)
                ->set('role', $user->role_id)
                ->sign($signer, APP_KEY);
                $access_token = $builder->getToken()->__toString();
            return ['acces_token'=>$access_token,'status'=>true];
        } else {
            return ['acces_token'=>'','status'=>false ,'msg'=>'no user for this token'];
        }
    }


    /**
     *@url POST  /jwtlogout
     */
    public function logout()
    {
        $token = $this->input->token;
        $msg = 'you logouted';
        if ($token) {
            $user = User::where('ref_token', $token)->first();
            if ($user) {
                    $user->ref_token = null;
                    $user->expire_date = null;
                    $user->save();
                    $msg = 'logout successed';
                return ['status'=>true,'msg'=>$msg];
            }
            return ['status'=>false,'msg'=>'user not match'];
        }
        return ['status'=>true,'msg'=>$msg];
    }

    /**
     *@noAuth
     *@url POST /logout
     */
    public function logoutauth()
    {
        $username  = $this->input->posts->username;
        $password  = $this->input->posts->password;
        $user = User::where('username', $username)->first();
        if ($user) {
            if (password_verify($password, $user->password)) {
                $user->ref_token = null;
                $user->expire_date = null;
                $user->save();
                // dump(toObj($user->toArray()));
                return ['status'=>true,'msg'=>'logout seccessed.'];
            } else {
                return ['status'=>false,'msg'=>'username / password not valid.'];
            }
        } else {
            return ['status'=>false,'msg'=>'username / password not valid'];
        }
    }


    /**
     *@noAuth
     *@url POST /revoke
     *@Desc ไว้แถน refresh token ออกจาก database
     */
    public function revoke()
    {

        $token = $this->input->token;
        $msg = 'no token';
        if ($token) {
            $user = User::where('ref_token', $token)->first();
            if ($user) {
                $user->ref_token = null;
                $user->expire_date = null;
                $user->save();
                $msg = 'revoke successed';
                return ['status'=>true,'msg'=>$msg];
            } else {
                return ['status'=>true,'msg'=>'no match with user'];
            }
        }
        return ['status'=>false,'msg'=>'no token'];
    }


    /**
     *@url POST /microservice1
     */
    public function service1()
    {
        echo 'microservice1';
    }

    /**
     *@url POST /microservice2
     */
    public function service2()
    {
        echo 'microservice2';
    }

    /**
     *@url POST /microservice3
     */
    public function service3()
    {
        echo 'microservice3';
    }
}
