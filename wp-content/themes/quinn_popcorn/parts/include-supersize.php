<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/supersized.3.2.7.min.js"></script>
<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/supersized.quinn.js"></script>

<script type="text/javascript">

 $(document).ready(function() {

    	<?php if (is_page('Frontpage'))  { ?>

	    	$('#slideshow-controls-wrapper').html('<div id="slideshow-controls"><div id="slidecaption">Loading ...</div><div id="thumb-tray" class="load-item"></div></div>');

    	<?php } // close is_page('Frontpage'))  ?>

    	<?php if ( is_page_template('template-product-page.php') || is_page_template('template-product-page2.php')) { ?>

				$('.modal-link').click(function() {
				    $("#lightbox-wrap").show(); // hides all others
					});

				$('#modal-close').click(function() {
				    $("#lightbox-wrap").hide(); // hides all others
					});

    	<?php } // close product page only script  ?>

 	});

</script>
