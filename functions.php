<?php
/*
| ===================================================
| RGC FUNCTIONS SHEET V1.0
| ===================================================
*/

/*
|====================================================
| WIDGETIZED SIDEBAR SUPPORT
|====================================================
*/
if (function_exists('register_sidebar')) {

	register_sidebar(array('name'=>'sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<p class="title">',
		'after_title' => '</p>',
	));
}

/*
|====================================================
| ADDS SUPPORT FOR WORDPRESS CUSTOM MENUS
| ===================================================
*/

function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' )
			)
	);
}
add_action( 'init', 'register_my_menus' );

/*
|====================================================
| REMOVE UNNEEDED CALLS TO WP-HEAD
| ===================================================
*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

/*
|====================================================
| REMOVE DEFAULT DASHBOARD WIDGETS
|====================================================
*/
function disable_default_dashboard_widgets() {

	//COMMENT AND UN-COMMENT AS NEEDED TO CUSTOMIZE.
	//remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

/*
|====================================================
| ADD POST THUMBNAIL SUPPORT TO THEME
|====================================================
*/
// ENABLE THIS AS NEEDED
add_theme_support( 'post-thumbnails' );

/*
|====================================================
| lOAD CUSTOM JAVASCRIPT FILE
|====================================================
*/
function rm_ready_scripts() {
	wp_enqueue_script(
		'rm_javascript',
		get_template_directory_uri() . '/js/scripts.js',
		array('jquery'),
		'1.0',
		true
	);
}
add_action('wp_enqueue_scripts', 'rm_ready_scripts');

/*
|====================================================
| CUSTOMIZE THE ADMIN FOOTER AREA
|====================================================
*/
function custom_admin_footer() {
	echo 'Website design by <a href="http://rustygeorge.com/#contact">Rusty George Creative</a> &copy; '.date("Y").'. For site support please <a href="http://rustygeorge.com/#contact">contact us</a>.';
}
add_filter('admin_footer_text', 'custom_admin_footer');

/*
|====================================================
| CHANGE EXCERPT LENGTH / MESSAGE
|====================================================
*/

function custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more($more) {
       global $post;
	return '&hellip;<br><a class="readmore-link" href="'. get_permalink($post->ID) . '">Continue Reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/*
|====================================================
| CUSTOM PAGINATION SUPPORT
|====================================================
*/

function rgc_pagination($pages = '', $range = 2)
{  
  $showitems = ($range * 1)+1;  
  global $paged;
  if(empty($paged)) $paged = 1;

  if($pages == '')
  {
    global $wp_query;
	$pages = $wp_query->max_num_pages;
	if(!$pages)
	{
		$pages = 1;
	}
  }   

  if(1 != $pages)
  {
	echo "<div class='pagination'>";
	if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
	if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
	for ($i=1; $i <= $pages; $i++)
	{
	  if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
	  {
		echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
	  }
	}
	if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
	echo "</div>\n";
  }
}

/*
|====================================================
| MINIFY ADMIN BAR
|====================================================
*/
add_action('get_header', 'my_filter_head');
function my_filter_head() { remove_action('wp_head', '_admin_bar_bump_cb'); }
function my_admin_css() {
        if ( is_user_logged_in() ) {
        ?>
        <style type="text/css">
            #wpadminbar {
                width: 47px;
                min-width: 47px;
                overflow: hidden;
                -webkit-transition: .2s width;
                -webkit-transition-delay: 0s;
                -moz-transition: .2s width;
                -moz-transition-delay: 0s;
                -o-transition: .2s width;
                -o-transition-delay: 0s;
                -ms-transition: .2s width;
                -ms-transition-delay: 0s;
                transition: .2s width;
                transition-delay: 0s;
            }
            
            #wpadminbar:hover {
                width: 100%;
                overflow: visible;
                -webkit-transition-delay: 0;
                -moz-transition-delay: 0;
                -o-transition-delay: 0;
                -ms-transition-delay: 0;
                transition-delay: 0;
            }
        </style>
        <?php }
}
add_action('wp_head', 'my_admin_css');

/*
|====================================================
| CUSTOM LOGIN LOGO
|====================================================
*/
function custom_login_logo() {
	echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/assets/logo-login.png) 50% 50% no-repeat !important; }</style>';
}
add_action('login_head', 'custom_login_logo');
