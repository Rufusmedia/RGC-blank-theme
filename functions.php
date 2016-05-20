<?php
/*
| ===================================================
| RGC FUNCTIONS SHEET V1.0
| ===================================================
*/

/*
| ===================================================
| REMOVE UNWANTED ADMIN LINKS
| ===================================================
*/
add_action( 'admin_bar_menu', 'rgc_remove_customizer', 999 );
function rgc_remove_customizer( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'customize' );
}

add_action('admin_init', 'rgc_remove_submenu', 102);
function rgc_remove_submenu()
{
	global $submenu;
	unset($submenu['themes.php'][6]); // remove customize link
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_submenu_page('plugins.php', 'plugin-editor.php' );
}

function rgc_remove_menus(){
  
  remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  //remove_menu_page( 'tools.php' );                  //Tools
  //remove_menu_page( 'options-general.php' );        //Settings
  
}
add_action( 'admin_menu', 'rgc_remove_menus' );

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
	global $wp_meta_boxes;
	// wp..
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	// yoast seo
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
	// gravity forms
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);

/*
|====================================================
| ADD CUSTOM DASHBOARD WIDGET
|====================================================
*/
add_action( 'wp_dashboard_setup', 'register_rgc_dashboard_widget' );
function register_rgc_dashboard_widget() {
	wp_add_dashboard_widget(
		'rgc_dashboard_widget',
		'Rusty George Creative Dashboard Widget',
		'rgc_dashboard_widget_display'
	);
	// wp_add_dashboard_widget(
	// 	'cat_dashboard_widget',
	// 	'Random Animated Cat Dashboard Widget',
	// 	'cat_dashboard_widget_display'
	// );
}

function rgc_dashboard_widget_display() {
    ?>
    <h2>Helpful WordPress Links</h2>
    <ul>
    	<li><a href="#needs-link">WP Resources</a></li>
    	<li><a href="#needs-link">WP Resources</a></li>
    </ul>

    <h2>RGC Links</h2>
    <ul>
    	<li><a href="#needs-link">RGC Resources</a></li>
    	<li><a href="#needs-link">RGC Resources</a></li>
    </ul>
    <?php
}

function cat_dashboard_widget_display() {
    ?>
    <h2>Random Animated Cat</h2>
    <a href="http://thecatapi.com"><img src="http://thecatapi.com/api/images/get?format=src&type=gif"></a>
    <?php
}

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

/*
|====================================================
| INCLUDE ACF PRO IN THEME
|====================================================
*/
// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');
 
function my_acf_settings_path( $path ) {
    $path = get_stylesheet_directory() . '/assets/plugins/acf/';
    return $path;
}

// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');
 
function my_acf_settings_dir( $dir ) {
    $dir = get_stylesheet_directory_uri() . '/assets/plugins/acf/';
    return $dir; 
}
 
// 3. Hide ACF field group menu item
add_filter('acf/settings/show_admin', '__return_false');

// 4. Include ACF
include_once( get_stylesheet_directory() . '/assets/plugins/acf/acf.php' );

// 5 Load default fields
include_once('assets/inc/jc-acf-fields.php');

/*
|====================================================
| ADD THEME OPTIONS PAGE
|====================================================
*/
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}