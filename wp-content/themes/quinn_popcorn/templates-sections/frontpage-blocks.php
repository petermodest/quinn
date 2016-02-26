<?php
/*
Template Name: Frontpage - Blocks
*/
?>

<?php get_header(); ?>

<div id="frontpage-wrapper">

	<div id="fp-main">

	<?php get_template_part( 'parts/frontpage', 'reimagine-snacks' ); ?>

	</div>

	<div id="fp-halves-wrapper">

			<div class="fp-section">

			<?php query_posts('cat=22&showposts=1'); ?>
			<?php while (have_posts()) : the_post(); ?>

			<?php
				// get image url without the tag
				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'postpic-full'), array(320,240), false, '' );
				echo $src[0];
			?>

				<div class="fp-image" style="background:url(<?php echo $thumbnail_src[0]; ?>) center center no-repeat; background-size: cover;"></div>

				<div class="fp-text">

					<h1 class="fp-supertitle">Blog</h1>
					<h1 class="fp-title"><?php the_title(); ?></h1><br />
					<a class="fp-checkitout" href="<?php the_permalink(); ?>">CHECK IT OUT</a>

				</div>

			<?php endwhile; wp_reset_query();?>

			</div>


			<?php

			$sections = get_field('fp_halfpage_sections');
			$sectioncount = 1;
			if( $sections ):

				foreach( $sections as $section ):
				$sectioncount++;
				?>

					<div class="fp-section">

						<?php if ( $section['fp_color_overlay'] ) { ?>
							<div class="fp-color-overlay" style="background:<?php echo $section['fp_color_overlay']; ?>;"></div>
						<?php	} ?>

						<div class="fp-image" style="background:url(<?php echo $section['fp_image']; ?>) center center no-repeat; background-size: cover;"></div>



						<div class="fp-text">
							<h1 class="fp-supertitle"><?php echo $section['fp_supertitle']; ?></h1>
							<h1 class="fp-title"><?php echo $section['fp_title']; ?></h1><br />
							<a class="fp-checkitout" href="<?php echo $section['fp_link']; ?>">CHECK IT OUT</a>
						</div>

					</div>

			<?php endforeach; endif; ?>

			<?php

				$shimpad = 0;

				if (($sectioncount == 1) || ($sectioncount == 2)) {
					$shimpad = 1100;
				} elseif (($sectioncount == 3) || ($sectioncount == 4)) {
					$shimpad = 1614;
				} elseif (($sectioncount == 5) || ($sectioncount == 6)) {
					$shimpad = 2128;
				} elseif (($sectioncount == 7) || ($sectioncount == 8)) {
					$shimpad = 2643;
				} elseif (($sectioncount == 9) || ($sectioncount == 10)) {
					$shimpad = 3158;
				}
			 ?>
			<div class="clearboth"></div>


	</div><!-- fp-halves-wrapper -->

	<div class="clearboth"></div>

</div><!--frontpage-wrapper"> -->
	<div id="frontpage-wrapper-shim" style="height:<?php echo $shimpad; ?>px"></div>

<?php get_footer(); ?>
