<?php get_header(); ?>
<?php get_sidebar(); ?>


<div id="blog-list-view" class="blog-content" role="main">
<div class="search-cat-content">

		<?php if (have_posts()) : 
		
		query_posts($query_string . '&showposts=99');

		
		?>


 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="blog-category-title">In <i><?php single_cat_title(); ?></i></h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="blog-category-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3 class="blog-category-title">Archive for <?php the_time('F jS, Y'); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="blog-category-title">Archive for <?php the_time('F, Y'); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3 class="blog-category-title">Archive for <?php the_time('Y'); ?></h3>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3 class="blog-category-title">Author Archive</h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3 class="blog-category-title">Blog Archives</h3>
 	  <?php } ?>


		<?php while (have_posts()) : the_post(); ?>
				
<div class="search_left">

<h3 class="blog-entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
<small><?php the_time('l, F jS, Y') ?></small>

</div>
<div class="search_right">
<?php the_excerpt('Read the rest of this entry &raquo;'); ?>

</div><!-- search_right -->

<br />
				

		<?php endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

	<?php else : ?>

		<h3 class="blog-category-title">No Posts Found</h3>


	<?php endif; ?>
	</div>

	</div>


<?php get_footer(); ?>
