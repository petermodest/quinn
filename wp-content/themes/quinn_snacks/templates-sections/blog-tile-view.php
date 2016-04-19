<?
/*
Template Name: Blog Tile View
*/
?>

<? get_header(); ?>

	<script type="text/javascript">
		$(window).load(function () { $("img.lazy").lazyload(); });
	</script>
	
	<div id="blog-block-view" class="blog-content" role="main">
	
	  <? get_template_part( 'parts/sidebar', 'block-view' ); ?>
	
		<?
			$args = array( 'numberposts' => 500 );
			$lastposts = get_posts( $args );
		?>
		<? foreach( $lastposts as $post ) : ?>
			<? setup_postdata( $post ) ?>
			<?
				 if ( get_post_meta($post->ID, 'cover_image', true) ) :
					$imageName = get_post_meta($post->ID, "cover_image", true);
					$src = site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName . '-tile.jpg';
			
				else :
			
					$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "postpic-tile" );
					$src = $thumbnail_src[0];
				endif;
			?>
		
			<div class="block-view-post no-border">
			
				<div class="block-info-state">
					<a href="<? the_permalink() ?>">
						<div class="block-info-state-inner">
							<div class="vertical-center">
								<h3><? the_title() ?></h3>
								<p><?= excerpt(20) ?></p>
							</div>
						</div>
					</a>
				</div><!-- block-info-state -->
			
				<div class="block-image-state" style="background-image: url(<?= $src ?>)">
					
					<div class="block-category">
						<?
							$category = get_the_category();
							echo $category[0]->cat_name;
						?>
					</div><!-- block-category -->
			
					<a href="<? the_permalink(); ?>">
						<img src="<?= img_dir() ?>transparent-square.png" />
					</a>
			
				</div><!-- block-image-state -->
			
			</div><!-- block-view-post -->
		
		<? endforeach ?>
	
	
	<div class="clearboth"></div>
	
	</div><!-- #content -->
	
	<div id="block-view-shim" style="display:block"></div>

<? get_footer(); ?>
