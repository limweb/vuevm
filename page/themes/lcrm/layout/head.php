<?php 
  $app = App::where('popkey', 'APP_NAME')->first();
  $appname = $app ? $app->pop_value : 'SERVIT';
?>
<html style="min-height: 1110px;">
<head>
    <meta charset="UTF-8">
    <title>
        <?=$appname?> | <?=$this->server->url?:'Home'?>
    </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta id="token" name="token" value="<?=session_id()?>">
    <meta id="pusherKey" name="pusherKey" value="<?=session_id()?>">
    <meta id="userId" name="userId" value="1">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
    <link href="<?=$this->themeurl?>/css/libs.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->themeurl?>/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->themeurl?>/css/secure.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->themeurl?>/css/animate.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->themeurl?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?=$this->themeurl?>/css/icheck.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?=$this->themeurl?>/img/fav.ico" type="image/x-icon">
    <link rel="icon" href="<?= $this->themeurl ?>/img/fav.ico" type="image/x-icon">
    <!-- import CSS -->
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css">
    <link rel="stylesheet" href="<?=$this->themeurl?>/css/print.css">
    <style type="text/css" media="screen">
        @-webkit-keyframes a{0%{opacity:0;bottom:-15px;max-height:0;max-width:0;margin-top:0}30%{opacity:.8;bottom:-3px}to{opacity:1;bottom:0;max-height:200px;margin-top:12px;max-width:400px}}@keyframes a{0%{opacity:0;bottom:-15px;max-height:0;max-width:0;margin-top:0}30%{opacity:.8;bottom:-3px}to{opacity:1;bottom:0;max-height:200px;margin-top:12px;max-width:400px}}@-webkit-keyframes b{0%{opacity:1;bottom:0}30%{opacity:.2;bottom:-3px}to{opacity:0;bottom:-15px}}@keyframes b{0%{opacity:1;bottom:0}30%{opacity:.2;bottom:-3px}to{opacity:0;bottom:-15px}}@-webkit-keyframes c{0%{opacity:0}30%{opacity:.5}to{opacity:.6}}@keyframes c{0%{opacity:0}30%{opacity:.5}to{opacity:.6}}@-webkit-keyframes d{0%{opacity:.6}30%{opacity:.1}to{opacity:0}}@keyframes d{0%{opacity:.6}30%{opacity:.1}to{opacity:0}}.notyf__icon--alert,.notyf__icon--confirm{height:21px;width:21px;background:#fff;border-radius:50%;display:block;margin:0 auto;position:relative}.notyf__icon--alert:after,.notyf__icon--alert:before{content:"";background:#ed3d3d;display:block;position:absolute;width:3px;border-radius:3px;left:9px}.notyf__icon--alert:after{height:3px;top:14px}.notyf__icon--alert:before{height:8px;top:4px}.notyf__icon--confirm:after,.notyf__icon--confirm:before{content:"";background:#3dc763;display:block;position:absolute;width:3px;border-radius:3px}.notyf__icon--confirm:after{height:6px;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);top:9px;left:6px}.notyf__icon--confirm:before{height:11px;-webkit-transform:rotate(45deg);transform:rotate(45deg);top:5px;left:10px}.notyf__toast{display:block;overflow:hidden;-webkit-animation:a .3s forwards;animation:a .3s forwards;box-shadow:0 1px 3px 0 rgba(0,0,0,.45);position:relative;padding-right:13px}.notyf__toast.notyf--alert{background:#ed3d3d}.notyf__toast.notyf--confirm{background:#3dc763}.notyf__toast.notyf--disappear{-webkit-animation:b .3s 1 forwards;animation:b .3s 1 forwards;-webkit-animation-delay:.25s;animation-delay:.25s}.notyf__toast.notyf--disappear .notyf__message{opacity:1;-webkit-animation:b .3s 1 forwards;animation:b .3s 1 forwards;-webkit-animation-delay:.1s;animation-delay:.1s}.notyf__toast.notyf--disappear .notyf__icon{opacity:1;-webkit-animation:d .3s 1 forwards;animation:d .3s 1 forwards}.notyf__wrapper{display:table;width:100%;padding-top:20px;padding-bottom:20px;padding-right:15px;border-radius:3px}.notyf__icon{width:20%;text-align:center;font-size:1.3em;-webkit-animation:c .5s forwards;animation:c .5s forwards;-webkit-animation-delay:.25s;animation-delay:.25s}.notyf__icon,.notyf__message{display:table-cell;vertical-align:middle;opacity:0}.notyf__message{width:80%;position:relative;-webkit-animation:a .3s forwards;animation:a .3s forwards;-webkit-animation-delay:.15s;animation-delay:.15s}.notyf{position:fixed;bottom:20px;right:30px;width:20%;color:#fff;z-index:1}@media only screen and (max-width:736px){.notyf__container{width:90%;margin:0 auto;display:block;right:0;left:0}}
        [v-cloak] > * { display:none; }
        footer {
          position: fixed;
          height: 50px;
          bottom: 0;
          width: 100%;
          padding:0 10 0 10;
        }
        .is-danger {
            border-color: red;
        }

        /*PRE-LOAD ICON */

#overlay {
  opacity: .7;
  background-color: #000000;
  visibility: visible;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 9999;
  width: 100%;
  height: 100%;
  display: none;
}

