<?php
/**
 * @package WordPress
 * @subpackage Quinn
 */
?>


</div><!-- #wrapper -->

    	<?php if ( is_page_template('template-product-page.php') || is_page_template('template-product-page2.php')) { ?>
			<a id="nextslide"></a>
		<?php } // close is_page('Frontpage'))  ?>
	
<div id="home-footer" class="row no-padding footer">

	<div id="footer-contentwrap" class="row-inner">

		<div id="husk-logo"></div>

		<?php wp_nav_menu( array( 'theme_location' => 'mainmenu-footer', 'container_id' => 'mainmenu-footer' ) ); ?>

		<div id="footer-social" class="social-buttons">
			<a id="instagram-button" href="http://instagram.com/quinnpopcorn"></a>
			<a id="facebook-button" href="https://www.facebook.com/QuinnPoP?fref=ts"></a>
			<a id="twitter-button" href="https://twitter.com/quinnpopcorn"></a>
		</div>

		<div id="newsletter-box">

			<h4>QUINN NEWSLETTER</h4>
			<p>No junk! Just deals, reviews, and news from us at Quinn.	</p>
			<a href="/connect/quinn-popcorn-newsletter/" id="newsletter-button">Check it out</a>

	</div> <!-- #newsletter-box -->
	</div> <!-- #footer-contentwrap -->


</div> <!-- #footer -->





<?php wp_footer() ?>

<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19994833-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();



/* <![CDATA[ */
var google_conversion_id = 990596689;
var google_conversion_label = "sjnKCL_2pAUQ0Zyt2AM";
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>

<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
<noscript>

<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/990596689/?value=0&amp;label=sjnKCL_2pAUQ0Zyt2AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<script type="text/javascript">
adroll_adv_id = "PGS5WBTORVCITIDI47KNBJ";
adroll_pix_id = "RBIIAM3ZCZBEDGMGH3U7O3";
(function () {
var oldonload = window.onload;
window.onload = function(){
   __adroll_loaded=true;
   var scr = document.createElement("script");
   var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
   scr.setAttribute('async', 'true');
   scr.type = "text/javascript";
   scr.src = host + "/j/roundtrip.js";
   ((document.getElementsByTagName('head') || [null])[0] ||
    document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
   if(oldonload){oldonload()}};
}());
</script>



</body>
</html>
