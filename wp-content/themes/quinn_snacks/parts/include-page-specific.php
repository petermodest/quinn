
<!-- STANDARD JS INCLUDES -->

<script type="text/javascript" src="<?= js_dir() ?>vendor/jquery.1.11.1.min.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>vendor/device.min.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>vendor/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?= js_dir() ?>quinn_wp.js"></script>


<?
/* ---------------------------------------------
 * SECTION : Frontpage
*/

if ( is_front_page() ) { ?>


  <script type="text/javascript" src="<?= js_dir() ?>quinn_frontpage.js"></script>


<? } ?>


<?
/* ---------------------------------------------
 * SECTION : Store Locator
*/

if ( is_page_template('template-store-locator.php') ) { ?>

  <script type="text/javascript" charset="utf-8" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  <script type="text/javascript" charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/js/store-locator.compiled.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/quinn-static-ds.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?= get_stylesheet_directory_uri() ?>/library/store-locator/panel.js"></script>

  <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/library/store-locator/storelocator.css">

<? } ?>


<?

/* ---------------------------------------------
 * SECTION : Mission/ Popcorn Reinvented
*/

if ( is_page_template('templates-sections/microwave-popcorn-reinvented.php') ) { ?>

  <script type="text/javascript" src="<?= js_dir() ?>quinn_modules/section_scroll.js"></script>


<? } ?>

<?

/* ---------------------------------------------
 * SECTION : Reviews
*/

if ( is_page( 'Reviews' ) ) { ?>

  <script type="text/javascript" src="<?= js_dir() ?>quinn_reviews.js"></script>


<? } ?>

<?

/* ---------------------------------------------
 * SECTION : Product Scroll
*/
if ( is_page_template('templates-sections/product-scroll.php') || $post->post_type == 'snack' ) { ?>

  <script type="text/javascript" src="<?= js_dir() ?>vendor/underscore.min.js"></script>
  <script type="text/javascript" src="<?= js_dir() ?>vendor/bigtext.js"></script>
  <script type="text/javascript" src="<?= js_dir() ?>quinn_wp_product_scroll.js"></script>
  <script type="text/javascript" src="<?= js_dir() ?>quinn_modules/section_scroll.js"></script>


<? } ?>


<?

/* ---------------------------------------------
 * CAMPAIGN : Food Should Be
*/

if ( ( $post->post_title == 'Food Should Be' ) || is_page_template('templates-sections/frontpage.php')) { ?>

	<script type="text/javascript" src="<? bloginfo( 'stylesheet_directory' ); ?>/library/food-should-be/js/fsb-fullscreen_popups.js"></script>
	<script type="text/javascript" src="<? bloginfo( 'stylesheet_directory' ); ?>/library/food-should-be/js/jqcloud.js"></script>
	<script type="text/javascript" src="<? bloginfo( 'stylesheet_directory' ); ?>/library/food-should-be/js/quinn_wp_foodshouldbe.js"></script>

<? } ?>

<?

/* ---------------------------------------------
 * CAMPAIGN : Reimagine Snacks
*/

if ( $post->post_title == 'Reimagine Snacks' ) { ?>

  <script type="text/javascript" src="<?= js_dir() ?>quinn_modules/section_scroll.js"></script>

  <script type="text/javascript" src="<?= js_dir() ?>quinn_reimagine_snacks.js"></script>

<? } ?>

<?
/* ---------------------------------------------
 * FULL SCREEN BG : Front Page (v1) / Products / Landing Page
*/
if ( is_page_template('templates-sections/frontpage-fullscreen.php') || is_page_template('templates-sections/landing-page.php') ) { ?>

  <script type="text/javascript" src="<?= js_dir() ?>vendor/supersized.3.2.7.min.js"></script>
  <script type="text/javascript" src="<?= js_dir() ?>vendor/supersized.quinn.js"></script>

  <script type="text/javascript">

   $(document).ready(function() {

      	<? if (  is_page_template('template-frontpage-fullscreen.php')  )  { ?>

  	    	$('#slideshow-controls-wrapper').html('<div id="slideshow-controls"><div id="slidecaption">Loading ...</div><div id="thumb-tray" class="load-item"></div></div>');

      	<? } // close is_page('Frontpage'))  ?>

   	});

  </script>


<? } ?>

<? if( is_page_template('page-farm-to-bag.php') ) : ?>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="https://cdn.rawgit.com/nnattawat/flip/v1.0.20/dist/jquery.flip.min.js"></script>
	<script>
		$(document).ready(function() {
			$('.block').flip({
				trigger: 'hover'
			});
			
			$( document ).tooltip({
				items: '.whats-this',
				content: function() {
					if ( $(this).is( '.whats-this' ) ) {
						return '<ul><li><strong>1 Layer Deep:</strong> Full ingredient name. No ‘natural flavors’, or other ingredient obfuscation.</li><li><strong>2 Layers Deep:</strong> Source listed. This should include the name of the supplier and the region that the ingredient is farmed, harvested, or created. Basic ingredient certifications should also be shown.</li><li><strong>3 Layers Deep:</strong> Farm level information. This should include the name of the farm(s), the location of the farm, and an overview of their farming practices.</li></ul>';
					}
				},
				position: {
					my: 'center bottom-20',
					at: 'center top',
					using: function( position, feedback ) {
						$( this ).css( position );
						$('<div>').addClass('arrow').addClass( feedback.vertical ).addClass( feedback.horizontal ).appendTo( this );
					}
				}			
			});

		})
	</script>	
<? endif ?>