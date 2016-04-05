<? get_header(); ?>

<div id="blog-list-view" class="row blog-content" role="main">
	<div class="inner">
		<div class="col span-9 right search-cat-content">
		
			<? if( have_posts() ) : ?>
	
				<h2 class="blog-category-title">
					<?
						$allsearch = &new WP_Query("s=$s&showposts=-1");
						$key = wp_specialchars($s, 1);
						$count = $allsearch->post_count;
						_e('');
						echo $count . ' ';
						_e('posts contain "');
						echo $key;
						wp_reset_query();					
						query_posts($query_string . '&showposts=99');					
					?>
				</h2>
	
				<? while( have_posts() ) : ?>
					<? the_post() ?>
	
					<a href="<? the_permalink() ?>" rel="bookmark" title="Permanent Link to <? the_title_attribute(); ?>"></a>
					<div class="search-result">
	
						<h3 class="blog-entry-title" id="post-<? the_ID(); ?>">
							<a href="<? the_permalink() ?>" rel="bookmark" title="Permanent Link to <? the_title_attribute(); ?>"><? the_title(); ?></a>
						</h3>
	   
				        <p><? the_excerpt(); ?></p> 
	
					</div><!-- search_result -->
	
				<? endwhile ?>
			
			<? else : ?>
	
				<div id="search-fail">
					<center>
						<br />
						<h2>Nope</h2>
						<p>There don't seem to be any posts that match that term. <br />Would you like to try again?</p>
						<br /><br />
						<? include (TEMPLATEPATH . '/searchform.php'); ?>
					</center>
				</div><!--.search-fail -->
			<? endif ?>
	
			<div class="navigation">
				<div class="alignleft"><? next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><? previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
			
			
		</div><!-- searchpage -->
	
		<? get_sidebar() ?>
	</div>
</div><!-- searchpage -->

<? get_footer(); ?>