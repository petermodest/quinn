<?/* Template Name: Farm to Bag */?>
<?	
	if( isset( $_GET['batch-number'] ) ) :
		$args = array(
			'post_type'			=> 'batch',
			'posts_per_page'	=> 1,
			'orderby'			=> 'title',
			'order'				=> 'DESC',
			'tax_query'			=> array(
				array(
					'taxonomy'	=> 'batch_ids',
					'field'		=> 'name',
					'terms'		=> $_GET['batch-number']
				)
			)
		);
		$batch = new WP_Query( $args );
		if( count( $batch->posts ) > 0 ) :
			$batch = new Batch( $batch->posts[0] );
		else :
			$batch = false;
		endif;
	else :
		$batch = new Batch();
		$batch->get_all_suppliers();
	endif;
?>

<? get_header() ?>
	
	<div class="row">
		<div class="inner">
			<h1><img src="<?= img_dir() ?>farm-to-bag.png" alt="Farm to Bag" /></h1>
			<div class="map">
				<img src="<?= $post->map->url ?>" class="base" />
				<? if( ! $batch ) : ?>
					<div class="none-found">
						<div class="vertical-center">
							<h4>No Batch Found</h4>
							<h5><a href="<?= get_permalink( $post->ID ) ?>">See all our suppliers and growers</a></h5>
							<form class="filter-batch">
								<h6>Or input your batch number below</h6>
								<div class="input-wrap">
									<input type="text" name="batch-number" placeholder="Your Batch Number" />
									<button>GO</button>
								</div>
							</form>
						</div>
					</div>
				<? elseif( count( $batch->map_overlays ) > 0 ) : ?>
					<? foreach( $batch->map_overlays as $overlay ) : ?>
						<img src="<?= $overlay ?>" class="overlay" />
					<? endforeach ?>
				<? else : ?>
					<img src="<?= $post->full_overlay->url ?>" class="overlay" />
				<? endif ?>
			</div>			
		</div>
	</div>
	
	<? if( $batch ) : ?>
		<div class="row">
			<section>
				<a class="button why-transparency mobile">Why is transparency<br /> so important</a>
				<? if( isset( $_GET['batch-number'] ) && isset( $_GET['flavor'] ) ) : ?>
					<h4>Batch <?= $_GET['batch-number'] ?>  <? foreach( $batch->snacks as $snack ) if( $snack->ID == $_GET['flavor'] ) echo $snack->post_title ?> Growers & Suppliers:</h4>
				<? elseif( isset( $_GET['batch-number'] ) ) : ?>
					<div class="select-flavor">
						<h4>Filter by Flavor:</h4>
						<ul>
							<? foreach( $batch->snacks as $snack ) : ?>
								<li><a href="?batch-number=<?= $batch->post_title ?>&flavor=<?= $snack->ID ?>"><?= $snack->post_title ?></a></li>
							<? endforeach ?>
						</ul>
					</div>
					<h4>Batch <?= $_GET['batch-number'] ?> Growers & Suppliers:</h4>
				<? else : ?>
					<form class="filter-batch">
						<h4>Filter by Batch</h4>
						<div class="input-wrap">
							<input type="text" name="batch-number" placeholder="Your Batch Number" />
							<button>GO</button>
						</div>
					</form>
					<h4>All of Our Growers & Suppliers:</h4>
				<? endif ?>
				<a class="button why-transparency desktop">Why is transparency<br /> so important</a>
			</section>
		</div>
		<div class="row no-padding block-wrap">
			<? foreach( $batch->blocks as $block ) : ?>
				<div class="col span-3 block">
					<div class="front" style="background-image: url( <?= $block->image ?> )">
						<div class="key" style="background-color: <?= $block->color ?>">
							<img src="<?= $block->icon ?>" />
						</div>
					</div>
					<div class="back">
						<h2 style="background-color: <?= $block->color ?>"><?= $block->title ?></h2>
						<div class="inner-content">
							<? if( $block->deep ) : ?>
								<div>
									<span style="background-color: <?= $block->color ?>"><?= $block->deep ?></span>
									Layers Deep (<a href="#" class="whats-this">what's this?</a>)
								</div>
							<? endif ?>
							<div>
								<label style="color: <?= $block->color ?>">Supplier:</label>
								<? if( $block->website ) : ?><a href="<?= $block->website ?>" target="_blank"><? endif ?>
								<?= $block->supplier ?>
								<? if( $block->website ) : ?></a><? endif ?>
							</div>
							<? if( $block->location ) : ?>
								<div>
									<label style="color: <?= $block->color ?>"><?= $block->location_text ?>:</label>
									<?= $block->location ?>
								</div>
							<? endif ?>
							<? if( $block->overview ) : ?>
								<div>
									<label style="color: <?= $block->color ?>">Overview:</label>
									<?= $block->overview ?>
								</div>
							<? endif ?>
							<? if( $block->link ) : ?>
								<div class="bottom-link">
									<a href="<?= $block->permalink ?>">See The Farm</a>
								</div>
							<? endif ?>
						</div>
					</div>
				</div>
			<? endforeach ?>
		</div>
	<? endif ?>
		
<? get_footer() ?>