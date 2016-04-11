<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

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

	global $wp_query;
	$postid = $wp_query->post->ID;

//	$menucolor = get_post_meta($postid, "header-color", true);
	$menucolor = get_field("acf_header_menu_type", $postid);

	if ($menucolor != null) {
		return 'mainmenu-' . $menucolor;
	}

	if ($menucolor == null) {
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
    wp_enqueue_style('quinn-admin-theme', get_stylesheet_directory_uri() . 'library/stylesheets/admin/admin.css');
}
add_action('admin_enqueue_scripts', 'quinn_admin_theme_style');


add_filter('body_class', 'user_body_class');
function user_body_class($classes) {
	global $current_user;
	$classes[] = 'user-' . $current_user->ID;
	return $classes;
}

?>