.preloader {
  position: fixed;
  /* or absolute */
  top: 42%;
  left: 50%;
}


/*TIMER*/

.timer {
  z-index: 999;
  width: 29px;
  height: 29px;
  background-color: transparent;
  box-shadow: inset 0px 0px 0px 2px #fff;
  border-radius: 50%;
  position: relative;
  margin: 38px auto;
}

.timer:after, .timer:before {
  position: absolute;
  content: "";
  background-color: #fff;
}

.timer:after {
  width: 11px;
  height: 2px;
  top: 13.5px;
  left: 13.5px;
  -webkit-transform-origin: 1px 1px;
  -moz-transform-origin: 1px 1px;
  transform-origin: 1px 1px;
  -webkit-animation: minhand 2s linear infinite;
  -moz-animation: minhand 2s linear infinite;
  animation: minhand 2s linear infinite;
}

.timer:before {
  width: 10px;
  height: 2px;
  top: 13.5px;
  left: 13.5px;
  -webkit-transform-origin: 1px 1px;
  -moz-transform-origin: 1px 1px;
  transform-origin: 1px 1px;
  -webkit-animation: hrhand 8s linear infinite;
  -moz-animation: hrhand 8s linear infinite;
  animation: hrhand 8s linear infinite;
}

@-webkit-keyframes minhand {
  0% {
    -webkit-transform: rotate(0deg)
  }
  100% {
    -webkit-transform: rotate(360deg)
  }
}

@-moz-keyframes minhand {
  0% {
    -moz-transform: rotate(0deg)
  }
  100% {
    -moz-transform: rotate(360deg)
  }
}

