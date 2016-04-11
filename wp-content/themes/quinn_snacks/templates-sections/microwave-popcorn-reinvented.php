<?php
/*
Template Name: Microwave Popcorn Reinvented
*/
?>

<?php get_header(); ?>

<div id="reinvented-scroll" class="SectionScroll-wrap">

	<div
	class="SectionScroll reinvented-section"
	style='background: url("<?php bloginfo( 'stylesheet_directory' ); ?>/assets/images/reinvented-slide1-titlev2.png") no-repeat center center'
	data-arrow-color="black"
	>

	</div><!-- section -->

<?php

	if( have_rows('slides') ):

	$slideNum = 2;

		while ( have_rows('slides') ) : the_row(); ?>

		<div class="SectionScroll reinvented-section" data-arrow-color="white"  style='background: url("<?php the_sub_field('background_image'); ?>")' id="section-<?php echo $slideNum; ?>">

		<div class="SectionScroll-inner section-content">



			<?php

				$titleString = '';

				if (get_sub_field('title_type') == 'text') {
					$string = get_sub_field('title_text');
					$titleString = '<h2>' . $string . '</h2>';
				}

				elseif (get_sub_field('title_type') == 'image') {
					$string = get_sub_field('title_image');
					$titleString = '<img src="' . $string . '" />';
				}

				echo $titleString;

			?>

			<div class="description">
				<?php the_sub_field('description'); ?>
			</div>

		</div>

	</div><!-- section -->

<?php

		endwhile;

	else :
		echo 'no rows';

		// now rows found
	endif;
?>


<div id="section-foot" class="SectionScroll">

	<div class="SectionScroll-inner">

		<ul class="footer-icons">

			<li id="find-a-store">
				<a href="<?php bloginfo('url'); ?>/store-locator/">find a store</a>
			</li>

			<li id="buy-online">
				<a href="http://store.quinnpopcorn.com/">buy online</a>
			</li>

			<li id="flavors">
				<a href="<?php bloginfo('url'); ?>/popcorn/microwave-popcorn/">flavors</a>
			</li>

		</ul>

		<div class="clearboth"></div>

</div>
	</div><!-- product foot -->



</div>


<div id="reinvented-scroll-shim"></div>
<?php get_footer(); ?>
