<?
/*
Template Name: Reviews
*/
?>


<? get_header(); ?>


<script type="text/javascript">

	$(window).load(function () { $("img.lazy").lazyload(); });

</script>

<h1>REVIEWS</h1>

<div id="blog-block-view" class="blog-content" role="main">

  <? get_template_part( 'parts/sidebar', 'block-view' ); ?>


<?
$args = array( 'numberposts' => 500 );
$lastposts = get_posts( $args );

foreach($lastposts as $post) : setup_postdata($post); ?>

<div class="block-view-post">

	<div class="block-info-state">

			<h3><a href="<? the_permalink(); ?>"><? the_title(); ?></a></h3>

			<p><? echo excerpt(20); ?></p>

	</div><!-- block-info-state -->

	<div class="block-image-state">

		<div class="block-category">
			<?
				// show first category only
				$category = get_the_category();
				echo $category[0]->cat_name;
			?>
		</div><!-- block-category -->

		<a href="<? the_permalink(); ?>">

			<?

				$tempimg = img_dir() . 'lazy-holder.gif';

			// ============================================
			//    if the thumbnail is via a custom field

			 if ( get_post_meta($post->ID, 'cover_image', true) ) :

				$imageName = get_post_meta($post->ID, "cover_image", true);	 ?>

				<img id="header-image" src="<? echo $tempimg ?>" class="lazy" data-original="<? echo site_url('/') . "wp-content/quinn-images/blogpost-covers/" . $imageName . "/" . $imageName ;?>-tile.jpg" />


			<?
			// ============================================
			//    if the thumbnail is via a post_thumbnail

			else :

				$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "postpic-tile" );

				$default_attr = array(
				    'src' => $tempimg,
				    'data-original' => $thumbnail_src[0],
				    'class' => "lazy",
				);

				the_post_thumbnail('postpic-tile', $default_attr);

			 endif; ?>

		</a>

	</div><!-- block-image-state -->

</div><!-- block-view-post -->

<? endforeach; ?>


<div class="clearboth"></div>

</div><!-- #content -->

<div id="block-view-shim" style="display:block"></div>

<? get_footer(); ?>
