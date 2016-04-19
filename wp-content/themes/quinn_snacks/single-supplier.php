<? get_header() ?>

	<div id="page-template-content" class="row">
		<div class="inner">
			<h2 class="page-title"><?= $post->post_title ?></h2>
			<div class="cms">
				<?= apply_filters('the_content', $post->post_content ) ?>
			</div>
		</div>
	</div>

<? get_footer() ?>