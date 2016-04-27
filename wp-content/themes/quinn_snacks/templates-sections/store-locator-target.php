	<?
/*
Template Name: Store Locator Target
*/
?>

<? get_header(); ?>


<div id="storelocate-wrapper">





<iframe id="big_locator" src="<? bloginfo( 'stylesheet_directory' ); ?>/library/store-locator-target" frameBorder="0" height="600"></iframe>

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

	<? if ( have_posts() ) : ?>


			<? while ( have_posts() ) : the_post(); ?>
							
							

						<h2><? the_title(); ?> </h2>

					<div id="storelocate-right">
				
						<? the_content(); ?> 

						</div><!-- store-rightside -->
					
			
			
				<? endwhile; endif; ?>



</div>
<? get_footer(); ?>



