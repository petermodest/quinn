<? get_header(); ?>
	
<div id="blog-list-view" class="row blog-content" role="main">
	<div class="inner">
		<div class="col span-9 right search-cat-content">
		
			<? if( have_posts() ) : ?>
				<? query_posts($query_string . '&showposts=99') ?>	
				<? $post = $posts[0] ?>
				
				<h3 class="blog-category-title">
					<? if( is_category() ) : ?>
						In <i><? single_cat_title() ?></i>
					<? elseif( is_tag() ) : ?>
						Posts Tagged &#8216;<? single_tag_title() ?>&#8217;
					<? elseif( is_day() ) : ?>
						Archive for <? the_time('F jS, Y') ?>
					<? elseif( is_month() ) : ?>
						Archive for <? the_time('F, Y') ?>
					<? elseif( is_year() ) : ?>
						Archive for <? the_time('Y') ?>
					<? elseif( is_author() ) : ?>
						Author Archive
					<? elseif( isset( $_GET['paged'] ) && ! empty( $_GET['paged'] ) ) : ?>
						Blog Archives
					<? endif ?>
				</h3>
			
				<? while( have_posts() ) : ?>
					<? the_post() ?>
				
					<div class="search_left">
				
						<h3 class="blog-entry-title" id="post-<? the_ID(); ?>"><a href="<? the_permalink() ?>" rel="bookmark" title="Permanent Link to <? the_title_attribute(); ?>"><? the_title(); ?></a></h3>
						<small><? the_time( 'l, F jS, Y' ) ?></small>
				
					</div>
					<div class="search_right">
						<? the_excerpt( 'Read the rest of this entry &raquo;' ); ?>
					</div><!-- search_right -->
				
					<br />
					
				<? endwhile; ?>
			
				<div class="navigation">
					<div class="alignleft"><? next_posts_link( '&laquo; Older Entries' ) ?></div>
					<div class="alignright"><? previous_posts_link( 'Newer Entries &raquo;' ) ?></div>
				</div>
			
			<? else : ?>
				<h3 class="blog-category-title">No Posts Found</h3>
			
			<? endif; ?>
		</div>
		
		<? get_sidebar(); ?>
	</div>
</div>

<? get_footer(); ?>