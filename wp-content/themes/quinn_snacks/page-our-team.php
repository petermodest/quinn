<?/* Template Name: Our Team & Story */?>
<? $post = new Post( $post ) ?>

<? get_header() ?>

	<? foreach( $post->sections as $section ) : ?>
		<div class="row" style="background: <?= $section->background_color ?>">
			<h1><?= $section->header ?></h1>
			<div id="link-block-view" >
				<? foreach( $section->boxes as $box ) : ?>
					<div class="block-view-post">
						<div class="block-info-state">
							<? if( $box->link ) : ?><a href="<?= $box->link ?>" target="_blank"><? endif ?>
								<div class="block-info-state-inner">
									<div class="vertical-center">
										<h3><?= $box->header ?></h3>
										<p><?= $box->text ?></p>
									</div>
								</div>
							<? if( $box->link ) : ?></a><? endif ?>
						</div>
						<div class="block-image-state" style="background-image:url(<?= $box->image->url ?>)">
							<img src="<?= img_dir() ?>transparent-square.png" />
						</div>
					</div>
				<? endforeach ?>
			</div>
		</div>
	<? endforeach ?>

<? get_footer() ?>