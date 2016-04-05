<? get_header() ?>

	<? if ( have_posts() ) : ?>
		<? while ( have_posts() ) : ?>
			<? the_post() ?>
			<div id="page-template-content" class="row">
				<div class="inner">
					<? the_content() ?>
				</div>
			</div>
		<? endwhile ?>
	<? endif ?>

<? get_footer() ?>