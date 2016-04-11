<?php
/*
Template Name: Store Locator Fullscreen
*/
?>

<?php get_header(); ?>


<div id="storelocate-wrapper">



	<?php if ( have_posts() ) : ?>


			<?php while ( have_posts() ) : the_post(); ?>
							
							

						<h2><?php the_title(); ?> </h2>

					<div id="storelocate-right">
				
						<?php the_content(); ?> 

						</div><!-- store-rightside -->
					
			
			
				<?php endwhile; endif; ?>



<style type="text/css">

#big_locator {
	padding:0;
	position: absolute;
	width: 100%;
	height: 800px;
	left: 0;
}

</style>


<iframe id="big_locator" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator" frameBorder="0"></iframe>



</div>
<?php get_footer(); ?>



