<?php
/*
Template Name: Landing Page
*/
?>

<?php get_header(); ?>

<?php get_template_part( 'parts/include', 'supersize' ); ?>


		<?php if ( have_posts() ) : ?>


			<?php while ( have_posts() ) : the_post(); ?>

				<div id="section-home-content">

					<?php the_content(); ?>

				</div>

				<?php
				  $background_image_array[] = array(

	    							'background_image' => site_url('/')  . 'wp-content/quinn-images/product-images/' . get_post_meta($post->ID, "background", true)

	    							);
	    	?>

				<?php endwhile; endif; ?>


	    <script type="text/javascript" >

			jQuery(function($){


				$.supersized({

					slideshow				:   1,
					autoplay				:	0,
					transition				:   1,
					transition_speed		:	1000,
					keyboard_nav			:   0,
					navigation				:   1,
					slide_captions			:   1,
					slides 					:  	[

					<?php


						echo "{ image : '" . $background_image_array[0]['background_image'] . ".jpg' }
									\n
									";


						?>

						]
				});

	    });

		</script>

<?php get_footer(); ?>
