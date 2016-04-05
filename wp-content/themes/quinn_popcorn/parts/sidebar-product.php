<?php 

if (is_page_template('template-product-page.php'))  { ?>

<div id="sidebar-product">

	<ul>
		<li id="sidebar-product-buylink"><a href="http://store.quinnpopcorn.com/" style="background:#<?php echo get_post_meta($post->ID, "title-background", true); ?>">BUY</a></li>
		<li><a href="/popcorn/instructions/">instructions</a></li>
		<li><a class="modal-link">nutrition</a></li>
		<li><a href="/popcorn-reinvented/">reinvented</a></li>
	</ul>
	 
</div><!-- #sidebar-product -->

<?php 

}

if (is_page_template('template-product-page2.php'))  { ?>


<div id="sidebar-product" class="sidebar-product-2">

	<ul>
		<li id="sidebar-product-buylink"><a href="http://store.quinnpopcorn.com/" style="background:#<?php echo get_post_meta($post->ID, "title-background", true); ?>">BUY</a></li>
		<li><a class="modal-link">nutrition</a></li>
		<li id="sidebar-product-farmtobaglink"><a href="/farmtobag/"></a></li>
	</ul>
	 
</div><!-- #sidebar-product -->

<?php } ?>
