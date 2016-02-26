<?php
/**
 * The loop
 * @package WordPress
 * @subpackage Quinn
 */
?>


<div id="blog-list-view" class="blog-content" role="main">
	
	
		<?php if ( have_posts() ) : ?>

			<?php 
// - - - - - - - -  BEGIN POST TYPES 

			while ( have_posts() ) : the_post(); ?>
			
				<div id="post-<?php the_ID( ); ?>" <?php post_class( ); ?>>



					<?php 
// - - - - - - - - // single post 
					if ( is_single( ) ): ?>
					
					
					<?php get_sidebar(); ?>

					<div class="blog-single-post">
					
					<?php 
					
					 if ( get_post_meta($post->ID, 'cover_image', true) ) : 

						$imageName = get_post_meta($post->ID, "cover_image", true);	

					?>
					
					<img id="header-image" src="<?php echo site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName ;?>-med.jpg" />
		
					
					
					<?php else : if ( has_post_thumbnail() ) { the_post_thumbnail( 'postpic-med' ); } ?>

					<?php endif; ?>
		
					<div class="entry">
						<h3 class="blog-entry-title">
							<?php the_title( ); ?>
						</h3>
						
						
						<div class="blog-entry-content">
							<?php the_content( ); ?>
						</div><!-- .entry-content -->
						
						<?php // comments_template( '', true ); ?>
					
					</div><!-- entry -->	
					
					<?php comments_template(); ?>

					</div><!-- #single-post -->
	
					
					
					<?php 
// - - - - - - - - // page 
					elseif ( is_page( ) ): ?>
					
						<h3 class="entry-title">
							<?php the_title( ); ?>
						</h3>
						
			
					<div id="standard-page-content">
					
						<?php the_content(); ?> 
					
					</div>
				
			
						
					<?php 
// - - - - - - - -  archive or is search pages
					elseif ( is_archive( ) || is_search( ) ): ?>

						<h3 class="entry-title">
							<a href="<?php the_permalink( ); ?>" title="<?php echo esc_attr__( 'Permalink to ' . the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title( ); ?></a>
						</h3>
						
						<div class="entry-meta">
							<?php if (get_comments_number( ) > 0): ?>
								<span class="sep">&nbsp;&#8212;&nbsp;</span>
								<a href="<?php comments_link(); ?>">
									<?php echo _n( '1 Comment', number_format_i18n( get_comments_number( )) . ' Comments', get_comments_number( ) );?>
								</a>
							<?php endif; ?>
						</div><!-- .entry-meta -->
						
						<div class="entry-excerpt">
							<?php echo excerpt(50); ?> ?>
						</div><!-- .entry-excerpt -->
						
						
						
						
					<?php 
// - - - - - - - -  regular listing of posts (home) 
					else: ?>
						
						<?php get_sidebar(); ?>

					<div class="blog-list-rightside">		
					
					<?php 
					
					 if ( get_post_meta($post->ID, 'cover_image', true) ) : 

						$imageName = get_post_meta($post->ID, "cover_image", true);	

					?>
					
					<img id="header-image" src="<?php echo site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName ;?>-med.jpg" />
		

					<?php else : if ( has_post_thumbnail() ) { the_post_thumbnail( 'postpic-med' ); } ?>

					<?php endif; ?>
					
					

					
					<div class="blog-entry">
						<h3 class="blog-entry-title">
							<a href="<?php the_permalink( ); ?>" title="<?php echo esc_attr__( 'Permalink to ' . the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title( ); ?></a>
						</h3>
						
						
						<div class="blog-entry-content">

							<?php the_excerpt( ); ?>

						</div><!-- .entry-content -->
						</div><!-- .entry-content -->
						
					</div><!-- blog-list-rightside -->
						
						
					<?php
// - - - - - - - -  END OF TYPES 

					 endif; ?>
					
					</div><!-- post-whatever -->
					
			<?php endwhile; ?>

		<?php else : ?>

			<div id="post-0" class="post no-results not-found">
				
					<h1>Nothing found .... want to head back home?</h1>	
				
			</div><!-- .post -->

		<?php endif; ?>
		
<?php kriesi_pagination(5); ?>
<br />
		
</div><!-- #content -->

