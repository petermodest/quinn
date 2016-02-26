		</div><!-- main-content -->

	<script src="assets/js/jquery-1.10.2.min.js"></script>
	<script src="assets/js/jquery-ui-1.10.4.custom.min.js"></script>

	<script>
		$(document).ready(function (){
			$( ".batch-sections" )
				.accordion({
					header: "> div > .supplier-supply",
					collapsible: true,
					heightStyle: "content"

				})

		var layersdeepinfo = $('#layersdeep-info').html();

		$(document).tooltip({
			items:'.layers-deep-label a',
			tooltipClass:'layers-deep-tooltip',
			content: function () {
				return layersdeepinfo;
				}
			});

		$( "#tab-wrapper" ).tabs();


 		$('#mainmenu-header > ul > li > a').each(function() {
	 		// apply width of title to the sub-menu items
    		$(this).parent().find('.sub-menu li a').css({'width': $(this).width()});

		});		

		});



      

	</script>

	</body>



</html>
