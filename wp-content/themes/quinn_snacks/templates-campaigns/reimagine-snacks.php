<?
/*
Template Name: Campaign - Reimagine Snacks
*/
?>

<? get_header(); ?>
<? print_a( $post ) ?>
<style type="text/css">

<?
// Begin ACF repeater
	$count=1;
	if( have_rows('section') ):
		while ( have_rows('section') ) : the_row();
?>

	.reimagine-<?= $count ?> {
		background-image: url("<?= get_sub_field('background_image')['url'] ?>");
	}
	.reimagine-<?= $count ?> .section-inner-overlay {
		background-color: <? the_sub_field('photo_overlay_color'); ?>
	}
	.reimagine-<?= $count ?> h1,
	.reimagine-<?= $count ?> a
	 {
		color: <? the_sub_field('title_link_color'); ?>
	}
	.reimagine-<?= $count ?> .box-prefix	{
		background: <? the_sub_field('title_link_color'); ?>
	}

<?

	// end ACF repeater
	$count++;
	endwhile;

endif;

?>
</style>


<div class="SectionScroll-wrap reimagine-wrap">

	<?
	// Begin ACF repeater
		$count=1;
		if( have_rows('section') ):
			while ( have_rows('section') ) : the_row();
	?>

					<?
					$arrowType = null;
					$arrowColor = null;
					if ($count == 5) { $arrowType = 'up';	$arrowColor = 'white';
					} else {
						if ($count % 2 == 0)	{ $arrowType = 'down';	$arrowColor = 'black';}
						else	{ $arrowType = 'down';	$arrowColor = 'white';}
					}
					?>

					<div class="SectionScroll reimagine-section reimagine-<?= $count ?>" data-arrow-color="<?= $arrowColor ?>">


						<!-- Section Content	-->

						<div class="SectionScroll-matchHeight section-inner-overlay"></div>
						<div class="SectionScroll-inner section-inner">

							<? /* video head	*/ if ($count == 5) { echo '<div class="video-intro">'; } ?>

							<h1><? the_sub_field('title_line_1'); ?></h1>
							<? if ( get_sub_field('title_line_2') ) { ?>

								<h1 class="subtitle">
									<span class="box-prefix"></span><? the_sub_field('title_line_2'); ?>
								</h1>

							<? } ?>

							<? the_sub_field('content'); ?>

							<? /* video head	*/ if ($count == 5) { ?>
									<div class="js-playvideo play-button"></div>
								 </div> <!-- video-intro -->

								 <div class="video-container">
									 <video poster="<? bloginfo('stylesheet_directory'); ?>/library/videos/QuinnPopcorn.jpg" controls preload="none" width="100%" height="auto">
									 <source src="<? bloginfo('stylesheet_directory'); ?>/library/videos/QuinnPopcorn.mp4" type="video/mp4">
									 <source src="<? bloginfo('stylesheet_directory'); ?>/library/videos/QuinnPopcorn.webm" type="video/webm">
									 </video>
								 </div>

								 <? }	// close video section ?>

						</div> <!-- .section-inner -->
					</div> <!-- .section -->

					<? if ($count == 1){ ?>
						<div class="SectionScroll-matchHeight reimagine-shim"></div>
					<? } ?>

	<?

		// end ACF repeater
			$count++;
			endwhile;

	else :
	endif;

	?>

</div>



<? get_footer(); ?>
