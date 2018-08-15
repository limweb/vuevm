<?php
use \Servit\Restsrv\RestServer\RestException;
use \Servit\Restsrv\RestServer\RestController as BaseController;
use Illuminate\Database\Capsule\Manager as Capsule;

// Authen by SESSION DEFAULT
class AuthController extends BaseController
{


    /**
    *@url GET /logout/
    */
    public function logout()
    {
        $_SESSION['user'] = null;
        echo 'Logout sessessed';
    }

    /**
    *@noAuth
    *@url GET /register/
    */
    public function getRegister()
    {
        $regfrm ='<form action="/api/v1/auth/register" method="post"> <br/><br/><br/> <div class="container"><center> <b> Register Form</b> <hr/> <table> <tbody> <tr> <td><label><b>Email</b></label></td><td><input type="text" placeholder="Enter Email" name="email" required></td><td></td></tr><tr> <td><label><b>Password</b></label></td><td><input type="password" placeholder="Enter Password" name="password" required></td><td></td></tr><tr> <td><label><b>Repeat Password</b></label></td><td><input type="password" placeholder="Repeat Password" name="password-repeat" required></td><td><input type="checkbox" checked="checked"> Remember me</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr> <td><button type="button" class="cancelbtn">Cancel</button></td><td><button type="submit" class="signupbtn">Register</button></td></tr></tbody> </table> <hr/> </center> </div></form>';
        echo (APPMODE == 'debug' ? $regfrm : null );
    }

    /**
    *@noAuth
    *@url POST /register/
    */
    public function postRegister()
    {
        if ($this->input->posts->password ==  $this->input->posts->{'password-repeat'}) {
            $u = User::where('username', $this->input->posts->email)->orwhere('email', $this->input->posts->email)->first();
            if ($u) {
                return ['db'=>false,'user'=>'','status'=>true ,'msg'=>'user Dupicated' ];
            } else {
                $u = new User();
                $u->email = $this->input->posts->email;
                $u->username = $this->input->posts->email;
                $u->password = password_hash($this->input->posts->password, PASSWORD_BCRYPT);
                $u->save();
                return ['db'=>true,'user'=>$u,'status'=>true ,'msg'=>'created user successed' ];
            }
        } else {
            return ['db'=>false,'user'=>'','status'=>false,'msg'=>'Password not Match' ];
        }
    }


    /**
    *@noAuth
    *@url GET /signin/
    */
    public function loginfrm()
    {
        $loginfrm =  '<form action="/api/v1/auth/signin" method="post"> <br/><br/><br/> <div class="container"><center> <b> SignIn Form</b> <hr/> <table> <tbody> <tr> <td><label><b>Email</b></label></td><td><input type="text" placeholder="Enter Email" name="email" required></td><td></td></tr><tr> <td><label><b>Password</b></label></td><td><input type="password" placeholder="Enter Password" name="password" required></td><td></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr> <td><button type="button" class="cancelbtn">Cancel</button></td><td><button type="submit" class="signupbtn">SignIn</button></td></tr></tbody> </table> <hr/> </center> </div></form>';
        echo (APPMODE == 'debug' ? $loginfrm:null);
    }


    /**
    *@noAuth
    *@url POST /signin/
    */
    public function signin()
    {
        $email = $this->input->posts->email;
        $password = $this->input->posts->password;
        $u = User::where('username', $email)->first();
        if ($u) {
            if (password_verify($password, $u->password)) {
                $_SESSION['user'] = $u->toArray();
                return ['status'=>true,'user'=>$u,'msg'=>'login successed'];
            } else {
                return ['status'=> false,'msg'=>'Password not Match'];
            }
        } else {
            return ['status'=> false,'msg'=>'No User In System'];
        }
    }
        

    /**
    *@url GET /signout/
    */
    public function signout()
    {
        $_SESSION['user'] = null;
        return ['status'=>true ,'msg'=>'Logout sessessed'];
    }
}
