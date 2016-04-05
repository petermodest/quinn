<?
/*
Template Name: Landing Page
*/
?>

<? get_header(); ?>

	<? get_template_part( 'parts/include', 'supersize' ); ?>

	<? if ( have_posts() ) : ?>
		<? while ( have_posts() ) : ?>
			<? the_post() ?>

			<div class="row">
				<div class="inner">
					<div id="section-home-content" class="col span-7">
						<? the_content() ?>
					</div>
				</div>
			</div>
			
		<? endwhile ?>
	<? endif ?>

	<?
		$background_image_array[] = array(
			'background_image' => site_url('/')  . 'wp-content/quinn-images/product-images/' . get_post_meta($post->ID, "background", true)
		)
	?>
	<script type="text/javascript" >
		jQuery(function($){
			$.supersized({	
				slideshow				: 1,
				autoplay				: 0,
				transition				: 1,
				transition_speed		: 1000,
				keyboard_nav			: 0,
				navigation				: 1,
				slide_captions			: 1,
				slides					: [{ image : '<?= $background_image_array[0]['background_image'] ?>.jpg' }]
			});	
		});	
	</script>

<? get_footer(); ?>
