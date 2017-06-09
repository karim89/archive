<!DOCTYPE html>
<html lang="en">
    <head>                        
        <title>Boooya - Revolution Admin Template</title>            
        
        <!-- META SECTION -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END META SECTION -->
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" href="{{ URL::to('/css/styles.css')}}">
        <!-- EOF CSS INCLUDE -->
    </head>
    <body>        
        
        <!-- APP WRAPPER -->
        <div class="app">           

            <!-- START APP CONTAINER -->
            <div class="app-container">
                <!-- START SIDEBAR -->
                <div class="app-sidebar app-navigation app-navigation-fixed scroll app-navigation-style-default app-navigation-open-hover dir-left" data-type="close-other">
                    <a href="index.html" class="app-navigation-logo">
                        MWARC - Administrator Panel
                        <button class="app-navigation-logo-button mobile-hidden" data-sidepanel-toggle=".app-sidepanel"><span class="icon-alarm"></span> <span class="app-navigation-logo-button-alert">7</span></button>
                    </a>
                    
                    <nav>
                        <ul>
                            <li class="title">MAIN</li>
                            <li><a href="MWARC-dashboard.html"><span class="nav-icon-hexa">DB</span> Dashboard</a></li>      
                            
                            <li>
                                <a href="#"><span class="nav-icon-hexa">HR</span> Harvest </a>
                                <ul>                                
                                    <li><a href="MWARC-harvest-website.html"><span class="nav-icon-hexa">Hw</span> Harvest URL / Domain / Website </a></li>
                                    <li><a href="MWARC-harvest-website-listing.html"><span class="nav-icon-hexa">Hl</span> Harvest Listing </a></li>                 
                                </ul>
                            </li>        

                            <li>
                                <a href="MWARC-website-listing.html"><span class="nav-icon-hexa">WL</span> Website / URL / Domain </a>
                                <ul>                                
                                    <li><a href="MWARC-website-add.html"><span class="nav-icon-hexa">Aa</span> Add Website / URL / Domain </a></li>
                                    <li><a href="MWARC-website-listing.html"><span class="nav-icon-hexa">Ul</span> Website Listing </a></li>                 
                                </ul>
                            </li>

                            <li><a href="#"><span class="nav-icon-hexa">LU</span> Lookup </a></li>

                            <li>
                                <a href="#"><span class="nav-icon-hexa">AM</span> Admin Manager </a>
                                <ul>                                
                                    <li><a href="#"><span class="nav-icon-hexa">Aa</span> Add Admin </a></li>
                                    <li><a href="#"><span class="nav-icon-hexa">Ul</span> Admin Listing </a></li>                 
                                </ul>
                            </li> 
                        </ul>
                    </nav>
                </div>
                <!-- END SIDEBAR -->
                
                <!-- START APP CONTENT -->
                <div class="app-content app-sidebar-left">
                    <!-- START APP HEADER -->
                    <div class="app-header app-header-design-default">
                        <ul class="app-header-buttons">
                            <li class="visible-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-toggle=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                            <li class="hidden-mobile"><a href="#" class="btn btn-link btn-icon" data-sidebar-minimize=".app-sidebar.dir-left"><span class="icon-menu"></span></a></li>
                        </ul>
                        <form class="app-header-search" action="" method="get">        
                            <input type="text" name="url" placeholder="Search" value="{{isset($_GET['url']) ? $_GET['url'] : ''}}">
                        </form>    
                    
                        <ul class="app-header-buttons pull-right">
                            <li>
                                <div class="contact contact-rounded contact-bordered contact-lg contact-ps-controls">
                                    <img src="assets/images/users/user_1.jpg" alt="John Doe">
                                    <div class="contact-container">
                                        <a href="#">{{ Auth::user()->name }}</a>
                                        <span>Administrator</span>
                                    </div>
                                    <div class="contact-controls">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-default btn-icon" data-toggle="dropdown"><span class="icon-cog"></span></button>                        
                                            <ul class="dropdown-menu dropdown-left">
                                                <li><a href="#"><span class="icon-cog"></span> Settings</a></li> 
                                                <li><a href="#"><span class="icon-envelope"></span> Messages <span class="label label-danger pull-right">+24</span></a></li>
                                                <li><a href="#"><span class="icon-users"></span> Contacts <span class="label label-default pull-right">76</span></a></li>
                                                <li class="divider"></li>
                                                <li>
                                                    <a href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                    </form>
                                                </li> 
                                            </ul>
                                        </div>                    
                                    </div>
                                </div>
                            </li>        
                        </ul>
                    </div>
                    <!-- END APP HEADER  -->
                    
                    <!-- START PAGE HEADING -->
                    <div class="app-heading app-heading-bordered app-heading-page">
                        <div class="icon icon-lg">
                            <span class="icon-laptop-phone"></span>
                        </div>
                        <div class="title">
                            <h1>Malaysia Web Archiving</h1>
                            <p>Welcome to Malaysia Web Archiving (MWARC) Dashboard</p>
                        </div>               
                        <!--
                        <div class="heading-elements">
                            <a href="#" class="btn btn-danger" id="page-like"><span class="app-spinner loading"></span> loading...</a>
                            <a href="https://themeforest.net/item/boooya-revolution-admin-template/17227946?ref=aqvatarius&license=regular&open_purchase_for_item_id=17227946" class="btn btn-success btn-icon-fixed"><span class="icon-text">$24</span> Purchase</a>
                        </div>
                        -->
                    </div>
                    @yield('content')
                    
                    <!-- END PAGE HEADING -->
                    
                    <!-- START PAGE CONTAINER -->
                    
                    <!-- END PAGE CONTAINER -->
                    
                </div>
                <!-- END APP CONTENT -->
                                
            </div>
            <!-- END APP CONTAINER -->
                        
            <!-- START APP FOOTER -->
            <div class="app-footer app-footer-default" id="footer">
                <!--
                <div class="alert alert-danger alert-dismissible alert-inside text-center">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="icon-cross"></span></button>
                    We use cookies to offer you the best experience on our website. Continuing browsing, you accept our cookies policy.
                </div>
                -->
                <div class="app-footer-line extended">
                    <div class="row">
                        <div class="col-md-3 col-sm-4">
                            <h3 class="title"><img src="./img/logo.png" alt="boooyah"> </h3>                            
                            <p> <b>Malaysia Web Archiving</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum bibendum at leo id scelerisque. Phasellus lectus metus, ornare eu elit quis, rutrum posuere odio.</p>
                            <p><strong>How?</strong><br>Aenean id eros non augue pellentesque ultrices ut id magna. Donec feugiat mi elit, sed pharetra quam condimentum at. Sed ullamcorper blandit nisi.</p>
                        </div>
                        <div class="col-md-2 col-sm-4">
                            <h3 class="title"><span class="icon-clipboard-text"></span> About Us</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">Lorem ipsum</a></li>                                                                
                                <li><a href="#">Consectetur adipiscing</a></li>
                                <li><a href="#">Vestibulum bibendum </a></li>
                                <li><a href="#">Phasellus lectus metus</a></li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4">                            
                            <h3 class="title"><span class="icon-lifebuoy"></span> Need Help?</h3>
                            <ul class="list-unstyled">
                                <li><a href="#">Ornare eu elit quis</a></li>                                                                
                                <li><a href="#">Rutrum posuere odio</a></li>
                                <li><a href="#">Caenean id eros</a></li>
                                <li><a href="#">Donec feugiat mi elit</a></li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-6 clear-mobile">
                            <h3 class="title"><span class="icon-reading"></span> Latest News</h3>
            
                            <div class="row app-footer-articles">
                                <div class="col-md-9 col-sm-12">
                                    <a href="#">Lorem ipsum dolor sit amet</a>
                                    <p>Quod quam magnum sit fictae veterum fabulae declarant, in quibus tam multis.</p>
                                </div>
                            </div>
            
                            <div class="row app-footer-articles">
                                <div class="col-md-9 col-sm-12">
                                    <a href="#">Consectetur adipiscing elit.</a>
                                    <p>In quibus tam multis tamque variis ab ultima antiquitate repetitis tria.</p>
                                </div>
                            </div>
            
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <h3 class="title"><span class="icon-thumbs-up"></span> Social Media</h3>
            
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-facebook"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-youtube"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-google-plus"></i>
                            </a>
                            <a href="#" class="label-icon label-icon-footer label-icon-bordered label-icon-rounded label-icon-lg">
                                <i class="fa fa-feed"></i>
                            </a>
            
                        </div>                        
                    </div>                    
                </div>
                <div class="app-footer-line darken">                
                    <div class="copyright wide text-center">&copy; 2016 Arkib Negara Malaysia. All right reserved.</div>                
                </div>
            </div>
            <!-- END APP FOOTER -->
            <!-- START APP SIDEPANEL -->
            <div class="app-sidepanel scroll" data-overlay="show">                
                <div class="container">
                    
                    <div class="app-heading app-heading-condensed app-heading-small padding-left-0">
                        <div class="icon icon-lg">
                            <span class="icon-alarm"></span>
                        </div>
                        <div class="title">
                            <h2>Notifications</h2>              
                            <p><strong>7 new</strong>, latest: July 19, 2016 at 10:14:32.</p>
                        </div>                                
                    </div>        
            
                    <div class="listing margin-bottom-10">                                                                                
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivered</strong> <span class="label label-success pull-right">delivered</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 19/07/2016 10:14:32 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Successful Payment</strong> <span class="label label-success pull-right">success</span>
                            <p class="margin-0 margin-top-5">Payment for order #SPW-955-17: <strong>$145.44</strong>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:55:12 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>New Order #SPW-955-17</strong> <span class="label label-warning pull-right">waiting</span>
                            <p class="margin-0 margin-top-5">Added new order, waiting for payment. <a href="#">Order details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 09:51:55 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Money Back Request</strong> <span class="label label-primary pull-right">return</span>
                            <p class="margin-0 margin-top-5">#SPW-955-17 return requested. <a href="#">Request details</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-bank margin-right-5"></span> 19/07/2016 08:44:51 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>The critical amount of product</strong> <span class="label label-danger pull-right">important</span>
                            <p class="margin-0 margin-top-5">Product: <a href="#">Extra Awesome Product</a> (amount: <span class="text-danger">2</span>). <a href="#">Storehouse</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-cube margin-right-5"></span> 19/07/2016 08:30:00 AM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Product Delivery Start</strong> <span class="label label-warning pull-right">delivering</span>
                            <p class="margin-0 margin-top-5">#SPW-955-18 to st. StreetName SA, USA.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                        <div class="listing-item margin-bottom-10">
                            <strong>Critical Server Load</strong> <span class="label label-danger pull-right">server</span>
                            <p class="margin-0 margin-top-5">Disk space: 248.1Gb/250Gb. <a href="#">Control panel</a>.</p>
                            <p class="text-muted">
                                <span class="fa fa-truck margin-right-5"></span> 18/07/2016 06:14:32 PM
                            </p>
                        </div>
                    </div>
                    <div class="row margin-bottom-30">
                        <div class="col-xs-6 col-xs-offset-3">
                            <button class="btn btn-default btn-block">All Notification</button>
                        </div>            
                    </div>
                    
                    <div class="app-heading app-heading-condensed app-heading-small margin-bottom-20 padding-left-0">
                        <div class="icon icon-lg">
                            <span class="icon-cog"></span>
                        </div>
                        <div class="title">
                            <h2>Settings</h2>              
                            <p>Notification Settings</p>
                        </div>                                
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_1" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Delivery Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_2" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Product Amount Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_3" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Order Information</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_4" checked="" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Server Load</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_5" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>User Registrations</label>
                            </div>
                        </div>            
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="switch switch-sm margin-0">
                                    <input type="checkbox" name="app_settings_6" value="0">
                                </label>
                            </div>
                            <div class="col-xs-10">
                                <label>Purchase Information</label>
                            </div>
                        </div>            
                    </div>
                    
                </div>
            </div>
            <!-- END APP SIDEPANEL -->
            
            <!-- APP OVERLAY -->
            <div class="app-overlay"></div>
            <!-- END APP OVERLAY -->
        </div>        
        <!-- END APP WRAPPER -->                
        
        <!--
        <div class="modal fade" id="modal-thanks" tabindex="-1" role="dialog">                        
            <div class="modal-dialog modal-sm" role="document">                    
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="icon-cross"></span></button>
                <div class="modal-content">                    
                    <div class="modal-body">                
                        <p class="text-center margin-bottom-20">
                            <img src="assets/images/smile.png" alt="Thank you" style="width: 100px;">
                        </p>                
                        <h3 id="modal-thanks-heading" class="text-uppercase text-bold text-lg heading-line-below heading-line-below-short text-center"></h3>
                        <p class="text-muted text-center margin-bottom-10">Thank you so much for likes</p>
                        <p class="text-muted text-center">We will do our best to make<br> Boooya template perfect</p>                
                        <p class="text-center"><button class="btn btn-success btn-clean" data-dismiss="modal">Continue</button></p>
                    </div>                    
                </div>
            </div>            
        </div>-->     
        <!-- END APP WRAPPER -->                
        
       
        
        <!-- IMPORTANT SCRIPTS -->
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jquery/jquery-migrate.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/bootstrap/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/moment/moment.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/customscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        <!-- END IMPORTANT SCRIPTS -->
        <!-- THIS PAGE SCRIPTS -->
        <script type="text/javascript" src="{{ URL::to('/js/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.js')}}"></script>
        
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jvectormap/jquery-jvectormap.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')}}"></script>
        
        <script type="text/javascript" src="{{ URL::to('/js/vendor/rickshaw/d3.v3.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/vendor/rickshaw/rickshaw.min.js')}}"></script>
        <!-- END THIS PAGE SCRIPTS -->
        <!-- APP SCRIPTS -->
        <script type="text/javascript" src="{{ URL::to('/js/app.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/app_plugins.js')}}"></script>
        <script type="text/javascript" src="{{ URL::to('/js/app_demo.js')}}"></script>
        <!-- END APP SCRIPTS -->
        <script type="text/javascript" src="{{ URL::to('/js/app_demo_dashboard.js')}}"></script>
    </body>
</html>