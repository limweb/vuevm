<?php
use \Servit\Restsrv\RestServer\RestException;
use Servit\Restsrv\RestServer\ThemeController;
use \Servit\Restsrv\Libs\Request;

class LcrmController extends RootThemeController
{
    
    
    
    /**
     *@noAuth
     *@url GET /
     *@url GET /home
     */
    public function admin()
    {
        $login = $_SESSION['login'];
        if($login){
            include_once __DIR__.'/../../page/themes/lcrm/index.php';
        } else {
            Header('Location: /login');
        }
    }
    
    
    
    
    /**
     *@noAuth
     *@url GET /login/
     */
    public function login(){
$html = <<<HTML
 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 signin-form">
                <div class="panel-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="text-center">
                                <!-- brand -->
                                <img style="width: 225px;background-color:red" src="/page/themes/lcrm/img/mongkollogo.png" alt="LCRM">
                                <!-- / brand -->
                            </h2>
                        </div>
                    </div>
                </div>
                                    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="box-color">
                    <h4>Sign in with your Account</h4>
                    <br>
                    <form method="POST" action="/login" accept-charset="UTF-8" name="form"><input name="_token" type="hidden" value="O3aKTioElVKHMHuZ2b1S68wrQeI7fxiOOK7dCNAa">
                    <div class="form-group ">
                        <label for="E-Mail Address">E-Mail Address</label> :
                        <span></span>
                        <input class="form-control" required="required" placeholder="E-mail" name="email" type="email"  value="admin@crm.com" >
                    </div>
                    <div class="form-group ">
                        <label for="Password">Password</label> :
                        <span></span>
                        <input class="form-control" required="required" placeholder="Password" name="password" type="password" value="admin">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" id="remember" value="remember" name="remember">
                            <i class="primary"></i> Keep me signed in
                        </label>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                    </form>
                </div>
                <hr class="separator">
                <div class="text-center">
                    <h5><a href="/forgot" class="forgot_pw _600">Forgot Password?</a></h5>
                </div>
            </div>
        </div>
    </div>

            </div>
        </div>
    </div>
</div> 
HTML;
    require_once $this->getthemepath().'/layout/head.php';
    // require_once $this->getthemepath() . '/layout/header.php';
    echo $html;
    require_once $this->getthemepath().'/layout/footer.php';
        
    }
    
    /**
     *@noAuth
     *@url POST /login/
     */
    public function logined(){
        $_SESSION['login'] = 1;
        Header('Location: /home');
    }
    
    /**
     *@noAuth
     *@url GET /logout/
     */
    public function logout(){
        $_SESSION['login'] = null;
        Header('Location: /login');
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
