<?
/*
Template Name: Store Locator Fullscreen
*/
?>

<? get_header(); ?>


<div id="storelocate-wrapper">



	<? if ( have_posts() ) : ?>


			<? while ( have_posts() ) : the_post(); ?>
							
							

						<h2><? the_title(); ?> </h2>

					<div id="storelocate-right">
				
						<? the_content(); ?> 

						</div><!-- store-rightside -->
					
			
			
				<? endwhile; endif; ?>



<style type="text/css">

#big_locator {
	padding:0;
	position: absolute;
	width: 100%;
	height: 800px;
	left: 0;
}

</style>


<iframe id="big_locator" src="<? bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator" frameBorder="0"></iframe>



</div>
<? get_footer(); ?>



