<!DOCTYPE html>
<html>
<head>
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?php echo $this->Html->url("/img/favicon.ico",true) ?>">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon57.png",true) ?>" sizes="57x57">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon72.png",true) ?>" sizes="72x72">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon76.png",true) ?>" sizes="76x76">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon114.png",true) ?>" sizes="114x114">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon120.png",true) ?>" sizes="120x120">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon144.png",true) ?>" sizes="144x144">
        <link rel="apple-touch-icon" href="<?php echo $this->Html->url("/img/icon152.png",true) ?>" sizes="152x152">
        <!-- END Icons -->
        
        <?php
            echo $this->Html->css(array("bootstrap","plugins","main","themes/ocean","themes"),array("fullBase"=>true));
            echo $this->Html->script("vendor/modernizr-2.7.1-respond-1.4.2.min",array("fullBase"=>true));
        ?>
        <style type="text/css">
            #flashMessage{
                /*margin-bottom: 0px !important;*/
            }
        </style>
</head>
<body class="header-fixed-top">
    <div id="page-container" class="full-width">
      <?php 
            echo $this->element("header"); 
            
            ?>
        <!-- Page Content -->
        <div id="page-content">
            <?php echo  $this->Html->getCrumbList(array('class'=>'breadcrumb breadcrumb-top')); ?>
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
        <!-- END Page Content -->
        <?php echo $this->element("footer"); ?>
    </div>
    <!-- END Page Container -->
    <!-- Scroll to top link, check main.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-chevron-up"></i></a>
    <?php echo $this->element("settings") ?>
         <script type="text/javascript">
         var main_path = "<?php echo $this->Html->url("/",true); ?>";
            !window.jQuery && document.write(decodeURI('%3Cscript src="<?php echo $this->Html->url("/js/vendor/jquery-1.11.1.min.js",true) ?>"%3E%3C/script%3E'));
            
        </script>
        
        <?php
            echo $this->Html->script(array(
                "vendor/bootstrap.min",
                "plugins",
                "main",
                "js_tree",
                "custom",
                // "gmaps.min"
                    
            ));
        ?>
        <?php if($this->params['controller'] == 'complaints' ){ 
            echo $this->Html->script('gmaps.min');
         } ?>
</body>
<style type="text/css">
    #pre-page-content,.breadcrumb,.slimScrollDiv{
        display: none;
    }
    #page-content + footer{
        margin-left: 0px;
    }
    #page-content{
        margin-left: 0px;
    }
    #page-sidebar{
        width: 0px !important;
    }
    .bjqs-markers{
        display: block !important;
        position: absolute;
        top: -71px;
        left: 0px !important;
    }
   /* .bjqs-next{
        display: none;
    }
    .bjqs-prev{
        display: none;
    }*/
       
</style>
</html>
