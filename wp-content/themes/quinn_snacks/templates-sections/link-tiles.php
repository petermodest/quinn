<?
/*
Template Name: Link Tiles
*/
?>

<? get_header() ?>

<div id="link-block-view" >

	<? if( have_rows( 'tiles' ) ) : ?>
		<? while ( have_rows('tiles') ) : ?>
			<? the_row() ?>

			<div class="block-view-post">
				<div class="block-info-state">
					<a href="<? the_sub_field('link') ?>">
						<div class="block-info-state-inner">
							<div class="vertical-center">
								<h3><? the_sub_field('title') ?></h3>
								<p><? the_sub_field('text') ?></p>
							</div>
						</div>
					</a>
				</div>
				<div class="block-image-state" style="background-image: url(<? the_sub_field('image') ?>)">
					<a href="http://localhost:8888/small-the-unfair-advantage/">
						<img src="<?= img_dir() ?>transparent-square.png" />
					</a>
				</div>
			</div>
		<? endwhile ?>

	<? endif ?>
	
</div>

<div id="block-view-shim" style="display:block"></div>

<? if ( have_posts() ) : ?>
	<? while ( have_posts() ) : ?>
		<? the_post() ?>

		<div class="row link-block-subcontent">
			<div class="inner">
				<? the_content(); ?>
			</div>
		</div>

	<? endwhile ?>
<? endif ?>
<br />
<br />

<? get_footer(); ?>
