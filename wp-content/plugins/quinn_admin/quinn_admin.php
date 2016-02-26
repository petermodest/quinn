<?php
/*
Plugin Name: Quinn Admin
Description: Control panel for quinnsnacks.com
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/*
 *    REGISTER MENUS
*/


add_action( 'admin_menu', 'add_quinn_admin' );

function add_quinn_admin() {
    //add an item to the menu
    add_menu_page (
        'Quinn Admin',                                    // page_title
        'Quinn Admin',                                    // menu_title
        'manage_options',                                 // capability
        'quinn-admin',                                    // menu-slug
        'quinn_admin_callback',                           // function
         plugin_dir_url( __FILE__ ).'images/quinn-plugin-icon.svg',
         '3.1235'                                          // position
    );

  }
//
// add_action('admin_menu', 'add_foodshouldbe');
//
// function add_foodshouldbe() {
// 	add_submenu_page(
//     'quinn-admin',
//     'Food Should Be',
//     'Food Should Be',
//     'manage_options',
//     'my-custom-submenu-page',
//     function(){ require('admin/admin-foodshouldbe.php'); }
//     );
// }

function quinn_admin_callback() {
  require('admin/admin.php');
}


/*
 *    REGISTER POST TYPES
*/

add_action('init', 'register_custom_posts_init');
function register_custom_posts_init() {

 // Designs

    $campaigns_labels = array(
        'name'               => 'Campaigns',
        'singular_name'      => 'Campaign',
        'menu_name'          => 'Campaigns',
        'add_new_item'       => 'Add New Campaign'
    );
    $campaigns_args = array(
        'labels'             => $campaigns_labels,
        'public'             => true,
        'capability_type'    => 'post',
        'has_archive'        => true,
				'supports'           => array( 'title' ),
        'show_in_menu'       => 'quinn-admin'
    );


    register_post_type('campaigns', $campaigns_args);

}



/*
 *    ADD SEPERATORS
 *    Credit : https://tommcfarlin.com/add-a-separator-to-the-wordpress-menu/
*/



function add_admin_menu_separator( $position ) {

	global $menu;

	$menu[ $position ] = array(
		0	=>	'',
		1	=>	'read',
		2	=>	'separator' . $position,
		3	=>	'',
		4	=>	'wp-menu-separator'
	);

}

function set_admin_menu_separator() {
	do_action( 'admin_init', 3.1234 );
	do_action( 'admin_init', 3.1236);
}

add_action( 'admin_init', 'add_admin_menu_separator' );
add_action( 'admin_menu', 'set_admin_menu_separator' );


/*
 *    AUTOMATICALLY FIND TEMPLATES
 *    Credit : http://wordpress.stackexchange.com/a/191220
*/


function add_posttype_slug_template( $single_template )
{
	$object = get_queried_object();
	$single_postType_postName_template = locate_template("templates-{$object->post_type}/{$object->post_name}.php");
	if( file_exists( $single_postType_postName_template ) )
	{
		return $single_postType_postName_template;
	} else {
		return $single_template;
	}
}
add_filter( 'single_template', 'add_posttype_slug_template', 10, 1 );


?>
