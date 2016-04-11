<?php
/*
Template Name: Product Scroll
*/
?>

<?php get_header(); ?>


	<div id="product-scroll" class="SectionScroll-wrap" data-scrolltype="<?php the_field('template_type'); ?>">

<!-- ***************** PRODUCT TITLES *****************  -->

	<div class="sticky_shim"></div>
	<div
		id="product-scroll-titles"
		style="background:url(<?php the_field('header_image'); ?>) right center no-repeat fixed; background-size:cover;" >

		<ul></ul>

	</div><!-- product-scroll-titles -->

	<div id="product-content"></div>

<!-- ***************** PRODUCT INFO (_ TEMPLATE) *****************  -->

	<script type="text/template" id="product-template">

<!-- +++++++++++++ Product Callout +++++++++++++ -->

			<div
				id="product-callout"
				class="SectionScroll scroll-pane"
				data-arrow-color="white"
				style="background: url(<%= product.bg_image %>) right center no-repeat; background-size:cover;" >

				<div class="SectionScroll-inner scroll-pane-content">

					<h2 style="color:#<%= product.color %>;" >
						<%= product.tagline_above %></h2>

				</div>

			</div><!-- product-callout -->



<!-- +++++++++++++ MICROWAVE : Reinvented +++++++++++++ -->

<?php if( in_array( get_field('template_type'), array( 'microwave', 'pretzels' ) ) ) { ?>

			<div
				id="product-reinvented"
				class="scroll-pane SectionScroll"
				data-arrow-color="white"<? if( get_field('template_type') == 'pretzels' ) : ?> style="background-image:url(/wp-content/themes/quinn_popcorn/assets/images/pretzels-reimagined-2.png); background-color: #74dd67;"<? endif ?>>

				<div class="product-reinvented-inner"<? if( get_field('template_type') == 'pretzels' ) : ?> style="padding-top: 5%"<? endif ?>>

					<h1><span></span>Reimagined</h1>

					<?php the_field('reinvented_text'); ?>

				</div>

			</div><!-- product-reinvented -->

<!-- +++++++++++++ MICROWAVE : FARM TO BAG +++++++++++++ -->

<?php } if (get_field('template_type') == 'popped') { ?>

			<div
				id="product-farmtobag"
				class="scroll-pane SectionScroll"
				data-arrow-color="white" >

				<div class="SectionScroll-inner">

					<h1><span></span>Reimagined</h1>

					<?php the_field('farm_to_bag_text'); ?>

						<div id="f2b-form">

							<form action="/farmtobag/view.php" method="GET">

								<div class="f2b-logo"></div>
								<div class="clearboth"></div>
								<div class="f2b-arrow">
									<div class="f2b-arrow-inner">

										<input type="text" placeholder="your batch #" name="id">

										<input type="submit" value="GO" />
										<span class="type-or">or</span>

										<a id="link-currentbatch" href="/farmtobag/view.php?id=<?php echo file_get_contents('http://www.quinnsnacks.com/farmtobag/recent_batch.php'); ?>">Current Batch</a>

									</div>
								</div>
							</form>

						</div>

					</div> <!-- Scrollsection-inner -->

					<div class="clearboth"></div>

			</div><!-- product-farmtobag -->

<?php }  ?>

<!-- +++++++++++++ INGREDIENTS +++++++++++++ -->

			<div id="slider-product-ingredients"
				class="SectionScroll"
				data-arrow-color="white"<? if( get_field('template_type') == 'pretzels' ) : ?> style="background-image: url(/wp-content/themes/quinn_popcorn/assets/images/sorghum.jpg)"<? endif ?>>


					<div class="product-ingredients-wrapper">

					<img class="product-ingredients-title" src="<?php bloginfo('stylesheet_directory') ?>/assets/images/product-ingredient-title.png" />


					<img src="<%= product.ingredients %>" />

					<? if( get_field('template_type') == 'microwave' ) : ?>
						<a href="/m-nutritional-info/ " id="view-nutrition-info">view nutrition info</a>

					<? elseif( get_field('template_type') == 'popped' ) : ?>
						<a href="/p-nutritional-info/" id="view-nutrition-info">view nutrition info</a>

					<? elseif( get_field('template_type') == 'pretzels' ) : ?>
						<a href="/pretzel-nutritional-info/" id="view-nutrition-info">view nutrition info</a>

					<? endif; ?>

				</div>


			</div><!-- product-ingredients -->

<!-- +++++++++++++ PRODUCT FOOTER +++++++++++++ -->

			<div class="clearboth"></div>

			<div
				id="product-foot"
				class="scroll-pane SectionScroll"
				data-arrow-color="black" >

				<div class="SectionScroll-inner">
				<ul>
					<li id="find-a-store" class="foot-btn">
						<a href="<?php bloginfo('url'); ?>/store-locator/">find a store</a>
					</li>

					<li id="buy-online"  class="foot-btn">
						<a href="http://store.quinnpopcorn.com/">buy online</a>
					</li>

					<li id="see-reviews"  class="foot-btn">
						<a href="<?php bloginfo('url'); ?>/popcorn/reviews">see reviews</a>
					</li>
				</ul>

				</div>
				<div class="clearboth"></div>
			</div><!-- product foot -->

	</script>

</div>


<div id="product-json">
<?php

	$product_data = array();
	
	if( have_rows('flavor') ):
	
		while ( have_rows('flavor') ) : the_row();
	
			$product = array(
				'title'	=>		get_sub_field('title'),
				'color'	=>		get_sub_field('color'),
				'text_color'	=>		get_sub_field('text_color'),
				'bg_image'	=>		get_sub_field('bg_image'),
				'tagline'	=>		get_sub_field('tagline'),
				'tagline_above'	=>	get_sub_field('tagline_above'),
				'tagline_below'	=>	get_sub_field('tagline_below'),
				'ingredients'	=>	get_sub_field('ingredients')
				);
	
			array_push($product_data, $product);
	
		endwhile;
	
	endif;
	
echo json_encode($product_data);

?>

</div>

<?php get_footer(); ?>
