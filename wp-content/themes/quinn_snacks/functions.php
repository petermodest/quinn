<?

/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
*/

function modest_fw_child_theme() {

	require_once( MODEST_FW_PATH . '/functions.php' );
	
	require_once( 'library/structure/init.inc.php' ); // INITIATE THEME
	require_once( 'library/structure/html.inc.php' ); // HTML FUNCTIONS TO REDUCE REPLICATED CODE
	
	// WP ADMIN
	if ( is_admin() || is_login_page() ) require_once( 'library/structure/admin/admin.php' );

	// LOGIN PAGE
// 	if( is_login_page() ) require_once( 'library/structure/admin/login.php' );
	
	function custom_post_object() {
		global $post;

		if( $post ) :
			$class_name = post_type_to_class_name( $post->post_type );
			$post = class_exists( $class_name ) ? new $class_name( $post ) : new Post( $post );
			global ${$post->post_type};
			${$post->post_type} = $post;
		endif;

	}
	add_action( 'wp', 'custom_post_object' );
}

modest_fw_child_theme();

include( 'library/structure/init.inc.php' );

// ====================================================
// add thumbnail (featured image) functionality
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'postpic-full', 1500, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'postpic-med', 660, 9999 ); //(cropped)
	add_image_size( 'postpic-tile', 400, 400, true ); //(cropped)
	add_image_size( 'postpic-wtile', 464, 232, true ); //(cropped)
	add_image_size( 'postpic-thumb', 100, 66, true ); //(cropped)
}

// ====================================================
// add custom menu functionality

function register_my_menus() {
	register_nav_menus(
	array(
		'mainmenu-header' => __( 'Header Menu' ),
		'mainmenu-footer' => __( 'Footer Menu' ),
		'mainmenu-mobile' => __( 'Mobile Menu' )
		));
	}
add_action( 'init', 'register_my_menus' );


// ====================================================
// Retreive custom header color from ACF plugin outside the main loop

function getHeaderColor(){
	global $wp_query, $post;
	
	$menucolor = get_field( "acf_header_menu_type", $post->ID );

	if ($menucolor != null) {
		return 'mainmenu-' . $menucolor;
	} else {
		return 'mainmenu-black';
	}

	wp_reset_query();
}

// ====================================================
// change the_excerpt size

function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      }
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
    }

    function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      }
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
    }

// ====================================================
// Filter the way links are spit out so they can use the block view styles.

add_filter( 'wp_list_bookmarks', 'wpse40213_new_classes', 10, 1 );

function wpse40213_new_classes( $html )
{

	// add info intro
    $round1 = str_replace( ' />', ' /><span class="block-info-state"><h3>', $html );

  // snip link from the middle
    $round2 = str_replace( '</a>', ' ', $round1 );

  // divide the 2 pieces.

    $round3 = str_replace( '/><span class="block-info-state">', '/></span><span class="block-info-state">', $round2 );

    return str_replace( "</li>", "</p></span></a></li>", $round3 );
}

// ====================================================
// add pagination in the footer of the blog pages.


function kriesi_pagination($range)
{
     $showitems = ($range * 2)+1;

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
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>LAST &raquo;</a>";
         echo "</div>\n";
     }
}






// ====================================================
// add custom field info to RSS feed.


function fields_in_feed($content) {
    if(is_feed()) {
        $post_id = get_the_ID();
        $imageName = get_post_meta($post_id, "cover_image", true);

        if ($imageName != null) {

	        $output = '/wp-content/quinn-images/blogpost-covers/' . $imageName . '/' . $imageName .'-med.jpg';
        }

        if ($imageName == "") {

				if ( has_post_thumbnail() ) {
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), array( 720,405 ), false, '' );
					$output = $src[0];
				};

        }


	        $content = '<img src="'.$output.'" />' . $content;



    }
    return $content;
}


add_filter('the_content','fields_in_feed');



// ====================================================
// add page slug to body class

function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}

add_filter( 'body_class', 'add_slug_body_class' );


function quinn_admin_theme_style() {
    wp_enqueue_style('quinn-admin-theme', get_stylesheet_directory_uri() . '/library/structure/admin/admin.css');
	wp_enqueue_script('quinn-admin-theme-js', get_stylesheet_directory_uri() . '/library/structure/admin/admin.js');
}
add_action('admin_enqueue_scripts', 'quinn_admin_theme_style');


add_filter('body_class', 'user_body_class');
function user_body_class($classes) {
	global $current_user;
	$classes[] = 'user-' . $current_user->ID;
	return $classes;
}





function custom_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


