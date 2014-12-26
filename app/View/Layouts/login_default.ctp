<!DOCTYPE html>
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
        
    </head>
    <body class="login">
        <div id="content">
            <?php echo $this->Session->flash(); ?>
            <?php echo $this->fetch('content'); ?>
        </div>
    </body>
    
</html>