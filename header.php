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
    <body <?php body_class(); ?>>
        <!--[if lte IE 9]>
            <div class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/?locale=en" target="_blank">upgrade your browser</a> to improve your experience.</div>
        <![endif]-->
        <div class="overlay-nav-container">
          <div class="nav-overlay-toggle"><img src="<?php bloginfo('template_directory') ?>/assets/close.svg" alt="" width="25" height="25"></div>
          <div class="overlay-nav-content"></div>
        </div><!-- /.overlay-nav-container -->
        <header>
            <div class="container">
            <div class="nav-toggle"></div>
                <div class="logo">
                    <?php 
                        $theme_logo = get_field('theme_logo', 'options');
                    ?>
                    <a href="<?php bloginfo('url') ?>/"><img src="<?php echo $theme_logo['url'] ?>" alt="Website Logo" width="80" height="80"></a>
                </div><!-- /.logo -->
                <nav>
                    <?php wp_nav_menu( array(
                                            'theme_location' => 'header-menu', 
                                            'container' => false
                                            )); ?>
                </nav>
            </div><!-- /.container -->
        </header>