function add_inline_head_script(){
	global $post;

	// BATCH JS
	if( isset( $post->post_type ) && $post->post_type == 'batch' ) :

		$suppliers = new WP_Query(
			array(
				'post_type'			=> 'supplier',
				'posts_per_page'	=> -1,
			)
		);

		$snacks = new WP_Query(
			array(
				'post_type'			=> 'snack',
				'posts_per_page'	=> -1
			)
		);
	
		foreach( $suppliers->posts as $key => $supplier ) :
			$type = wp_get_post_terms( $supplier->ID, 'supplier_type', array( 'fields' => 'ids' ) );
			if( in_array( 32, $type ) ) :
				$supplier_info['ingredients'][$supplier->ID] = wp_get_post_terms( $supplier->ID, 'ingredient', array( 'fields' => 'ids' ) );
			endif;
			if( in_array( 33, $type ) ) :
				$supplier_info['packagers'][$supplier->ID] = wp_get_post_terms( $supplier->ID, 'packaging_type', array( 'fields' => 'ids' ) );
			endif;
			if( in_array( 34, $type ) ) :
				$supplier_info['producers'][$supplier->ID] = wp_get_post_terms( $supplier->ID, 'production_type', array( 'fields' => 'ids' ) );
			endif;
		endforeach;

		foreach( $snacks->posts as $key => $snack ) :
			$snack_supply['ingredients'][$snack->ID] = wp_get_post_terms( $snack->ID, 'ingredient', array( 'fields' => 'ids' ) );
			$snack_supply['packagers'][$snack->ID] = wp_get_post_terms( $snack->ID, 'packaging_type', array( 'fields' => 'ids' ) );
			$snack_supply['producers'][$snack->ID] = wp_get_post_terms( $snack->ID, 'production_type', array( 'fields' => 'ids' ) );
		endforeach;

		?>
			<script>
				var snack_supply = <?= json_encode( $snack_supply ) ?>;
				var suppliers = <?= json_encode( $supplier_info ) ?>;
			</script>
		<?

	endif;
}

if( is_admin() ) :
	add_action( 'wp_print_scripts', 'add_inline_head_script' );
endif;



// ACF FIELDS


	// INGREDIENTS
	function acf_load_ingredient_field_choices( $field ) {
		$field['choices'] = array();
		$terms = get_terms( 'ingredient' );
		$field['choices'][0] = 'Select an Ingredient';
		foreach( $terms as $key => $term ) $field['choices'][ $term->term_id ] = $term->name;
		return $field;
	}
	add_filter('acf/load_field/name=ingredient', 'acf_load_ingredient_field_choices');
	
	
	// PACKAGERS
	function acf_load_packager_field_choices( $field ) {
		$field['choices'] = array();
		$terms = get_terms( 'packaging_type' );
		$field['choices'][0] = 'Select a Packager';
		foreach( $terms as $key => $term ) $field['choices'][ $term->term_id ] = $term->name;
		return $field;
	}
	add_filter('acf/load_field/name=packager', 'acf_load_packager_field_choices');
	
	
	// PRODUCERS
	function acf_load_producer_field_choices( $field ) {
		$field['choices'] = array();
		$terms = get_terms( 'production_type' );
		$field['choices'][0] = 'Select a Producer';
		foreach( $terms as $key => $term ) $field['choices'][ $term->term_id ] = $term->name;
		return $field;
	}
	add_filter('acf/load_field/name=producer', 'acf_load_producer_field_choices');
	
	
	// SUPPLIER
	function acf_load_supplier_field_choices( $field ) {
		$field['choices'] = array();
		$supplier_types = array(
			'field_5706e88ef1869'	=> 32,
			'field_57111cb60ce4c'	=> 33,
			'field_57111dc40ce50'	=> 34
		);
		$query = new WP_Query(
			array(
				'post_type'			=> 'supplier',
				'posts_per_page'	=> -1,
				'tax_query'			=> array(
					array(
						'taxonomy'	=> 'supplier_type',
						'terms'		=> array( $supplier_types[ $field[ 'key' ] ] )
					)
				)
			)
		);
		foreach( $query->posts as $key => $supplier ) $field['choices'][ $supplier->ID ] = $supplier->post_title;
		return $field;
	}
	add_filter('acf/load_field/name=supplier', 'acf_load_supplier_field_choices');
	
	
	// BATCH ID's
	function acf_load_batch_ids_field_choices( $field ) {
		if( isset( $_GET['post'] ) ) :
			$field['choices'] = array();
			foreach( wp_get_post_terms( $_GET['post'], 'batch_ids' ) as $key => $term ) $field['choices'][ $key ] = $term->name;
		endif;
		return $field;
	}
	add_filter('acf/load_field/name=batch_ids', 'acf_load_batch_ids_field_choices');

?>