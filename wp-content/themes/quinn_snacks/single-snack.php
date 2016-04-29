<? get_header() ?>
	<div id="product-scroll" class="SectionScroll-wrap" data-scrolltype="<?= $snack->post_name ?>">

		<div class="sticky_shim"></div>
		
		<div id="product-scroll-titles" style="background:url(<?= $snack->header_image->url ?>) right center no-repeat fixed; background-size:cover;" >
	
			<ul></ul>
	
		</div>
	
		<div id="product-content"></div>

		<script type="text/template" id="product-template">
		
			<div id="product-callout" class="SectionScroll scroll-pane" data-arrow-color="white" style="background: url(<%= product.bg_image %>) right center no-repeat; background-size:cover;" >
				<div class="SectionScroll-inner scroll-pane-content">
					<h2 style="color:<%= product.color %>;" ><%= product.tagline_above %></h2>
				</div>
			</div>

			<? if( in_array( $snack->post_name, array( 'microwave-popcorn', 'pretzels' ) ) ) : ?>
			
				<div id="product-reinvented" class="scroll-pane SectionScroll" data-arrow-color="white" style="background-image:url(<?= $snack->section_background->url ?>);<? if( $snack->post_name == 'pretzels' ) : ?> background-color: #74dd67;<? endif ?>">
					<div class="product-reinvented-inner"<? if( $snack->post_name == 'pretzels' ) : ?> style="padding-top: 5%"<? endif ?>>
						<h1><span></span>Reimagined</h1>
						<?= apply_filters('the_content', $snack->section_content ) ?>
					</div>
				</div>
			
			<? elseif ($snack->post_name == 'popped-popcorn') : ?>
		
				<div id="product-farmtobag" class="scroll-pane SectionScroll" data-arrow-color="white" style="background-image:url(<?= $snack->section_background->url ?>);">
		
					<div class="SectionScroll-inner">
		
						<h1><span></span>Reimagined</h1>
		
						<?= apply_filters('the_content', $snack->section_content ) ?>
		
						<div id="f2b-form">
	
							<form action="/farm-to-bag" method="GET">
	
								<div class="f2b-logo"></div>
								<div class="clearboth"></div>
								<div class="f2b-arrow">
									<div class="f2b-arrow-inner">
	
										<input type="text" placeholder="your batch #" name="batch-number">
	
										<input type="submit" value="GO" />
										<span class="type-or">or</span>
	
										<a id="link-currentbatch" href="/farm-to-bag">Current Batch</a>
	
									</div>
								</div>
							</form>
	
						</div>
		
					</div>
		
					<div class="clearboth"></div>
		
				</div>
		
			<? endif ?>
		
			<div id="slider-product-ingredients" class="SectionScroll" data-arrow-color="white"<? if( $snack->post_name == 'pretzels' ) : ?> style="background-image: url(<?= img_dir() ?>sorghum.jpg)"<? endif ?>>
	
				<div class="product-ingredients-wrapper">

					<img class="product-ingredients-title" src="<?= img_dir() ?>product-ingredient-title.png" />

					<img src="<%= product.ingredients %>" />

					<? if( $snack->post_name == 'microwave-popcorn' ) : ?>
						<a href="/m-nutritional-info/ " id="view-nutrition-info">view nutrition info</a>
	
					<? elseif( $snack->post_name == 'popped-popcorn' ) : ?>
						<a href="/p-nutritional-info/" id="view-nutrition-info">view nutrition info</a>
	
					<? elseif( $snack->post_name == 'pretzels' ) : ?>
						<a href="/pretzel-nutritional-info/" id="view-nutrition-info">view nutrition info</a>
	
					<? endif ?>
					
				</div>		
		
			</div>
			<div class="clearboth"></div>
		
			<div id="product-foot" class="scroll-pane SectionScroll" data-arrow-color="black" >
				<div class="SectionScroll-inner">
					<ul>
						<li id="find-a-store" class="foot-btn">
							<a href="<? bloginfo('url'); ?>/store-locator/">find a store</a>
						</li>
		
						<li id="buy-online"  class="foot-btn">
							<a href="http://store.quinnpopcorn.com/">buy online</a>
						</li>
		
						<li id="see-reviews"  class="foot-btn">
							<a href="<? bloginfo('url'); ?>/popcorn/reviews">see reviews</a>
						</li>
					</ul>		
				</div>
				<div class="clearboth"></div>
			</div>
		
		</script>
	</div>

	<script>
		<?
			$product_data = array();
			foreach( $snack->flavors as $flavor ) :
		
				$product_data[] = array(
					'ID'			=> $flavor->ID,
					'title'			=> htmlspecialchars( $flavor->post_title ),
					'color'			=> $flavor->color,
					'text_color'	=> $flavor->text_color,
					'bg_image'		=> $flavor->background_image,
					'tagline'		=> $flavor->tagline,
					'tagline_above'	=> $flavor->tagline_above,
					'tagline_below'	=> $flavor->tagline_below,
					'ingredients'	=> $flavor->ingredients,
					'selected'		=> ( $snack->selected == $flavor->ID ) ? 1 : 0
				);
		
			endforeach;
		?>
		var productData = <?= json_encode( $product_data ) ?>;
	</script>

<? get_footer() ?>