<?
/*
Template Name: Microwave Popcorn Reinvented
*/
?>

<? get_header(); ?>

<div id="reinvented-scroll" class="SectionScroll-wrap">

	<div
	class="SectionScroll reinvented-section"
	style='background: url("<?= img_dir() ?>reinvented-slide1-titlev2.png") no-repeat center center'
	data-arrow-color="black"
	>

	</div><!-- section -->

<?

	if( have_rows('slides') ):

	$slideNum = 2;

		while ( have_rows('slides') ) : the_row(); ?>

		<div class="SectionScroll reinvented-section" data-arrow-color="white"  style='background: url("<? the_sub_field('background_image'); ?>")' id="section-<? echo $slideNum; ?>">

		<div class="SectionScroll-inner section-content">



			<?

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
				<? the_sub_field('description'); ?>
			</div>

		</div>

	</div><!-- section -->

<?

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
				<a href="<? bloginfo('url'); ?>/store-locator/">find a store</a>
			</li>

			<li id="buy-online">
				<a href="http://store.quinnpopcorn.com/">buy online</a>
			</li>

			<li id="flavors">
				<a href="<? bloginfo('url'); ?>/popcorn/microwave-popcorn/">flavors</a>
			</li>

		</ul>

		<div class="clearboth"></div>

</div>
	</div><!-- product foot -->



</div>


<div id="reinvented-scroll-shim"></div>
<? get_footer(); ?>
