<header class="navbar navbar-inverse navbar-fixed-top">
    <div class="row">
        <!-- Sidebar Toggle Buttons (Desktop & Tablet) -->
        <div class="col-sm-4 hidden-xs">
            <ul class="navbar-nav-custom pull-left">
                <!-- Desktop Button (Visible only on desktop resolutions) -->
                <li class="visible-md visible-lg">
                    <a href="javascript:void(0)" id="toggle-side-content">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
                <!-- END Desktop Button -->
                
                <!-- Divider -->
                <li class="divider-vertical"></li>
            </ul>
        </div>
        <!-- END Sidebar Toggle Buttons -->
        
        
        <!-- Brand and Search Section -->
        <div class="col-sm-4 col-xs-12 text-center">
            <!-- Top search -->
            <!-- <form id="top-search" class="pull-left" action="page_ready_search_results.html" method="post">
                <input type="text" id="search-term" class="form-control" name="search-term" placeholder="Search Complain...">
            </form> -->
            <!-- END Top search -->
                        
            <!-- Logo -->
            <a href="<?php echo $this->Html->url("/",true) ?>" class="navbar-brand">
                F-WASA Complaint Registration System
            </a>
            <!-- END Logo -->
                        
            <!-- Loading Indicator, Used for demostrating how loading of notifications could happen, check main.js - uiDemo() -->
            <div id="loading" class="display-none"><i class="fa fa-spinner fa-spin"></i></div>
        </div>
        <!-- END Brand and Search Section -->
                    
        <!-- Header Nav Section -->
        <div id="header-nav-section" class="col-sm-4 col-xs-12 clearfix">
            <!-- Header Nav -->
            <ul class="navbar-nav-custom pull-right">
                <li class="dropdown dropdown-theme-options">
                    <a href="javascript:void(0)"><?php echo AuthComponent::user("user_name"); ?></a>
                </li>
                <li class="divider-vertical"></li>
                <li class="dropdown dropdown-notifications">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                       
                        <?php if (AuthComponent::user('id')): ?>
                        <li>
                            <a href="<?php echo $this->Html->url("/user/logout/",true); ?>"><i class="fa fa-user pull-right"></i>Logout</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                            
            </ul>
            <!-- END Header Nav -->
            <!-- Mobile Navigation, Shows up on tables and mobiles -->
            <ul class="navbar-nav-custom pull-left visible-xs visible-sm" id="mobile-nav">
                <li>
                    <!-- It is set to open and close the main navigation on tables and mobiles. The class .navbar-main-collapse was added to aside#page-sidebar -->
                    <a href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-main-collapse">
                        <i class="fa fa-bars"></i>
                    </a>
                </li>
                <li class="divider-vertical"></li>
            </ul>
            <!-- END Mobile Navigation, Shows up on tables and on mobiles -->
        </div> 
        <!-- END Header Nav Section -->
    </div>
    <!-- END div#row -->
</header>