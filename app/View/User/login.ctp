<style type="text/css">
    .no-auth{
        border: solid 5px #CE3131 !important;
    }
</style>
<!-- Login Intro -->
<a href="javascript:void(0)" class="login-btn themed-background-ocean">
    <span class="login-logo">
        <span class="square1 themed-border-ocean"></span>
        <span class="square2"></span>
        <span class="name">F-WASA</span>
    </span>
</a>
<div class="left-door"></div>
<div class="right-door"></div>
<!-- END Login Intro -->
            
<!-- Login Container -->
<div id="login-container" class="display-none">
    <!-- Login Block -->
    <div class="block-tabs block-themed">
        <ul id="login-tabs" class="nav nav-tabs" data-toggle="tabs">
            <li class="active text-center">
                <a href="#login-form-tab">
                    <i class="fa fa-user"></i> Login
                </a>
            </li>
        </ul>
        <div class="tab-content">
                <div class="tab-pane active" id="login-form-tab">
                        
                <!-- Login Form -->
                <form action="<?php echo $this->Html->url("/user/login",true); ?>" method="post" id="login-form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                                <input type="text" id="login-username" name="data[User][user_email]" class="form-control" placeholder="Username..">
                            </div> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-asterisk fa-fw"></i></span>
                                <input type="password" id="login-password" name="data[User][user_password]" class="form-control" placeholder="Password..">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 clearfix">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-success remove-margin">Login</button>
                            </div>
                        </div>
                    </div>
                
				</form>
                <!-- END Login Form -->
            </div>
        </div>
    </div>
    <!-- END Login Block -->
</div>
<!-- END Login Container -->
        <?php echo $this->Html->script("http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"); ?>
<script>!window.jQuery && document.write(decodeURI('%3Cscript src="<?php echo $this->Html->url("/js/vendor/jquery-1.11.1.min.js",true) ?>"%3E%3C/script%3E'));</script>
        <?php
            echo $this->Html->script(array(
                "vendor/bootstrap.min",
                "plugins",
                "main"
                    
            ));
        ?>
<script>
    $(function() {
        if (!$('body').hasClass('no-animation')) {
            var timeout = 0;
                    
            // If our browser support transitions (class will be added with the help of modernizr library) add a timeout of 750ms
            // Nice fallback for our animation on older browser (such as IE8-9)
            if ($('html').hasClass('csstransitions'))
                timeout = 750;
                    
            // On button hover or touch reveal the login form
            $('.login-btn').mouseenter(function() {
                $('.left-door, .right-door, .login-btn').addClass('login-animate');      
                setTimeout(function() {
                    $('#login-container').fadeIn(1500);
                    $('.login-btn .name').fadeOut(250, function() {
                        $('.login-btn .square1, .login-btn .square2').fadeIn(750);
                        $('#login-email').focus();
                    });
                }, timeout);
            });
        }
          <?php if(isset($login) && $login == 'false'){ ?>
            $('.login-btn').addClass("no-auth");
          <?php } ?>
    });
</script>