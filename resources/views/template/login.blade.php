<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="description" content="bootstrap material admin template">
      <meta name="author" content="">
      <title>Login</title>
      <link rel="apple-touch-icon" href="{{asset('assets/files/images/apple-touch-icon.png')}}">
      <link rel="shortcut icon" href="{{asset('assets/files/images/favicon.ico')}}">
      <link rel="stylesheet" href="{{asset('assets/css/bootstrap.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/css/bootstrap-extend.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/files/css/site.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/css/skintools.minfd53.css?v4.0.1')}}">
      <script src="{{asset('assets/files/js/Plugin/skintools.minfd53.js?v4.0.1')}}"></script>
      <link rel="stylesheet" href="{{asset('assets/vendor/animsition/animsition.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/asscrollable/asScrollable.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/switchery/switchery.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/intro-js/introjs.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/slidepanel/slidePanel.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/flag-icon-css/flag-icon.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/waves/waves.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/files/examples/css/pages/login-v3.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/fonts/material-design/material-design.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/fonts/brand-icons/brand-icons.minfd53.css?v4.0.1')}}">
      <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,700')}}">
      <link rel='stylesheet' href="{{asset('assets/css/sweetalert.css')}}">
      <script src="{{asset('assets/vendor/breakpoints/breakpoints.minfd53.js?v4.0.1')}}"></script>
      <script>
         Breakpoints();
      </script>
   </head>
   <body class="animsition page-login-v3 layout-full">
      <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
         >
         <div class="page-content vertical-align-middle">
            <div class="panel">
               <div class="panel-body">
                  <div class="brand">
                     <img class="brand-img" src="{{asset('assets/files/images/logo-colored.png')}}" alt="...">
                     <h2 class="brand-text font-size-18">Bussiness ERP</h2>
                  </div>
                  <form method="post" action="#" autocomplete="off" novalidate>
                     <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="email" class="form-control" name="email" id="email" value="" />
                        <label class="floating-label">Email</label>
                     </div>
                     <div class="form-group form-material floating" data-plugin="formMaterial">
                        <input type="password" class="form-control" name="password" id="password" value="" />
                        <label class="floating-label">Password</label>
                     </div>
                     <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                        <input type="checkbox" id="inputCheckbox" name="remember">
                        <label for="inputCheckbox">Remember me</label>
                     </div>
                     <a href="javascript:void(0)" class="btn btn-primary btn-block btn-lg mt-30" onclick="check_login();" style="margin-left: 0px !important;">Login</a>
               </div>
               </form>
            </div>
         </div>
      </div>
      </div>
      <script src="{{asset('assets/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/jquery/jquery.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/popper-js/umd/popper.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/bootstrap.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/animsition/animsition.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/mousewheel/jquery.mousewheel.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/asscrollbar/jquery-asScrollbar.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/asscrollable/jquery-asScrollable.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/ashoverscroll/jquery-asHoverScroll.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/waves/waves.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/switchery/switchery.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/intro-js/intro.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/screenfull/screenfull.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/slidepanel/jquery-slidePanel.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/jquery-placeholder/jquery.placeholder.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/State.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Component.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Base.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Config.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/Section/Menubar.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/Section/GridMenu.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/Section/Sidebar.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/Section/PageAside.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/Plugin/menu.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/config/colors.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/js/config/tour.minfd53.js?v4.0.1')}}"></script>
      <script>
         Config.set('assets', '{{asset("/assets")}}');
      </script>
      <script src="{{asset('assets/files/js/Site.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/asscrollable.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/slidepanel.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/switchery.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/jquery-placeholder.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/material.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/sweetalert.js')}}"></script>
      <script src="{{asset('assets/js/select2.js')}}"></script>
      <script>
        function IsEmail(email)
        {
          var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if(!regex.test(email))
          {
            return false;
          }
          else
          {
            return true;
          }
        }
         (function(document, window, $) {
           'use strict';
         
           var Site = window.Site;
           $(document).ready(function() {
             Site.run();
           });
         })(document, window, jQuery);
      </script>
      <script>
         (function(i, s, o, g, r, a, m) {
           i['GoogleAnalyticsObject'] = r;
           i[r] = i[r] || function() {
             (i[r].q = i[r].q || []).push(arguments)
           }, i[r].l = 1 * new Date();
           a = s.createElement(o),
             m = s.getElementsByTagName(o)[0];
           a.async = 1;
           a.src = g;
           m.parentNode.insertBefore(a, m)
         })(window, document, 'script', '../../../../../www.google-analytics.com/analytics.js',
           'ga');
         
         ga('create', 'UA-65522665-1', 'auto');
         ga('send', 'pageview');
         
         
         
         let request = 0;
         function check_login()
         {
         var email = $("#email").val();
         var password = $("#password").val();
         if(IsEmail(email)==true && password !="")
         {
          if(request==0)
          {
            $.ajax({
              type: "POST",
              url: "{{url('/')}}/api/validateLogin",
              data: {"email" : email,"password" : password},
              dataType : 'json',
              success: function (msg)
              {
                if(msg.code==200)
                {
                  swal({
                    title: "Successfully Loged In",
                    text: "",
                    type: "success",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "OK",
                    closeOnConfirm: true
                    }, function () {
                      request=0;
                      window.location.href = "{{url('/dashboard')}}";
                  });
                }
                else
                {
                  swal({
                    
                    title: "Login failed",
                    text: "Please check details",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "OK",
                    closeOnConfirm: true
                    }, function () {
         
                      request=0;
                  });
                }
              }
            });
          }
         }
         else
         {
          swal({
          title: "Invalid login",
          text: "Please check",
          type: "warning",
          showCancelButton: false,
          confirmButtonClass: "btn-success",
          confirmButtonText: "OK",
          closeOnConfirm: true
          }, function () {
            request=0;
          });
         }
         
         }
      </script>
   </body>
</html>