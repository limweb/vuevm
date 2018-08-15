   <!-- <script nomodule  src="/dist/lcrm.js"></script> -->
   <script type="module" /src="<?= $this->themeurl ?>/app.js"></script>
   <script nomodule type="text/javascript" src="/page/themes/lcrm/dist/lcrm.js"></script>


   <script type="text/javascript" src="<?= $this->themeurl ?>/js/libs.js" ></script>
   <script type="text/javascript" src="<?= $this->themeurl ?>/js/metisMenu.min.js" ></script>
   <script type="text/javascript" src="<?= $this->themeurl ?>/js/lcrm_app.js" ></script>
   <!-- <script type="text/javascript" src="/js/secure.js" ></script> -->
   <!-- <script type="text/javascript" src="/js/icheck.min.js" ></script> -->
   </div><!-- vue app -->
   <script type="module">
        console.log('yourbrowser support ------------------- type = module');
    </script>
   <script nomodule>
        console.log('yourbrowser not support ------------------- type = module');
   </script>
</body>
</html>