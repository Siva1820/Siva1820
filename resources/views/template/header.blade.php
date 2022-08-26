<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta name="description" content="bootstrap material admin template">
      <meta name="author" content="">
      <title>Bussines ERP</title>
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
      <link rel="stylesheet" href="{{asset('assets/vendor/chartist/chartist.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/jvectormap/jquery-jvectormap.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/files/examples/css/dashboard/v1.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/fonts/material-design/material-design.minfd53.css?v4.0.1')}}">
      <link rel="stylesheet" href="{{asset('assets/fonts/brand-icons/brand-icons.minfd53.css?v4.0.1')}}">
      <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:400,400italic,700')}}">
      <link rel='stylesheet' href="{{asset('assets/css/datatable.css')}}">
      <link rel='stylesheet' href="{{asset('assets/css/select2.css')}}">
      <link rel='stylesheet' href="{{asset('assets/css/sweetalert.css')}}">
      <script src="{{asset('assets/js/jquery.js')}}"></script>
      <script src="{{asset('assets/vendor/breakpoints/breakpoints.minfd53.js?v4.0.1')}}"></script>
      <script>
         Breakpoints();
      </script>
      <script src="https://kit.fontawesome.com/8f8400b4ec.js" crossorigin="anonymous"></script>
      @stack('styles')
      <style type="text/css">
         .error-text
         {
         margin-top: 8px;
         font-size: 12px;
         color: #f3380e; 
         }
         .dataTables_processing
         {
         color: white !important;
         height: 50px !important;
         background: #3f51b5e6 !important;
         }
         ::-webkit-scrollbar 
         {
         height: 7px;
         width: 7px;
         border: 0px solid #d5d5d5;
         color: #8787e1;
         background: #3f51b5;
         border-radius: 10px;
         cursor: pointer;
         }
         .cs-menu
         {
         text-decoration: none !important;
         color: black !important;
         }
         .site-skintools-toggle
         {
         display: none;
         }
         .status-0
         {
         background: #eba044;
         color: white;
         padding: 0.6rem;
         border-radius: 20px;
         text-align: center;
         width: 57% !important;
         }
         .status-1
         {
         background: #32b761;
         color: white;
         padding: 0.6rem;
         border-radius: 20px;
         text-align: center;
         width: 57% !important;
         }
      </style>
   </head>
   <body class="animsition dashboard">
      <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
         <div class="navbar-header">
            <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
               data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
            </button>
            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
               data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
            </button>
            <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
               <img class="navbar-brand-logo" src="{{asset('assets/files/images/logo.png')}}" title="Remark">
               <span class="navbar-brand-text hidden-xs-down"> Remark</span>
            </div>
         </div>
         <div class="navbar-container container-fluid">
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
               <ul class="nav navbar-toolbar">
                  <li class="nav-item hidden-float" id="toggleMenubar">
                     <a class="nav-link" data-toggle="menubar" href="#" role="button">
                     <i class="icon hamburger hamburger-arrow-left">
                     <span class="sr-only">Toggle menubar</span>
                     <span class="hamburger-bar"></span>
                     </i>
                     </a>
                  </li>
                  <li class="nav-item dropdown dropdown-fw dropdown-mega">
                     <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false" data-animation="fade"
                        role="button">SETTINGS</a>
                     <div class="dropdown-menu" role="menu">
                        <div class="mega-content">
                           <div class="row">
                              <div class="col-md-12">
                                 <h5>Master</h5>
                                 <ul class="blocks-3">
                                    <li class="mega-menu m-0">
                                       <ul class="list-icons">
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/config">Config</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/uom">UOM</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/department">Department</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/expensetype">Expense Type</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/customercategory">Customer Category</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/company">Company</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/branch">Branch</a>
                                          </li>
                                       </ul>
                                    </li>
                                    <li class="mega-menu m-0">
                                       <ul class="list-icons">
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/employeerole">Employee Desigination</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/terms">Terms And Condition</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/idproof">ID Proof</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/taxtype">Tax Type</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/employee">Employee</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/supplier">Supplier</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/customer">Customer</a>
                                          </li>
                                       </ul>
                                    </li>
                                    <li class="mega-menu m-0">
                                       <ul class="list-icons">
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/tax">Tax</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/itemcategory">Item Category</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/item">Item</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/warehouse">Warehouse</a>
                                          </li>
                                          <li>
                                             <i class="md-chevron-right" aria-hidden="true"></i>
                                             <a class="cs-menu" href="{{url('/')}}/user">User</a>
                                          </li>
                                       </ul>
                                    </li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </li>
               </ul>
               <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                  <li class="nav-item dropdown">
                     <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                        data-animation="scale-up" role="button">
                     <span class="avatar avatar-online">
                     <img src="{{asset('assets/portraits/5.jpg')}}" alt="...">
                     <i></i>
                     </span>
                     </a>
                     <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-settings" aria-hidden="true"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:void(0)" role="menuitem" onclick="logout();"><i class="icon md-power" aria-hidden="true"></i> Logout</a>
                     </div>
                  </li>
               </ul>
            </div>
            <div class="collapse navbar-search-overlap" id="site-navbar-search">
               <form role="search">
                  <div class="form-group">
                     <div class="input-search">
                        <i class="input-search-icon md-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon md-close" data-target="#site-navbar-search"
                           data-toggle="collapse" aria-label="Close"></button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </nav>
      <div class="site-menubar site-menubar-light">
         <div class="site-menubar-body">
            <div>
               <div>
                  <ul class="site-menu" data-plugin="menu">
                     <li class="site-menu-category">General</li>
                     <li class="site-menu-item active">
                        <a href="{{url('/')}}">
                        <i class="site-menu-icon md-view-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                        </a>
                     </li>
                     <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Entry</span>
                        <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/manualstock">
                              <span class="site-menu-title">Manualstock</span>
                              </a>
                           </li>
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/purchaseorder">
                              <span class="site-menu-title">Purchase Order</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)">
                        <i class="site-menu-icon md-google-pages" aria-hidden="true"></i>
                        <span class="site-menu-title">Purchase Master</span>
                        <span class="site-menu-arrow"></span>
                        </a>
                        <ul class="site-menu-sub">
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/paymentterms">
                              <span class="site-menu-title">Payment Terms</span>
                              </a>
                           </li>
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/shipping">
                              <span class="site-menu-title">Shipping</span>
                              </a>
                           </li>
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/freightterms">
                              <span class="site-menu-title">Freight Terms</span>
                              </a>
                           </li>
                           <li class="site-menu-item has-sub">
                              <a href="{{url('/')}}/fob">
                              <span class="site-menu-title">FOB</span>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="site-menubar-footer">
            <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
               data-original-title="Settings">
            <span class="icon md-settings" aria-hidden="true"></span>
            </a>
            <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
            <span class="icon md-eye-off" aria-hidden="true"></span>
            </a>
            <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon md-power" aria-hidden="true"></span>
            </a>
         </div>
      </div>
      @yield('content')
      <footer class="site-footer">
         <div class="site-footer-legal">© 2022 <a href="javascript:void(0)">Staarsoft</a></div>
         <div class="site-footer-right">
         </div>
      </footer>
      </script><script src="{{asset('assets/vendor/babel-external-helpers/babel-external-helpersfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/jquery/jquery.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/popper-js/umd/popper.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/bootstrap/bootstrap.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/animsition/animsition.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/mousewheel/jquery.mousewheel.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/asscrollbar/jquery-asScrollbar.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/asscrollable/jquery-asScrollable.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/ashoverscroll/jquery-asHoverScroll.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/waves/waves.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/datatable.js')}}"></script>
      <script src="{{asset('assets/js/select2.js')}}"></script>
      <script src="{{asset('assets/js/sweetalert.js')}}"></script>
      <script src="{{asset('assets/vendor/switchery/switchery.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/intro-js/intro.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/screenfull/screenfull.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/slidepanel/jquery-slidePanel.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/jvectormap/jquery-jvectormap.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/jvectormap/maps/jquery-jvectormap-world-mill-enfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/matchheight/jquery.matchHeight-minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/vendor/peity/jquery.peity.minfd53.js?v4.0.1')}}"></script>
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
      <script src="{{asset('assets/js/Plugin/matchheight.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/jvectormap.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/js/Plugin/peity.minfd53.js?v4.0.1')}}"></script>
      <script src="{{asset('assets/files/examples/js/dashboard/v1.minfd53.js?v4.0.1')}}"></script>
      <script type="text/javascript">
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
         function is_form_valid(form_name)
         {
           var error_count = 0;
           $(".error-text").remove();
           $("#"+form_name+" :required").each(function(){
         
              var type  = $(this).attr("type");
              var name  = $(this).attr("name");
              var value = $(this).val();
              var label = $(this).prev('label').text();
         
              if((value =="" || value ==" ") && type !="email")
              {
                 error_count++;
                 $(this).after('<p class="error-text">Provide Valid '+label+'.</p>');
              }
         
              if(type=="email")
              {
                 if(IsEmail(value)==false)
                 {
                    error_count++;
                    $(this).after('<p class="error-text">Provide Valid '+label+'.</p>');
                 }
              }
         
              if(name=="mobile" && value !="" && value.length != 10)
              {
                 error_count++;
                 $(this).after('<p class="error-text">Provide Valid '+label+'.</p>');
              }
         
           });
         
           return error_count;
         }
         
         $(".select2").select2();
         
             function logout()
             {
               $.ajax({
                 type: "POST",
                 url: "{{url('/')}}/logout",
                 data : {"username" : ""},
                 dataType : 'json',
                 success: function (msg)
                 {
                   window.location.href = "{{url('/')}}";
                 }
               });
             }
         
         let sg_old_type      = "";
         let sg_old_value     = "";
         let sg_old_name      = "";
         let sg_old_id        = "";
         let sg_old_label     = "";
         let sg_old_field     = "";
         
         
         $("input:required").focusout(function(e)
         {
           sg_old_type      = this.type;
           sg_old_value     = this.value;
           sg_old_name      = this.name;
           sg_old_id        = this.id;
           sg_old_label     = $(this).prev('label').text();
           sg_old_field     = "input";
           if(sg_old_field !="")
           {
             validated_all_field();
           }
         });
         
         $("textarea:required").focusout(function(e)
         {
           sg_old_type      = this.type;
           sg_old_value     = this.value;
           sg_old_name      = this.name;
           sg_old_id        = this.id;
           sg_old_label     = $(this).prev('label').text();
           sg_old_field     = "textarea";
         
           if(sg_old_field !="")
           {
             validated_all_field();
           }
         });
         
         $("select:required").change(function(e)
         {
           sg_old_type      = this.type;
           sg_old_value     = this.value;
           sg_old_name      = this.name;
           sg_old_id        = this.id;
           sg_old_label     = $(this).prev('label').text();
           sg_old_field     = "select";
         
           if(sg_old_field !="")
           {
             validated_all_field();
           }
         });
         
         function validated_all_field(id)
         {
           if(sg_old_id !="")
           {
             if(sg_old_field=="input")
             {
                 if(sg_old_type=="email")
                 {
                   $("#"+sg_old_id).next('p').remove();
                   if(IsEmail(sg_old_value)==false || sg_old_value=="")
                   {
                     $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                   }
                 }
                 else if(sg_old_type=="number")
                 {
                     $("#"+sg_old_id).next('p').remove();
                     if($.isNumeric(sg_old_value)==false || sg_old_value=="")
                     {
                       $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                     }
                 }
                 else if(sg_old_type=="text")
                 {
                     $("#"+sg_old_id).next('p').remove();
                     if(sg_old_value=="")
                     {
                       $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                     }
                 }
         
                 if(sg_old_name=="mobile")
                 {
                     $("#"+sg_old_id).next('p').remove();
                     if(sg_old_value=="" || sg_old_value.length !=10)
                     {
                       $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                     }
                 }
             }
             else if(sg_old_field=="select")
             {
               var cls_name = $("#"+sg_old_id).attr("class");
               if(cls_name.includes('select2')==true)
               {
                 $("#"+sg_old_id).next('span').next('p').remove();
                 if(sg_old_value=="")
                 {
                   $("#"+sg_old_id).next('span').after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                 }
               }
               else
               {
                 $("#"+sg_old_id).next('p').remove();
                 if(sg_old_value=="")
                 {
                   $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
                 }
               }
             }
             else if(sg_old_field=="textarea")
             {
               $("#"+sg_old_id).next('p').remove();
               if(sg_old_value=="")
               {
                 $("#"+sg_old_id).after('<p class="error-text">Provide Valid '+sg_old_label+'.</p>');
         
               }
             }
               
           }
         }
         
         function today()
         {
         var today = new Date();
         var dd    = String(today.getDate()).padStart(2, '0');
         var mm    = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
         var yyyy  = today.getFullYear();
         
         today = yyyy + '-' + mm + '-' + dd;
         
         return today;
         
         }
         
         setInterval(function () 
         {
         
         
         }, 100);
         
         // on first focus (bubbles up to document), open the menu
         $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
         $(this).closest(".select2-container").siblings('select:enabled').select2('open');
         });
         
         // steal focus during close - only capture once and stop propogation
         $('select.select2').on('select2:closing', function (e) {
         $(e.target).data("select2").$selection.one('focus focusin', function (e) {
           e.stopPropagation();
         });
         });
         
      </script>
      @stack('scripts')
   </body>
</html>