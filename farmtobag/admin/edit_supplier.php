<?php 
	
	include 'includes/header.php'; 
	include 'includes/sidebar.php';
	include 'includes/templates.php';
	$state = null;
?>


<div id="main-content">

<?php 

	if ((isset($_GET['supplier_id'])) &&  (isset($_GET['supplier_type']))) {

		$supplier_id = $_GET['supplier_id'];
		$supplier_type = $_GET['supplier_type'];
		$tablename = 'supplier_'.$supplier_type;

	// get supplier name for header 
	
	
		$find_supplier = "SELECT $tablename.* 
								FROM $tablename 
								WHERE id = $supplier_id
							 	LIMIT 1 
							 	"; 
			
			$find_supplier_result = mysql_query($find_supplier);
			
			if (false === $find_supplier_result) { echo mysql_error(); }			

			if (false !== $find_supplier_result) { 
					
				$find_supplier_data = mysql_fetch_array($find_supplier_result); 
			
			} 

?>
			<div class="section-header farmtobag">
			<h2>Edit <?php echo $supplier_type; ?> Supplier</h2>
		
		<h3>You are editing <?php echo $supplier_type; ?> supplier ID <?php echo $find_supplier_data['id']; ?></h3>	
		</div><!-- section-header -->

		<div class="whitesection">



<?php
	
		if(isset($_POST['submitted'])) {
	
		// Validate Name (only required field) 
		
			if(trim($_POST['name']) === '') {
				$nameError = 'Please enter a supplier name.';
				$hasError = true;
			} else {
	
				$name = mysql_real_escape_string($_POST['name']);
	
			}
	
			$supply = mysql_real_escape_string($_POST['supply']);
			$description = mysql_real_escape_string($_POST['description']);
			$locations = mysql_real_escape_string($_POST['locations']);
			$images = mysql_real_escape_string($_POST['images']);
		
		if ($supplier_type == 'ingredients') { 
			$certifications = mysql_real_escape_string($_POST['certifications']);
			$website = mysql_real_escape_string($_POST['website']);
			$extra_links = mysql_real_escape_string($_POST['extra_links']);
			$media = mysql_real_escape_string($_POST['media']);
			$layers_deep = mysql_real_escape_string($_POST['layers_deep']);
			}
	
		// Insert data 
		
		if ($supplier_type == 'ingredients') {
		 
			$insert = "UPDATE supplier_ingredients 
						  SET name = '$name', supply = '$supply', description = '$description', locations = '$locations', certifications = '$certifications', website = '$website', extra_links = '$extra_links', media = '$media', layers_deep =  '$layers_deep', images = '$images'
						  WHERE id = $supplier_id
						  ";
		}
		else {

			$insert = "UPDATE $tablename 
						  SET name = '$name', supply = '$supply', description = '$description', locations = '$locations', images = '$images'
						  WHERE id = $supplier_id
						  ";
		}
		
			$result = mysql_query($insert);
		
	
			if (false === $result) {
				echo mysql_error();
			}
	
			if (false !== $result) {
								
		// find most recent ID 				
				$find_recent = "  SELECT $tablename.* 
										FROM $tablename 
										WHERE id = $supplier_id
									 	LIMIT 1 
									 	"; 
				
				$recent_result = mysql_query($find_recent);
				
				if (false === $recent_result) { 
				
					echo mysql_error();
						
						}			
	
				if (false !== $recent_result) { 		
	
			
					$recent_data = mysql_fetch_array($recent_result); ?> 
			
					<div id="add_summary">
					
						<h2>Supplier Saved!</h2>
			
						<ul>
				
							<li>
								<p><strong>Name : </strong> <?php echo $recent_data['name']; ?></p>
							</li>
			
							<li>
								<p><strong>Supply : </strong> <?php echo $recent_data['supply']; ?></p>
							</li>
			
							<li>
								<p><strong>Description : </strong> <?php echo $recent_data['description']; ?></p>
							</li>
							
							<li>
								<p><strong>Locations : </strong> <?php echo $recent_data['locations']; ?></p>
							</li>
	
	
			<?php if ($supplier_type == 'ingredients') { ?>
	
							<li>
								<p><strong>Certifications : </strong> <?php echo $recent_data['certifications']; ?></p>
							</li>
		
							<li>
								<p><strong>Website : </strong> <?php echo $recent_data['website']; ?></p>
							</li>
		
							<li>
								<p><strong>Extra Links : </strong> <?php echo $recent_data['extra_links']; ?></p>
							</li>
		
							<li>
								<p><strong>Media : </strong> <?php echo $recent_data['media']; ?></p>
							</li>
		
							<li>
								<p><strong>Layers Deep : </strong> <?php echo $recent_data['layers_deep']; ?></p>
							</li>
		
				<?php } ?>
							<li>
								<p><strong>Images : </strong> <?php echo $recent_data['images']; ?></p>
							</li>

						</ul>
		


						<a class="floatright big-button" href="edit_supplier.php?supplier_id=<?php echo $supplier_id; ?>&supplier_type=<?php echo $supplier_type; ?>">Edit Again</a>		
						<a  class="floatright big-button" href="suppliers.php">Return to Supplier/Farm List</a>
						
						<div class="clearboth"></div>
					</div><!-- add summary -->
				<?php
				}
	
			}
	} 
	
		if(!isset($_POST['submitted'])) {
	
	?>

		
		<form action="#"  method="post">
	
			<ul class="data-list">
			
				<li>
					<label>Name</label>
					<input type="text" name="name" value="<?php echo $find_supplier_data['name']; ?>"/>
				</li>

				<li>
					<label>Supply</label>
					<input type="text" name="supply"  value="<?php echo $find_supplier_data['supply']; ?>" />
				</li>
	
				<li>
					<label>Description</label>
					<textarea name="description"><?php echo $find_supplier_data['description']; ?></textarea>
				</li>

				<li>
					<label>Location(s)</label>

					<?php showLocationInput(); ?>

					<input type="text" name="locations" class="location-tally" value='<?php echo $find_supplier_data['locations']; ?>' />
					
					</li>
	
		<?php if ($supplier_type == 'ingredients') { ?>
				<li>
					<label>Certifications</label>
					<input type="text" name="certifications" value="<?php echo $find_supplier_data['certifications']; ?>"/>
				</li>
	
				<li>
					<label>Website</label>
					<input type="text" name="website" value="<?php echo $find_supplier_data['website']; ?>" />
				</li>
	
				<li>
					<label>Media</label>
					<textarea name="media" value="<?php echo $find_supplier_data['media']; ?>"></textarea>
				</li>

				<li>
					<label>Extra Links</label>
					<textarea name="extra_links" value="<?php echo $find_supplier_data['extra_links']; ?>"></textarea>
				</li>
	
				<li>
					<label>Layers Deep</label>
					<input type="text" name="layers_deep" value="<?php echo $find_supplier_data['layers_deep']; ?>" />
				</li>

		<?php } ?>

				<li>
					<label>Images</label>
					<input type="text" name="images" placeholder="Upload to content/images. Filenames here, comma delinated." value="<?php echo $find_supplier_data['images']; ?>" />
				</li>
	

				<li>
					<input type="hidden" name="submitted" id="submitted" value="true" />
					<button supplier_id="<?php echo $supplier_id ?>" supplier_type="<?php echo $supplier_type ?>" class="delete-supplier" >Delete supplier</button>
					<input type="submit" value="Save Supplier" />

				</li>
	
			</ul>
	
		</form>

		

<? }

} // isset GET id
else {
	echo '<p>No supplier ID was assigned. Head back to <a href="suppliers.php">Supplier/Farm List</a></p>';
}

 ?>
</div>
</div>

<?php include 'includes/footer.php';  ?>