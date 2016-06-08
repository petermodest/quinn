<?
	/**
	* The loop
	* @package WordPress
	* @subpackage Quinn
	*/
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<? $single = false ?>

<div id="blog-list-view" class="row blog-content" role="main">
	<div class="inner">
		<? if ( have_posts() ) : ?>
			
			<div class="col <? if( ! is_page() ) : ?>span-9 right<? else : ?>span-12<? endif ?>">
				
				<? while ( have_posts() ) : ?>
					<? the_post() ?>
				
					<div id="post-<? the_ID() ?>" <? post_class('inner') ?>>
						
						<?  if ( is_single() ): ?>
							<? $single = true ?>
							
							<div class="blog-single-post">
							
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
						
						<? elseif ( is_archive() || is_search() ) : ?>
							<? $single = true ?>
							
							<div class="archive">
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
		
							<div class="blog-list-rightside">		
						
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
			</div>
	
			<? if( ! is_page() ) : ?>
				<? get_sidebar() ?>
			<? endif ?>				
			
			<? kriesi_pagination( 5 ) ?>
	
		<? else : ?>
	
			<div id="post-0" class="row post no-results not-found">
				<div class="inner">
					<h1><center>Nothing found... want to head back <a href="/">home</a>?</center></h1>
				</div>
			</div>
	
		<? endif ?>
	</div>		
</div><!-- #content -->

