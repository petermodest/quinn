<?
	/*
	Template Name: Store Locator
	*/
?>

<? get_header(); ?>


<div id="storelocate-wrapper">

	<iframe id="big_locator" src="<? bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator" frameBorder="0" height="600"></iframe>
	
	<div id="store-locator-shim"></div>
	
	<? if ( have_posts() ) : ?>
		<? while ( have_posts() ) : ?>
			<? the_post() ?>
	
			<div class="row">
				<div class="inner">
					<h2><? the_title() ?></h2>		
					<div id="storelocate-right">
						<? the_content() ?>
					</div>
				</div>
			</div>
	
		<? endwhile ?>
	<? endif ?>

</div>
<? get_footer(); ?>