@keyframes minhand {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

@-webkit-keyframes hrhand {
  0% {
    -webkit-transform: rotate(0deg)
  }
  100% {
    -webkit-transform: rotate(360deg)
  }
}

@-moz-keyframes hrhand {
  0% {
    -moz-transform: rotate(0deg)
  }
  100% {
    -moz-transform: rotate(360deg)
  }
}

@keyframes hrhand {
  0% {
    transform: rotate(0deg)
  }
  100% {
    transform: rotate(360deg)
  }
}

    </style>
    <script type="text/javascript">
    class Notyf {

        constructor(args) {
            this.notifications = [];
            var defaults = {
                delay: 2000,
                alertIcon: 'notyf__icon--alert',
                confirmIcon: 'notyf__icon--confirm'
            }

            if (arguments[0] && typeof arguments[0] == "object") {
                this.options = this.extendDefaults(defaults, arguments[0]);
            } else {
                this.options = defaults;
            }

            //Creates the main notifications container
            var docFrag = document.createDocumentFragment();
            var notyfContainer = document.createElement('div');
            notyfContainer.className = 'notyf';
            docFrag.appendChild(notyfContainer);
            document.body.appendChild(docFrag);
            this.container = notyfContainer;

            //Stores which transitionEnd event this browser supports
            this.animationEnd = this.animationEndSelect();


        }

        //---------- Public methods ---------------
        /**
         * Shows an alert card
         */
        alert(alertMessage) {
            var card = this.buildNotificationCard.call(this, alertMessage, this.options.alertIcon);
            card.className += ' notyf--alert';
            this.container.appendChild(card);
            this.notifications.push(card);
        }


        /**
         * Creates a generic card with the param message. Returns a document fragment.
         */
         buildNotificationCard(messageText, iconClass) {
            //Card wrapper
            var notification = document.createElement('div');
            notification.className = 'notyf__toast';

            var wrapper = document.createElement('div');
            wrapper.className = 'notyf__wrapper';

            var iconContainer = document.createElement('div');
            iconContainer.className = 'notyf__icon';

            var icon = document.createElement('i');
            icon.className = iconClass;

            var message = document.createElement('div');
            message.className = 'notyf__message';
            message.innerHTML = messageText;

            //Build the card
            iconContainer.appendChild(icon);
            wrapper.appendChild(iconContainer);
            wrapper.appendChild(message);
            notification.appendChild(wrapper);

            var _this = this;
            setTimeout(function() {
                notification.className += " notyf--disappear";
                notification.addEventListener(_this.animationEnd, function(event) {
                    event.target == notification && _this.container.removeChild(notification);
                });
                var index = _this.notifications.indexOf(notification);
                _this.notifications.splice(index, 1);
            }, _this.options.delay);

            return notification;
        }

        // Determine which animationend event is supported
        animationEndSelect() {
            var t;
            var el = document.createElement('fake');
            var transitions = {
                'transition': 'animationend',
                'OTransition': 'oAnimationEnd',
                'MozTransition': 'animationend',
                'WebkitTransition': 'webkitAnimationEnd'
            }

            for (t in transitions) {
                if (el.style[t] !== undefined) {
                    return transitions[t];
                }
            }
        }

        //---------- Private methods ---------------

        /**
         * Populates the source object with the value from the same keys found in destination
         */
        extendDefaults(source, destination) {
            // console.log('bf',source);
            for (source.property in destination) {
                console.log(source.property);
                //Avoid asigning inherited properties of destination, only asign to source the destination own properties
                if (destination.hasOwnProperty(source.property)) {
                    source[source.property] = destination[source.property];
                }
            }
            // console.log('af',source);
            return source;
        }

        /**
         * Shows a confirm card
         */
        confirm(alertMessage) {
            var card = this.buildNotificationCard.call(this, alertMessage, this.options.confirmIcon);
            card.className += ' notyf--confirm';
            this.container.appendChild(card);
            this.notifications.push(card);
        }
    }
  </script>
    <!-- <script src="/jslibs/dist/vendor.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-polyfill/6.26.0/polyfill.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/vue@2.5.13/dist/vue.js"></script>
    <script type="text/javascript" src="https://unpkg.com/vue-router@3.0.1/dist/vue-router.js"></script>
    <script type="text/javascript" src="https://unpkg.com/vuex"></script>
    <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/vuejs-paginate@latest"></script>
    <script type="text/javascript" src="https://unpkg.com/vee-validate@2.0.0/dist/vee-validate.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/element-ui"></script>
    <script type="text/javascript" src="https://unpkg.com/element-ui/lib/umd/locale/th.js"></script>
    <script type="text/javascript" src="https://unpkg.com/vue-ls@2.3.3/dist/vue-ls.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/moment@2.20.1/moment.js"></script>
    
    <!-- <script type="text/javascript" src="https://unpkg.com/vue-i18n@7.3.3/dist/vue-i18n.js"></script> -->
    <!-- <script type="text/javascript" src="https://unpkg.com/vue-resource/dist/vue-resource.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.min.js"></script>
    <!-- <script type="text/javascript" src="https://unpkg.com/element-ui/lib/umd/locale/en.js"></script> -->
    <!-- <script type="text/javascript" src="https://unpkg.com/vue2-filters@0.2.2/dist/vue2-filters.min.js"></script> -->
    <script type="text/javascript" src="https://unpkg.com/downloadjs@1.4.7/download.js"></script>
    <script type="text/javascript" src="<?=$this->themeurl?>/js/vue2-filters.js"></script>
    
<script>
//   ELEMENT.locale(ELEMENT.lang.en)
  ELEMENT.locale(ELEMENT.lang.th)
</script>
</head>
<body class=" DejaVue  pace-done " style="min-height: 1110px;" >
   <!-- <div class="pace  pace-inactive noprint">
      <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
         <div class="pace-progress-inner">
         </div>
      </div>
      <div class="pace-activity">
      </div>
   </div>
   <div class="pace  pace-inactive noprint">
      <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
         <div class="pace-progress-inner">
         </div>
      </div>
      <div class="pace-activity">
      </div>
   </div>
   <div class="pace  pace-inactiven oprint noprint">
      <div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
         <div class="pace-progress-inner">
         </div>
      </div>
      <div class="pace-activity">
      </div>
   </div> -->