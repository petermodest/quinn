<?php include('includes/header.php');  ?>

<div id="home-wrapper">

	<div class="yellowbar"></div>
	
	<div id="home-leftcol">

		<div id="bigbag"></div>

	</div>
	
	<div id="home-rightcol">
	
		<div id="biglogo"></div>			

		<form action="view.php" method="GET">
			<input type="text" placeholder="your batch number" name="id">
			<input type="submit" value="GO" />
			<span id="type-or">or</span>
			<a id="link-currentbatch" href="view.php?id=<?php echo get_featured_batch_no(); ?>">Current Batch</a>
		</form>
	
		<img src="assets/images/farm-to-bag-tracktor.png" id="tracktor-image" />
		
		<div id="introduction">
		
			<h3>THE IDEA</h3>
			<p>Knowing where your food comes from is fundamental, and it’s about time snack companies open up.</p>						
			<p>Complete transparency. This has never been done in snacking before. We call it farm-to-bag.</p>

			<h3>MEET OUR SUPPLIERS</h3>
			<div id="frontpage-featured">
				<?php echo getFrontpageFeatured(); ?>
			</div>
			
		</div>
	
	</div>
	
</div>

<?php include('includes/footer.php');  ?>
