<? get_header() ?>

	<h1>Snacks <span>Reimagined</span></h1>

	<div class="row">
		<div class="inner">
			
			<? foreach( array( 1681, 1682, 1683 ) as $snack ) : ?>
				<? $snack = new Snack( $snack ) ?>
				<div class="col span-4">
					<h2><?= $snack->post_title ?></h2>
					<h3><?= $snack->subheader ?></h3>
					<ul>
						<? foreach( $snack->flavors as $key => $flavor ) : ?>
							<li><a href="<?= $flavor->permalink ?>"><img src="<?= $flavor->packaging->url ?>" alt="<?= $flavor->post_title ?>" title="<?= $flavor->post_title ?>"></a></li>
						<? endforeach ?>
					</ul>
				</div>
			<? endforeach ?>
		</div>
	</div>

<? get_footer() ?>