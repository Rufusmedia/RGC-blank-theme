<!doctype html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/assets/favicon.png">
        <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/style.css">
        <?php wp_head(); ?>
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <header>
            <div class="container">
                <div class="logo">
                    <a href="<?php bloginfo('url') ?>/"><img src="http://placehold.it/100x50" alt=""></a>
                </div><!-- /.logo -->
                <nav>
                    <?php wp_nav_menu( array(
                                            'theme_location' => 'header-menu', 
                                            'container' => false
                                            )); ?>
                </nav>
            </div><!-- /.container -->
        </header>