<div id="sidebar">

		<h3 id="search-title">Search</h3>
		

			<form method="get" action="<?php bloginfo('url'); ?>/">
			<input type="text" name="s" placeholder="search term" class="form-text"  value="<?php the_search_query(); ?>" />
			<input type="submit" value=" " class="form-submit form-search" />
		</form>

		<h3><a href="http://www.quinnsnacks.com/blog-tile/">Back to Tile View</a></h3>

		<h3>Categories</h3>
			<ul>
			 <?php wp_list_categories('title_li='); ?> 
			</ul>

		<h3>Our Recent Favorites</h3>
	
		<ul>
			<?php get_archives('postbypost', '5', 'custom', '<li>', '</li>'); ?>
		</ul>
	
		<h3>Follow Along</h3>
<form action="http://quinnpopcorn.us4.list-manage.com/subscribe/post?u=5547f550ffea69fface2db29d&amp;id=df235ac8cf" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

			<input type="email" value="" name="EMAIL" type="text" placeholder="email address" class="form-text" />
			<input type="submit" value=" " name="subscribe" class="form-submit" />
		</form>

		<div id="sidebar-social-buttons" class="social-buttons">
				
<div class="fb-like" data-href="https://www.facebook.com/QuinnPoP" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>

			<a class="instagram-button" href="https://www.facebook.com/QuinnPoP?fref=ts"></a>
			<a class="facebook-button" href="https://www.facebook.com/QuinnPoP?fref=ts"></a>
			<a class="twitter-button" href="https://twitter.com/quinnpopcorn"></a>
		</div>


	<p>like us and we’ll love you (exclusions apply)</p>
	
	
	
</div><!-- #sidebar -->

