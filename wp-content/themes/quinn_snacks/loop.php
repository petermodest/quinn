<?
/**
* The loop
* @package WordPress
* @subpackage Quinn
*/
?>

<? $single = false ?>

<div id="blog-list-view" class="row blog-content" role="main">
	<? if ( have_posts() ) : ?>

		<? while ( have_posts() ) : ?>
			<? the_post() ?>
		
			<div id="post-<? the_ID() ?>" <? post_class('inner') ?>>
				
				<?  if ( is_single() ): ?>
					<? $single = true ?>
					
					<div class="col span-9 right blog-single-post">
					
						<? if ( get_post_meta($post->ID, 'cover_image', true) ) : ?>
							<? $imageName = get_post_meta($post->ID, "cover_image", true) ?>
							<img id="header-image" src="<?= site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName ?>-med.jpg" />
						
						<? elseif( has_post_thumbnail() ) : ?>
							<? the_post_thumbnail( 'postpic-med' ) ?>
		
						<? endif ?>

						<div class="entry">
							<h3 class="blog-entry-title">
								<? the_title() ?>
							</h3>

							<div class="blog-entry-content">
								<? the_content() ?>
							</div>
						</div>
						
						<? comments_template() ?>
		
					</div>
				
					<? get_sidebar() ?>
				
				<? elseif ( is_page() ) : ?>
					<? $single = true ?>
					
					<h3 class="entry-title">
						<? the_title() ?>
					</h3>
					
					<div id="standard-page-content">
						<? the_content() ?> 			
					</div>		
					
				<? elseif ( is_archive() || is_search() ) : ?>
					<? $single = true ?>
					
					<div class="col span-9">
						<h3 class="entry-title">
							<a href="<? the_permalink() ?>" title="<?= esc_attr__( 'Permalink to ' . the_title_attribute( 'echo=0' ) ) ?>" rel="bookmark"><? the_title() ?></a>
						</h3>
						
						<div class="entry-meta">
							<? if ( get_comments_number() > 0 ) : ?>
								<span class="sep">&nbsp;&#8212;&nbsp;</span>
								<a href="<? comments_link() ?>">
									<?= _n( '1 Comment', number_format_i18n( get_comments_number()) . ' Comments', get_comments_number() ) ?>
								</a>
							<? endif ?>
						</div>
						
						<div class="entry-excerpt">
							<?= excerpt( 50 ) ?>
						</div>
					</div>
					
				<? else : ?>

					<div class="col span-9 right blog-list-rightside">		
				
						<? if ( get_post_meta( $post->ID, 'cover_image', true ) ) : ?>
							<? $imageName = get_post_meta($post->ID, "cover_image", true) ?>		
							<img id="header-image" src="<? echo site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName ?>-med.jpg" />
	
						<? elseif( has_post_thumbnail() ) : ?>
							<? the_post_thumbnail( 'postpic-med' ) ?>
	
						<? endif ?>
				
						<div class="blog-entry">
							<h3 class="blog-entry-title">
								<a href="<? the_permalink() ?>" title="<? echo esc_attr__( 'Permalink to ' . the_title_attribute( 'echo=0' ) ) ?>" rel="bookmark"><? the_title() ?></a>
							</h3>
										
							<div class="blog-entry-content">
								<? the_excerpt() ?>
							</div>
						</div>
					
					</div>
					
				<? endif ?>
				
			</div>
				
		<? endwhile ?>

	<? else : ?>

		<div id="post-0" class="row post no-results not-found">
			<div class="inner">
				<h1><center>Nothing found... want to head back <a href="/">home</a>?</center></h1>
			</div>
		</div>

	<? endif ?>

	<? if ( have_posts() ) : ?>
		<? if( ! $single ) : ?>
			<? get_sidebar() ?>
		<? endif ?>
		
		<? kriesi_pagination( 5 ) ?>
	<? endif ?>
		
</div><!-- #content -->

