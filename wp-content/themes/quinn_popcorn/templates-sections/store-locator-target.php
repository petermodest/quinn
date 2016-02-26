	<?php
/*
Template Name: Store Locator Target
*/
?>

<?php get_header(); ?>


<div id="storelocate-wrapper">





<iframe id="big_locator" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator-target" frameBorder="0" height="600"></iframe>

<style type="text/css">

#big_locator {
	padding:0;
	margin-top: -20px;
	position: absolute;
	width: 100%;
	height: 800px;
	left: 0;
}

#store-locator-shim {
	height: 500px;
	display: block;
}

</style>

<div id="store-locator-shim"></div>

	<?php if ( have_posts() ) : ?>


			<?php while ( have_posts() ) : the_post(); ?>
							
							

						<h2><?php the_title(); ?> </h2>

					<div id="storelocate-right">
				
						<?php the_content(); ?> 

						</div><!-- store-rightside -->
					
			
			
				<?php endwhile; endif; ?>



</div>
<?php get_footer(); ?>



