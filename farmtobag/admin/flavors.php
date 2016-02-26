<?php include 'includes/header.php' ?>
<?php include 'includes/sidebar.php' ?>


<div id="main-content">

		<div class="section-header farmtobag">
			<h2>Flavors</h2>
		</div><!-- section-header -->


	<div class="section-content">

		<div class="whitesection">

			<a class="short-button add-flavor" href="#">Add Flavor</a>

			<h3>Flavors</h3>
			
			<ul id="flavor-list">

			<?php 
			// show all ingredient suppliers
			
				$query = "SELECT flavors.*
											 FROM flavors
											 "; 
												 
				$result = mysql_query($query);
				
				if (false === $result) { echo 'query failed';}			
				
				while($data = mysql_fetch_array($result)) { ?>
			
					<li flavor_id="<?php echo $data['id'];?>">
						<span class="flavor-name"><?php echo $data['name'];?></span>
						<button flavor_name="<?php echo $data['name'];?>" class="edit-flavor-name btn-smallgray">change flavor name</button>
					</li>
					
					
				<?php } ?>
		
			</ul>
	
</div><!-- main-content -->

<?php include 'includes/footer.php' ?>
