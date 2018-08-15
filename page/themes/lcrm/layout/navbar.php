      <aside class="noprint left-side sidebar-offcanvas  " style="min-height: 1110px;">
         <!-- sidebar: style can be found in sidebar-->
         <section class="sidebar">
            <div id="menu" role="navigation">
               <!-- / .navigation -->
               <div class="nav_profile">
                  <div class="media profile-left">
                     <a class="pull-left profile-thumb" href="#">
                     <img src="<?= $this->themeurl ?>/img/hK0DqCD1Mm.jpg" alt="img" class="img-rounded">
                     </a>
                     <div class="content-profile">
                        <h4 class="media-heading">MongKol(มงคล)</h4><br/><br/>
                        <!-- <ul class="icon-list">
                           <li>
                              <a href="/mailbox#/m/inbox" title="Email">
                              <i class="fa fa-fw fa-envelope">
                              </i>
                              </a>
                           </li>
                           <li>
                              <a href="/sales_order" title="Sales Order">
                              <i class="fa fa-fw fa-usd">
                              </i>
                              </a>
                           </li>
                           <li>
                              <a href="/invoice" title="Invoices">
                              <i class="fa fa-fw fa-file-text">
                              </i>
                              </a>
                           </li>
                           <li>
                              <a href="/setting" title="Settings">
                              <i class="fa fa-fw fa-cog">
                              </i>
                              </a>
                           </li>
                        </ul> -->
                     </div>
                  </div>
               </div>
               <ul class="navigation">

<?php
         $leftmenus = Menu::where('status',1)
         ->where('parent_id',0)
         ->where('group',1)
         ->where('menu_position','LEFTSIDEBAR')->orderBy('sort','asc')->get();
         sidebarmenu($leftmenus);
?>
<h4 class="text-white mar-5 border-b">
Configuration
</h4>
<?php
         $leftmenus = Menu::where('status',1)
         ->where('parent_id',0)
         ->where('group',2)
         ->where('menu_position','LEFTSIDEBAR')->orderBy('sort','asc')->get();
         sidebarmenu($leftmenus);
?>
            </ul>
            </div>
            <!-- menu -->
         </section>
         <!-- /.sidebar -->
      </aside>

<?php

function sidebarmenu($menus) {
   foreach ($menus as $menu) {
            echo '<li><router-link to="/'.($menu->permalink?:'noroute').'">';
            echo ($menu->menuitems->count() ? '<span class="nav-caret pull-right"><i class="fa fa-caret-down"></i></span>':'');
               echo '<span class="nav-icon">
                     <i class="'.($menu->classname?:'').'">'.($menu->icon_class?:'').'</i>
                  </span>
                  <span class="nav-text">'.$menu->label.'</span>
               </router-link>';
               // dump($menu->menuitems->count());
            if($menu->menuitems->count()){
                  echo '<ul class="nav-sub collapse" aria-expanded="false">';
                  foreach ($menu->menuitems as $menuitem) {
                     echo '<li>
                              <router-link to="/'.($menuitem->permalink?:'#').'">
                                 <span class="nav-icon">
                                    <i class="'.($menuitem->classname?:'').'">'.($menuitem->icon_class?:'').'</i>
                                 </span>
                                 <span class="nav-text">'.$menuitem->label.'</span>
                              </router-link>
                        </li>';
                  }
                   echo '</ul>';
            }   
         echo '</li>';
   }
}