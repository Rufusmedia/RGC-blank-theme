<?php
/*
| ===================================================
| RGC FUNCTIONS SHEET V1.0
| ===================================================
*/

/*
|====================================================
| REMOVE COMMENTS FROM WORDPRESS INSTALL
|====================================================
*/
// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// remove comments link from admin bar
function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

// Close comments on the front-end
function df_disable_comments_status() {
    return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

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
function rgc_remove_submenu(){
	global $submenu;
	unset($submenu['themes.php'][6]); // remove customize link
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_submenu_page( 'themes.php', 'theme-editor.php' );
	remove_submenu_page('plugins.php', 'plugin-editor.php' );
}

function rgc_remove_menus(){
  //remove_menu_page( 'index.php' );                  //Dashboard
  remove_menu_page( 'jetpack' );                    //Jetpack* 
  //remove_menu_page( 'edit.php' );                   //Posts
  //remove_menu_page( 'upload.php' );                 //Media
  //remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  //remove_menu_page( 'themes.php' );                 //Appearance
  //remove_menu_page( 'plugins.php' );                //Plugins
  //remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
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
        'id'            => 'sidebar_1',
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
| ADD CUSTOM DASHBOARD WIDGETS
|====================================================
*/
// SET DASHBOARD WIDGET COLS
function RGC_dashboard_columns() {
    add_screen_option(
        'layout_columns',
        array(
            'max'     => 1,
            'default' => 1
        )
    );
}
add_action( 'admin_head-index.php', 'RGC_dashboard_columns' );

// STYLE THEM TO BE 100% WIDE
add_action( 'admin_head-index.php', function(){
    ?>
	<style>
		.postbox-container {
		    min-width: 100% !important;
		}
		.meta-box-sortables.ui-sortable.empty-container { 
		    display: none;
		}
	</style>
    <?php
});

// ADD THE WIDGETS
add_action( 'wp_dashboard_setup', 'register_rgc_dashboard_widget' );
function register_rgc_dashboard_widget() {
	wp_add_dashboard_widget(
		'rgc_dashboard_widget',
		'Helpful Links &amp; Resources',
		'rgc_dashboard_widget_display'
	);
	wp_add_dashboard_widget(
		'video_dashboard_widget',
		'Helpful WordPress Tutorials',
		'video_dashboard_widget_display'
	);
}

function rgc_dashboard_widget_display() {
    ?>
    <h2>Rusty George Creative Resources</h2>
    <p>
	    <strong>Telephone:</strong> <a href="tel:253.284.2140">253.284.2140</a><br>
	    <strong>Email:</strong> <a href="mailto:info@rustygeorge.com">info@rustygeorge.com</a><br>
	    <strong>Social Media:</strong> <a href="https://www.facebook.com/rustygeorgecreative">Facebook</a> | <a href="https://twitter.com/RustyGCreative">Twitter</a> | <a href="http://www.linkedin.com/company/rusty-george-creative">LinkedIn</a><br>
	    <strong>Address:</strong> <a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Rusty+George+Creative,+Broadway,+Tacoma,+WA&aq=0&oq=rusty+george&sll=47.286682,-120.882568&sspn=7.900565,16.644287&vpsrc=6&ie=UTF8&hq=Rusty+George+Creative,+Broadway,+Tacoma,+WA&hnear=&radius=15000&ll=47.256456,-122.444601&spn=0.0621,0.122824&t=m&z=14&iwloc=A&cid=6315586833550468535">732 Broadway, Ste. 302 Tacoma, Washington 98402</a>
    </p>
    <h2>WordPress Resources</h2>
    <ul>
    	<li><a href="https://codex.wordpress.org/Main_Page" target="_blank">WordPress Instruction Manual (codex)</a></li>
    </ul>
    <?php
}

function video_dashboard_widget_display() {
    ?>
    <div style="display: flex; flex-wrap:wrap; justify-content: space-between;">
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>WordPress Dashboard Intro</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/Rlqm2mFaAIU?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
    		<h2>Using the WordPress Editor</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/1camxmrqVWg?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>Posts vs. Pages</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/ac6t3jKKdWY?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>Working With Posts</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/GIjJnqk7mBQ?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
    		<h2>Working with Pages</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/69TKDhFd1wM?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>Working with Media</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/rnh1g7sYU4k?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>Working with Menus</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/w1oNeH-V_cc?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    	<div style="width: 550px; margin-bottom: 30px;">
			<h2>Working with Users</h2>
    		<iframe style="width:100%; min-height: 400px;" src="https://www.youtube.com/embed/TUUBIwcpND0?list=PLfOXCtnURNbZjLUyU_Isp39VdAjqEctNw" frameborder="0" allowfullscreen></iframe>
    	</div>
    </div>
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

function rgc_pagination($pages = '', $range = 2){  
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