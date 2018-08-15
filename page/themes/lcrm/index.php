<?php
$phproutes = Menu::whereNotNull('permalink')->get();
if(isset($_SESSION['url'])){
      $phpurl = $_SESSION['url'];
      $_SESSION['url'] = null;
} else {
      $phpurl = '';
}
echo '<script>
   var phproute = '.$phproutes.';
   var phpurl = "'.$phpurl.'";
</script>';
$login = $this->input->sessions->login;
if($login){ 
        require_once $this->getthemepath().'/layout/head.php';
        require_once $this->getthemepath() . '/layout/header.php';
?>
<div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 600px;" id="app">
  <!-- <print4table  /> -->
  <?php require_once $this->getthemepath() . '/layout/navbar.php'; ?>
  <aside class="right-side right-padding">
   <div ref="mainpage" class="right-content" style="width:100%">
      <router-view></router-view>
   </div>
   <?php require_once $this->getthemepath().'/layout/footer.php'; ?>
   <?php } ?>
  </aside>
        <div id="overlay" ref="overlay"  v-bind:style='$store.getters.overlaystyle'>
                <div class="preloader">
                        <div class="timer"></div>
                </div>
        </div>
</div>
<?php require_once $this->getthemepath().'/layout/foot.php'; ?>