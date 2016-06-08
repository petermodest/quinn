<? get_header() ?>

<style>
	<? foreach( $snack->flavors as $key => $flavor ) : ?>
		.flavor-list li[data-flavor="<?= $flavor->ID ?>"].active,
		.flavor-list li[data-flavor="<?= $flavor->ID ?>"]:hover {
			background: <?= $flavor->flavor_color ?>;
		}
	<? endforeach ?>
</style>

<div id="snack-scroll" class="page-scroll-wrapper">

	<ul class="top-links">
		<li><a href="http://store.quinnpopcorn.com">Buy a <?= $snack->packaging_noun ?></a></li>
		<li><a href="#snack-scroll" data-scroll-to="#snack-scroll" class="scroll-to-elem">Back to Top</a></li>
	</ul>

	<section class="flavor-list<? if( $snack->parent_flavor ) : ?> parent-flavor<? endif ?>" data-top-link-color="<?= $snack->top_buy_color ?>" style="background-image: url(<?= $snack->flavor_list_img_bg->url ?>)">
		<ul>
			<? foreach( $snack->flavors as $key => $flavor ) : ?>
				<li class="scroll-to-elem<? if( $key == 0 ) : ?> active<? endif ?>" data-scroll-to=".flavor-detail" data-flavor="<?= $flavor->ID ?>" data-update-url="<?= str_replace( site_url(), '', $flavor->permalink ) ?>">
					<h2><?= $flavor->post_title ?></h2>
					<ul>
						<li><a href="http://store.quinnpopcorn.com">Buy a <?= $snack->packaging_noun ?></a>
						<li><a href="<?= $flavor->permalink ?>" class="scroll-to-elem" data-scroll-to=".flavor-detail">Check it out!</a></li> 
					</ul>
				</li>
			<? endforeach ?>
		</ul>
		
		<? if( $snack->parent_flavor ) : ?>
			<h2><?= $snack->flavor_tagline ?></h2>
			<? if( $snack->flavors[0]->flavor_certifications ) : ?>
				<footer>
					<ul>
						<? foreach( $snack->flavors[0]->flavor_certifications as $cert ) : ?>
							<li><img src="<?= $cert->image['url'] ?>" name="<?= $cert->name ?>" /></li>
						<? endforeach ?>
					</ul>
					<? if( isset( $flavor->nutrition_facts->url ) ) : ?>
						<a href="<?= $flavor->nutrition_facts->url ?>" title="<?= $flavor->post_title ?>" class="nutrition-info modal" rel="nutrition">
							<img src="<?= img_dir() ?>heart.png" alt="Nutrition Info" title="Nutrition Info" />
						</a>
					<? endif ?>
				</footer>
			<? endif ?>
		<? endif ?>
	</section>

	<? if( ! $snack->parent_flavor ) : ?>
		<section class="flavor-detail flavor-switch">
			<ul class="inner-height">
				<? foreach( $snack->flavors as $key => $flavor ) : ?>
					<li class="inner-height <? if( $flavor->ID == $snack->selected ) : ?> active<? endif ?>" data-flavor="<?= $flavor->ID ?>" data-top-link-color="<?= $flavor->flavor_buy_color ?>" style="background-image: url( <?= $flavor->flavor_img_bg->url ?> )" >
						<h2 style="color: <?= $flavor->flavor_color ?>"><?= $flavor->flavor_tagline ?></h2>
						<? if( $flavor->flavor_certifications ) : ?>
							<footer>
								<ul>
									<? foreach( $flavor->flavor_certifications as $cert ) : ?>
										<li><img src="<?= $cert->image['url'] ?>" name="<?= $cert->name ?>" /></li>
									<? endforeach ?>
								</ul>
								<? if( isset( $flavor->nutrition_facts->url ) ) : ?>
									<a href="<?= $flavor->nutrition_facts->url ?>" title="<?= $flavor->post_title ?>" class="nutrition-info modal" rel="nutrition"><img src="<?= img_dir() ?>heart-icon.png" alt="Nutrition Info" title="Nutrition Info" /></a>
								<? endif ?>
							</footer>
						<? endif ?>
						<footer class="arrow-link-wrap"><a href="#" data-scroll-to=".reimagined" class="fa fa-chevron-circle-down scroll-to-elem arrow-link" style="color:<?= $flavor->flavor_buy_color ?>"></a></footer>
					</li>
				<? endforeach ?>			
			</ul>
		</section>
	<? endif ?>
	
	<? if( $snack->reimagined_display ) : ?>
		<section class="reimagined" data-top-link-color="<?= $snack->reimagined_buy_color ?>" style="background-color: <?= $snack->reimagined_color_bg ?>">
			<style>
				.reimagined h2,
				.reimagined p a {
					color: <?= $snack->reimagined_highlight ?>
				}
			</style>
			<h2><?= $snack->reimagined_header_text ?></h2>
			<div class="cms"><?= $snack->reimagined_description ?></div>
			<img src="<?= $snack->reimagined_img->url ?>" class="invisible" />
			<img src="<?= $snack->reimagined_mobile_img->url ?>" class="mobile" />
			<div class="reimagined-wrap"><img src="<?= $snack->reimagined_img->url ?>" /></div>
			<footer class="arrow-link-wrap"><a href="#" data-scroll-to=".farm-to-bag" class="fa fa-chevron-circle-down scroll-to-elem arrow-link" style="color:<?= $snack->reimagined_buy_color ?>"></a></footer>
		</section>
	<? endif ?>
	
	<? if( $snack->parent_flavor ) : ?>
		<section class="recipe-grid" data-top-link-color="<?= $snack->recipe_buy_color ?>" style="background-color:<?= $snack->recipe_bg_color ?>">
			<h2>quinn’s popcorn recipes</h2>
			<ul class="row">
				<? foreach( $snack->recipes as $key => $recipe ) : ?>
					<li class="col span-3 block flip">
						<img src="<?= img_dir() ?>transparent-square.png" class="invisible" />
						<div class="front" style="background-image: url(<?= $recipe->image->url ?>)">
							<h2><?= $recipe->name ?></h2>
						</div>
						<div class="back">
							<h3><?= $recipe->header ?></h3>
							<h5>Ingredients:</h5>
							<ul>
								<? foreach( $recipe->ingredients as $key => $ingredient ) : ?>
									<li><?= $ingredient->ingredient ?></li>
								<? endforeach ?>
							</ul>
							<h5>Instructions:</h5>
							<ol>
								<? foreach( $recipe->instructions as $key => $instruction ) : ?>
									<li><span><?= $key + 1 ?>.</span><?= $instruction->instruction ?></li>
								<? endforeach ?>
							</ol>
						</div>
					</li>
				<? endforeach ?>
			</ul>
			<footer class="arrow-link-wrap"><a href="#" data-scroll-to=".farm-to-bag" class="fa fa-chevron-circle-down scroll-to-elem arrow-link" style="color:<?= $snack->recipe_buy_color ?>"></a></footer>
		</section>
	<? endif ?>
	
	<? if( $snack->f2b_section_display ) : ?>
		<section class="farm-to-bag flavor-switch">
			<ul class="inner-height">
				<? foreach( $snack->flavors as $key => $flavor ) : ?>
					<li class="inner-height<? if( $flavor->ID == $snack->selected ) : ?> active<? endif ?>" data-flavor="<?= $flavor->ID ?>" data-top-link-color="<?= $flavor->f2b_buy_color ?>" style="background-image: url(<?= $flavor->f2b_img_bg->url ?>)">
						<h2><img src="<?= img_dir() ?>farm-to-bag-white.png" alt="Farm to Bag: Know where your food comes from" /></h2>
						<div class="supplier">
							<img class="map" src="<?= $flavor->f2b_supplier_map_img->url ?>" />
							<div class="box">
								<h4><?= implode( ' & ', $flavor->f2b_featured_supplier->ingredients ) ?></h4>
								<h6>
									<? if( $flavor->f2b_featured_supplier ) : ?><a href="<?= $flavor->f2b_featured_supplier->permalink ?>"><? endif ?>
										<?= $flavor->f2b_featured_supplier->post_title ?>
									<? if( $flavor->f2b_featured_supplier ) : ?></a><? endif ?>
								</h6>
								<ul>
									<li>
										<label>Grown In</label>
										<p><?= implode( ' & ', $flavor->f2b_featured_supplier->location_convert ) ?></p>
									</li>
									<li>
										<label>Overview</label>
										<p><?= $flavor->f2b_featured_supplier->short_description ?></p>
									</li>
								</ul>
							</div>
						</div>
						<a href="/farm-to-bag" class="all-growers"><?= $flavor->f2b_arrow_link_text ?></a>
						<footer class="arrow-link-wrap"><a href="#" data-scroll-to=".links" class="fa fa-chevron-circle-down scroll-to-elem arrow-link" style="color:<?= $flavor->f2b_buy_color ?>"></a></footer>
					</li>
				<? endforeach ?>
			</ul>
		</section>
	<? endif ?>
	
	<section class="links" data-top-link-color="#000">
		<ul>
			<li>
				<div class="img-wrap">
					<img src="<?= img_dir() ?>product-link-buy.png" class="invisible" />
					<img src="<?= img_dir() ?>product-link-map.png" />
				</div>
				<a href="/store-locator">Find a Store</a>
			</li>
			<li>
				<div class="img-wrap">
					<img src="<?= img_dir() ?>product-link-buy.png" class="invisible" />
					<img src="<?= img_dir() ?>product-link-buy.png" />
				</div>
				<a href="http://store.quinnpopcorn.com">Buy Online</a>
			</li>
			<li>
				<div class="img-wrap">
					<img src="<?= img_dir() ?>product-link-buy.png" class="invisible" />
					<img src="<?= img_dir() ?>product-link-stars.png" />
				</div>
				<a href="/reviews">See Reviews</a>
			</li>
			<li>
				<a href="#" class="stacked nutrition-open<? if( ! $snack->display_popping_instructions ) : ?> push-down<? endif ?>">Nutrition Info</a>
				<? if( $snack->display_popping_instructions ) : ?>
					<a href="#instructions" class="stacked modal">Popping Instructions</a>
				<? endif ?>
			</li>
		</ul>
		<footer class="arrow-link-wrap"><a href="#snack-scroll" data-scroll-to="#snack-scroll" class="fa fa-chevron-circle-up scroll-to-elem arrow-link" style="color:#000"></a></footer>
	</section>
</div>

<div id="instructions" class="cms"><?= $snack->popping_instructions ?></div>

<? get_footer() ?>