<?php
/*
Template Name: Frontpage - Fullscreen
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'part', 'supersize' ); ?>


<?php
	// retreive recent post info and insert it in to the $recent_post_array to
	// be spat back out in to the supersized.js options

	// initialize array
	$recent_post_array = array();

	query_posts("showposts=-1&order=asc&limit=3");


$args = array( 'category' => 22 );
$lastposts = get_posts( $args );

foreach($lastposts as $post) : setup_postdata($post);

	 if ( get_post_meta($post->ID, 'cover_image', true) ) :

		$imageName = get_post_meta($post->ID, "cover_image", true);
		$large_url = site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName . '.jpg';
		$thumb_url = site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName . '-thumb.jpg';

	else :

		$large_array =wp_get_attachment_image_src( get_post_thumbnail_id(), 'postpic-full');
		$large_url = $large_array[0];
		$thumb_array =wp_get_attachment_image_src( get_post_thumbnail_id(), 'postpic-thumb');
		$thumb_url = $thumb_array[0];

	endif;

    $recent_post_array[] = array(
	    							'permalink' => get_permalink(),
	    							'title' => get_the_title(),
	    							'cover_image' => $large_url,
	    							'cover_thumb' => $thumb_url,
	    							'excerpt' => excerpt(15),
	    							);



 endforeach; ?>

	    <script type="text/javascript" >

			jQuery(function($){


				$.supersized({

					slideshow				:   1,
					autoplay				:	1,
					slide_interval : 7000,
					transition				:   1,
					transition_speed		:	1000,
					keyboard_nav			:   0,
					navigation				:   1,
					slide_captions			:   1,
					slides 					:  	[

					<?php

				// populate slide information using the $recent_post_array

					for ($i = 0; $i <= (count($recent_post_array) - 1); $i++)
						{
						echo "{
								image : '" . $recent_post_array[$i]['cover_image'] . "',
								title : '<div id=\"h2-title-bg\"></div><h2>" . $recent_post_array[$i]['title'] . "</h2><a id=\"post-link\"  href=\"" .  $recent_post_array[$i]['permalink'] . "\">CHECK IT OUT</a><p>" . $recent_post_array[$i]['excerpt'] . "</p>',
								thumb : '" . $recent_post_array[$i]['cover_thumb']. "'}";

						if ($i <= (count($recent_post_array) - 2)) {echo ",";}

						echo "\n"; // some space so we can see what we're doing.
						}
						?>

						]
				});

		    });

		</script>

<?php get_footer(); ?>
