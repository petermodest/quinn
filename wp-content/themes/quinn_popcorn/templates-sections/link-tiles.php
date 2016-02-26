<?php
/*
Template Name: Link Tiles
*/
?>

<?php get_header(); ?>

<div id="link-block-view" >

<?php

	if( have_rows('tiles') ):

		// loop through the rows of data
		while ( have_rows('tiles') ) : the_row(); ?>

			<div class="block-view-post">
				<div class="block-info-state">
					<div class="block-info-state-inner">

						<h3><a href="<?php the_sub_field('link');  ?>"><?php the_sub_field('title'); ?></a></h3>
						<p><?php the_sub_field('text');  ?></p>

					</div><!-- block-info-state -->
				</div><!-- block-info-state -->

				<div class="block-image-state">

					<a href="http://localhost:8888/small-the-unfair-advantage/">
						<img width="350" height="350" src="<?php the_sub_field('image'); ?>" />
					</a>

				</div><!-- block-image-state -->

			</div><!-- block view post -->

<?php endwhile;

		else :

			// no rows found

		endif;


?>



</div>

<div id="block-view-shim" style="display:block"></div>

<?php if ( have_posts() ) : ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<div class="link-block-subcontent">

		<?php the_content(); ?>

	</div>

<?php endwhile; endif; ?>
<br />
<br />
<?php get_footer(); ?>
