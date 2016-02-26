
<!-- STANDARD JS INCLUDES -->

<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/jquery.1.11.1.min.js"></script>
<!-- <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/bigtext.js"></script> -->

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script> -->
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/device.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_wp.js"></script>




<?php
/* ---------------------------------------------
 * SECTION : Frontpage
*/

if ( is_front_page() ) { ?>


  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_frontpage.js"></script>


<?php } ?>


<?php
/* ---------------------------------------------
 * SECTION : Store Locator
*/

if ( is_page_template('template-store-locator.php') ) { ?>

  <script type="text/javascript" charset="utf-8" src="//maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
  <script type="text/javascript" charset="utf-8" src="//ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator/js/store-locator.compiled.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator/quinn-static-ds.js"></script>
  <script type="text/javascript" charset="utf-8" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator/panel.js"></script>

  <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/store-locator/storelocator.css">

<?php } ?>


<?php

/* ---------------------------------------------
 * SECTION : Mission/ Popcorn Reinvented
*/

if ( is_page_template('templates-sections/microwave-popcorn-reinvented.php') ) { ?>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_modules/section_scroll.js"></script>


<?php } ?>

<?php

/* ---------------------------------------------
 * SECTION : Reviews
*/

if ( is_page( 'Reviews' ) ) { ?>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_reviews.js"></script>


<?php } ?>

<?php

/* ---------------------------------------------
 * SECTION : Product Scroll
*/

if ( is_page_template('templates-sections/product-scroll.php') ) { ?>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/underscore.min.js"></script>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/bigtext.js"></script>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_wp_product_scroll.js"></script>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_modules/section_scroll.js"></script>


<?php } ?>


<?php

/* ---------------------------------------------
 * CAMPAIGN : Food Should Be
*/

if ( ( $post->post_title == 'Food Should Be' ) || is_page_template('templates-sections/frontpage.php')) { ?>

	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/food-should-be/js/fsb-fullscreen_popups.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/food-should-be/js/jqcloud.js"></script>
	<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/food-should-be/js/quinn_wp_foodshouldbe.js"></script>

<?php } ?>

<?php

/* ---------------------------------------------
 * CAMPAIGN : Reimagine Snacks
*/

if ( $post->post_title == 'Reimagine Snacks' ) { ?>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_modules/section_scroll.js"></script>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/quinn_reimagine_snacks.js"></script>

<?php } ?>

<?php
/* ---------------------------------------------
 * FULL SCREEN BG : Front Page (v1) / Products / Landing Page
*/
if ( is_page_template('templates-sections/frontpage-fullscreen.php') || is_page_template('templates-sections/landing-page.php') ) { ?>

  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/supersized.3.2.7.min.js"></script>
  <script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/vendor/supersized.quinn.js"></script>

  <script type="text/javascript">

   $(document).ready(function() {

      	<?php if (  is_page_template('template-frontpage-fullscreen.php')  )  { ?>

  	    	$('#slideshow-controls-wrapper').html('<div id="slideshow-controls"><div id="slidecaption">Loading ...</div><div id="thumb-tray" class="load-item"></div></div>');

      	<?php } // close is_page('Frontpage'))  ?>


   	});

  </script>


<?php } ?>
