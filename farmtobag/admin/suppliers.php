<?php include 'includes/functions.php' ?>
<?php include 'includes/header.php' ?>
<?php include 'includes/sidebar.php' ?>


<div id="main-content">

		<div class="section-header farmtobag">
			<h2>Suppliers / Farms</h2>
		</div><!-- section-header -->


	<div class="section-content">

		<div class="whitesection">

			<a class="short-button add-ingredient" href="add_supplier.php?supplier_type=ingredients">Add Ingredient Supplier</a>

			<h3>Ingredient Suppliers</h3>
			
			<ul>

			<?php 
			// show all ingredient suppliers
			
				$query_ingredients = "SELECT supplier_ingredients.*
											 FROM supplier_ingredients
											 "; 
												 
				$result_ingredients = mysql_query($query_ingredients);
				
				if (false === $result_ingredients) { echo 'query failed';}			
				
				while($data_ingredients = mysql_fetch_array($result_ingredients)) { 
					
						$supplier_id = $data_ingredients['id'];
						
						$featured_class = null;
						if ($data_ingredients['featured'] == 1) {$featured_class = 'featured';} else { $featured_class = '';}
					
				?>
			
					<li> 
						<div supplier_id="<?php echo $data_ingredients['id'];?>" featured_state="<?php echo $data_ingredients['featured'];?>"  supplier_type="ingredients" class="frontpage-featured <?php echo $featured_class; ?>"></div>
					
						<span class="name-trim"><?php echo $data_ingredients['name'];?> 
						
						<span class="name-gray"> / <?php echo $data_ingredients['supply'];?> </span></span>
					
						<a class="edit-link"  href="edit_supplier.php?supplier_id=<?php echo $supplier_id; ?>&supplier_type=ingredients">edit</a>
						<a class="edit-link"  href="add_farm.php?supplier_id=<?php echo $supplier_id; ?>">add farm</a>
						<a href="<?php echo getInfoLink($data_ingredients['name']); ?>" class="featured-pagelink"></a>
				
					<?php
					
				// check if ingredient supplier has farm	
					
					$query_farms = "SELECT farms.*
										 FROM farms
										 WHERE supplier_id = $supplier_id
										 "; 
													 
					$result_farms = mysql_query($query_farms);
					
					if (false === $result_farms) { echo 'query failed';}			
					if (false !== $result_farms) {		
					
					echo '<ul>';
					
					while($data_farms = mysql_fetch_array($result_farms)) { ?>
							
							<li> <?php echo $data_farms['name'];?> 
								
								<a class="edit-link"  href="edit_farm.php?farm_id=<?php echo $data_farms['id']; ?>">edit</a>

							</li>
							
							<?php 
							}
							
						echo '</ul>';
		
					}
							
					?>
					
					</li>
				
				<?php } ?>
			</ul>
		
		</div><!-- suppplier-section -->

		<div class="whitesection">

		
			<a class="short-button add-ingredient" href="add_supplier.php?supplier_type=packaging">Add Packaging Supplier</a>
		
			<h3>Packaging Suppliers</h3>
			
			<ul>
		
			<?php 
			
				$query_packaging = "SELECT supplier_packaging.*
										  FROM supplier_packaging
											"; 
												 
				$result_packaging = mysql_query($query_packaging);
				
				if (false === $result_packaging) { echo 'query failed';}			
				
				while($data_packaging = mysql_fetch_array($result_packaging)) {
				
						$featured_class = null;
						if ($data_packaging['featured'] == 1) {$featured_class = 'featured';} else { $featured_class = '';}

				
				 ?>
			
					<li> 
						<div supplier_id="<?php echo $data_packaging['id'];?>" featured_state="<?php echo $data_packaging['featured'];?>" supplier_type="packaging"  class="frontpage-featured <?php echo $featured_class; ?>"></div>

						<?php echo $data_packaging['name'];?>
							<span> / <?php echo $data_packaging['supply'];?> </span>


						<a class="edit-link" href="edit_supplier.php?supplier_id=<?php echo $data_packaging['id'];?>&supplier_type=packaging">edit</a>
						<a href="<?php echo getInfoLink($data_packaging['name']); ?>" class="featured-pagelink"></a>
						
					 </li>
				
				<?php } ?>
		
			</ul>
		
		</div><!-- suppplier-section -->


		<div class="whitesection">

			<a class="short-button add-ingredient" href="add_supplier.php?supplier_type=production">Add Production Supplier</a>
		
			<h3>Production Suppliers</h3>
			
			<ul>
		
			<?php 
			
				$query_production = "SELECT supplier_production.*
										  FROM supplier_production
										  "; 
												 
				$result_production = mysql_query($query_production);
				
				if (false === $result_production) { echo 'query failed';}			
				
				while($data_production = mysql_fetch_array($result_production)) { 
					
						$featured_class = null;
						if ($data_production['featured'] == 1) {$featured_class = 'featured';} else { $featured_class = '';}


					
				?>
			
					<li> 
						<div supplier_id="<?php echo $data_production['id'];?>" featured_state="<?php echo $data_production['featured'];?>" supplier_type="production" class="frontpage-featured <?php echo $featured_class; ?>"></div>

						<?php echo $data_production['name'];?>
						<span> / <?php echo $data_production['supply'];?> </span>
	

					<a  class="edit-link" href="edit_supplier.php?supplier_id=<?php echo $data_production['id'];?>&supplier_type=production">edit</a>
						<a href="<?php echo getInfoLink($data_production['name']); ?>" class="featured-pagelink"></a>

					 </li>
				
				<?php } ?>
		
			</ul>
		
		</div><!-- suppplier-section -->
	
</div><!-- main-content -->

<?php include 'includes/footer.php' ?>
