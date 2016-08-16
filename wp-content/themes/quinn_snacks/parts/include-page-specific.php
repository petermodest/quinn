<script type="text/javascript" src="<?= js_dir() ?>vendor/jquery.1.11.1.min.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>vendor/device.min.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>vendor/jquery.lazyload.min.js"></script>
<script src="https://use.fontawesome.com/ac344dd39b.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>quinn_wp.js"></script>

<?
	// SINGLE PAGES

		// FRONT PAGE
		if( is_front_page() ) :
			?>
				<script type="text/javascript" src="<?= js_dir() ?>quinn_frontpage.js"></script>
			<?
				
		// REVIEWS PAGE
		elseif( is_page( 'Reviews' ) ) :
			?>
				<script type="text/javascript" src="<?= js_dir() ?>quinn_reviews.js"></script>
			<?
				
		// FARM TO BAG
		elseif( is_page_template('page-farm-to-bag.php') ) :
			?>
				<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
				<script src="https://cdn.rawgit.com/nnattawat/flip/v1.0.20/dist/jquery.flip.min.js"></script>
				<script>
					$(document).ready(function() {
						$('.block').flip({
							trigger: 'hover'
						});
						
						$( document ).tooltip({
							items: '.whats-this,.why-transparency',
							content: function() {
								if ( $(this).is( '.whats-this' ) ) {
									return '<ul><li><strong>1 Layer Deep:</strong> Full ingredient name. No ‘natural flavors’, or other ingredient obfuscation.</li><li><strong>2 Layers Deep:</strong> Source listed. This should include the name of the supplier and the region that the ingredient is farmed, harvested, or created. Basic ingredient certifications should also be shown.</li><li><strong>3 Layers Deep:</strong> Farm level information. This should include the name of the farm(s), the location of the farm, and an overview of their farming practices.</li></ul>';
								} else if ( $(this).is( '.why-transparency' ) ) {
									return '<p>Knowing where your food comes from is fundamental and it’s about time companies open up.</p><p>Not only do you deserve to know, sharing all the details changes how food is made. You make more responsible choices. You seek out the best ingredients. You dig deeper. You make food better.</p><p>Simply put, transparency is the most powerful force for good in food.</p><p class="img-wrap"><img class="signiture" src="/wp-content/themes/quinn_snacks/library/images/kristy-signiture.png"></p>';
								}
							},
							position: {
								my: 'center bottom-20',
								at: 'center top',
								using: function( position, feedback ) {
									$( this ).css( position );
									console.log(feedback.horizontal)
									$('<div>').addClass('arrow').addClass( feedback.vertical ).addClass( feedback.horizontal ).appendTo( this );
								}
							},
							show: { effect: "fadeIn", duration: 0 },
							hide: { effect: "fadeOut", duration: 0 }
						})
					})
				</script>	
			<?
				
		// STORE LOCATOR
		elseif( is_page_template('template-store-locator.php') ) :
			?>
				<script type="text/javascript" charset="utf-8" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
				<script type="text/javascript" charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
				<script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/js/store-locator.compiled.js"></script>
				<script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/quinn-static-ds.js"></script>
				<script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/panel.js"></script>
				<link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/library/store-locator/storelocator.css">
			<?
				
		// REIMAGINED SNACKS
		elseif( $post->post_title == 'Reimagine Snacks' ) :
			?>
				<script type="text/javascript" src="<?= js_dir() ?>quinn_modules/section_scroll.js"></script>
				<script type="text/javascript" src="<?= js_dir() ?>quinn_reimagine_snacks.js"></script>
			<?
		endif;


	// TYPES
	
		// SNACK
		if( $post->post_type == 'snack' ) :
			?>
				<script src="<?= js_dir() ?>vendor/fancybox/jquery.fancybox.pack.js"></script>
				<script src="https://cdn.rawgit.com/nnattawat/flip/v1.0.20/dist/jquery.flip.min.js"></script>
				<script type="text/javascript" src="<?= js_dir() ?>single-snack.js?v=<?= time() ?>"></script>
			<?
		endif;
		
	// OTHER
	
		// LANDING PAGE FULLSCREEN
		if ( is_page_template('templates-sections/frontpage-fullscreen.php') || is_page_template('templates-sections/landing-page.php') ) :
			?>
				<script type="text/javascript" src="<?= js_dir() ?>vendor/supersized.3.2.7.min.js"></script>
				<script type="text/javascript" src="<?= js_dir() ?>vendor/supersized.quinn.js"></script>
				<? if (	is_page_template('template-frontpage-fullscreen.php') ) : ?>
					<script type="text/javascript">
						$(document).ready(function() {
							$('#slideshow-controls-wrapper').html('<div id="slideshow-controls"><div id="slidecaption">Loading ...</div><div id="thumb-tray" class="load-item"></div></div>');
						});	
					</script>
				<? endif ?>
			<?
		endif;