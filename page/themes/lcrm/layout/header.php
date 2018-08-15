   <header class="noprint header">
      <nav class="navbar navbar-static-top navbar-fixed-top" role="navigation">
         <a href="/" class="logo">
         <img   src="<?= $this->themeurl ?>/img/mongkollogo.png" alt="dsla" class="img-responsive" style="margin:auto;width:80px;height:50px;background-color:white">
         </a>
         <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
            <i class="fa fa-fw fa-navicon">
            </i>
            </a>
         </div>
         <div class="navbar-right">
            <ul class="nav navbar-nav">
               <li class="dropdown messages-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-fw fa-envelope-o black">
                  </i>
                  </a>
                  <ul class="dropdown-menu dropdown-messages table-striped">
                     <li class="dropdown-title">
                        You have 0 new emails.
                     </li>
                     <li class="dropdown-footer">
                        <router-link to="/mailbox#/m/inbox"></router-link>
                        View Messages</a>
                     </li>
                  </ul>
               </li>
               <li class="dropdown notifications-menu">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-fw fa-bell-o black1">
                  </i>
                  </a>
                  <ul class="dropdown-menu dropdown-messages">
                     <li class="dropdown-title">
                        You have 0 notifications
                     </li>
                     <li class="dropdown-footer">
                     </li>
                  </ul>
               </li>
               <li class="dropdown user user-menu">
                  <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown" aria-expanded="false">
                     <img src="<?= $this->themeurl ?>/img/hK0DqCD1Mm.jpg" alt="img" class="img-circle img-responsive pull-left" height="35" width="50">
                     <div class="riot">
                        <div>
                          MongKol
                           <span>
                           <i class="caret">
                           </i>
                           </span>
                        </div>
                     </div>
                  </a>
                  <ul class="dropdown-menu">
                     <!-- User image -->
                     <li class="user-header">
                        <img src="<?= $this->themeurl ?>/img/hK0DqCD1Mm.jpg" alt="img" class="img-circle img-bor">
                        <p>
                          MongKol
                        </p>
                     </li>
                     <!-- Menu Body -->
                     <li class="pad-3">
                        <router-link to="/profile">
                            <i class="fa fa-fw fa-user"></i>
                            My Profile
                        </router-link>
                     </li>
                     <li role="presentation">
                     </li>
                     <li role="presentation" class="divider">
                     </li>
                     <!-- Menu Footer-->
                     <li class="user-footer">
                        <div class="pull-right">
                           <a href="/logout" class="text-danger">
                           <i class="fa fa-fw fa-sign-out">
                           </i>
                           Logout
                           </a>
                        </div>
                     </li>
                  </ul>
               </li>
            </ul>
         </div>
      </nav>
   </header>