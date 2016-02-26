
<?php get_header(); ?>
<?php get_sidebar(); ?>


<div id="blog-list-view" class="blog-content" role="main">
<div class="search-cat-content">
	
	<?php if (have_posts()) : ?>



<h2 class="blog-category-title">
<?php


$allsearch = &new WP_Query("s=$s&showposts=-1");
$key = wp_specialchars($s, 1);
$count = $allsearch->post_count;
_e('');
echo $count . ' ';
_e('posts contain "');
echo $key;

wp_reset_query();

/*
YO, this is how you get it to show more results than are allowed through the normal loop.
*/
query_posts($query_string . '&showposts=99');
/*
Yeah, that line. Right there. Above this one. 
*/

?></h2>



	

		<?php while (have_posts()) : the_post(); ?>

<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
<div class="search-result">

<h3 class="blog-entry-title" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
       
       
          <p><?php the_excerpt(); ?></p> 
          


</div><!-- search_result -->

		<?php endwhile; ?>
	<?php else : ?>

<div id="search-fail">

	<center>
	<br />
	<h2>Nope</h2>
	<p>There don't seem to be any posts that match that term. <br />Would you like to try again?</p>
	<br /><br />
	
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	
	</center>

</div><!--.search-fail -->


	<?php endif; ?>

	<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>

</div><!-- searchpage -->
</div><!-- searchpage -->

<?php get_footer(); ?>