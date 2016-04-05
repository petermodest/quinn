<?/* Template Name: Snack List */?>

<? get_header(); ?>

	<h1>Snacks <span>Reimagined</span></h1>

	<div class="row">
		<div class="inner">
			<? foreach( get_field( 'snack_columns' ) as $column ) : ?>
				<div class="col span-4">
					<h2><?= $column['header_text'] ?></h2>
					<h3><?= $column['subheader'] ?></h3>
					<ul>
						<? $column['permalink'] = get_permalink( $column['snack_section']->ID ) ?>
						<? foreach( get_field( 'flavor', $column['snack_section']->ID ) as $key => $flavor ) : ?>
							<li><a href="<?= $column['permalink'] ?>#<?= str_replace( array(' '), '-', str_replace( '&', 'amp', strtolower( $flavor['title'] ) ) ) ?>"><img src="<?= $flavor['packaging']['url'] ?>" alt="<?= ucfirst( $flavor['title'] ) ?>" title="<?= ucfirst( $flavor['title'] ) ?>"></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
			<? endforeach ?>
		</div>
	</div>

<? get_footer(); ?>