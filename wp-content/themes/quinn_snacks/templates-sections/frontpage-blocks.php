<?
/*
Template Name: Frontpage - Blocks
*/
?>

<? get_header(); ?>

<div id="frontpage-wrapper">

	<div id="fp-main">
		<? get_template_part( 'parts/frontpage', 'reimagine-snacks' ); ?>
		<?
			/* <div class="fp-reimagine-header reimagine-section" style="background-image: url(<?= get_field('fp_top_image' ) ?>);">
			<div class="reimagine-header-inner">
				<div class="section-inner-overlay" style="background-color: <?= get_field( 'fp_top_color_overlay' ) ?>"></div>
				<div class="fp-reimagine-inner">
					<div class="js-reimagine-title fp-reimagine-title load-hidden"><?= get_field( 'fp_top_text' ) ?></div>
				</div>
			</div>
		</div>
		*/ ?>
	</div>

	<div id="fp-halves-wrapper" class="row no-padding">

			<div class="col span-6 fp-section">

				<? query_posts( 'cat=22&showposts=1' ); ?>
				<? while( have_posts() ) : ?>
					<? the_post() ?>
	
					<? $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'postpic-full'), array(320,240), false, '' ); ?>
	
					<div class="fp-image" style="background-image:url(<?= $thumbnail_src[0] ?>); background-size: cover; background-position: center center;"></div>
	
					<div class="fp-text">
						<h1 class="fp-supertitle">Blog</h1>
						<h1 class="fp-title"><? the_title() ?></h1>
						<a class="fp-checkitout" href="<? the_permalink(); ?>">CHECK IT OUT</a>
					</div>
	
				<? endwhile ?>
				<? wp_reset_query() ?>

			</div>
			<? foreach( get_field('fp_halfpage_sections') as $section ) : ?>
				<div class="col span-6 fp-section">

					<? if ( $section['fp_color_overlay'] ) : ?>
						<div class="fp-color-overlay" style="background-color:<?= $section['fp_color_overlay'] ?>;"></div>
					<? endif ?>

					<div class="fp-image" style="background-image:url(<?= $section['fp_image'] ?>); background-size: cover; background-position: center center;"></div>

					<div class="fp-text">
						<h1 class="fp-supertitle"><?= $section['fp_supertitle'] ?></h1>
						<h1 class="fp-title"><?= $section['fp_title'] ?></h1>
						<a class="fp-checkitout" href="<?= $section['fp_link'] ?>">CHECK IT OUT</a>
					</div>

				</div>
			<? endforeach ?>

	</div><!-- fp-halves-wrapper -->

	<div class="clearboth"></div>

</div><!--frontpage-wrapper"> -->

<? get_footer(); ?>
