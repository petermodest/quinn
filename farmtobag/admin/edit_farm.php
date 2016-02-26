<?php 
	
	include 'includes/header.php'; 
	include 'includes/sidebar.php';
	include 'includes/templates.php';

	$state = null;
?>


<div id="main-content">

		<div class="section-header farmtobag">
			<h2>Edit Farm</h2>
<?php 

	if (isset($_GET['farm_id'])) {
		$farm_id = $_GET['farm_id'];

	// get supplier name for header 
	
	
		$find_supplier = "SELECT farms.* 
								FROM farms 
								WHERE id = $farm_id
							 	LIMIT 1 
							 	"; 
			
			$find_farm_result = mysql_query($find_supplier);
			
			if (false === $find_farm_result) { echo mysql_error(); }			

			if (false !== $find_farm_result) { 
					
				$find_farm_data = mysql_fetch_array($find_farm_result); 
			
			} 

?>
			
		<h3>You are editing farm ID <?php echo $find_farm_data['id']; ?></h3>	
		</div><!-- section-header -->

		<div class="whitesection">



<?php
	
		if(isset($_POST['submitted'])) {
	
		// Validate Name (only required field) 
		
			if(trim($_POST['name']) === '') {
				$nameError = 'Please enter a farm name.';
				$hasError = true;
			} else {
	
			$name = mysql_real_escape_string($_POST['name']);
	
			}
	
			$description = mysql_real_escape_string($_POST['description']);
			$locations = mysql_real_escape_string($_POST['locations']);
			$media = mysql_real_escape_string($_POST['media']);
	
	
		// Insert data 
			$insert = "UPDATE farms 
						  SET name = '$name', description = '$description', locations = '$locations', media = '$media'
						  WHERE id = $farm_id
						  ";
		
			$result = mysql_query($insert);
		
	
			if (false === $result) {
				echo mysql_error();
			}
	
			if (false !== $result) {
								
				$find_recent = "  SELECT farms.* 
										FROM farms 
										WHERE id = $farm_id
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
								<p><strong>Description : </strong> <?php echo $recent_data['description']; ?></p>
							</li>
							
							<li>
								<p><strong>Locations : </strong> <?php echo $recent_data['locations']; ?></p>
							</li>
		
							<li>
								<p><strong>Media : </strong> <?php echo $recent_data['media']; ?></p>
							</li>
		
		
						</ul>
		


						<a class="floatright big-button" href="edit_ingredient_supplier.php?farm_id=<?php echo $farm_id; ?>">Edit Again</a>		
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
					<input type="text" name="name" value="<?php echo $find_farm_data['name']; ?>"/>
				</li>

	
				<li>
					<label>Description</label>
					<textarea name="description"><?php echo $find_farm_data['description']; ?></textarea>
				</li>
	
				<li>
					<label>Location(s)</label>
					<?php showLocationInput(); ?>
					<input type="text" name="locations" class="location-tally" value='<?php echo $find_farm_data['locations']; ?>' />

				</li>
	
				<li>
					<label>Media</label>
					<textarea name="media" value="<?php echo $find_farm_data['media']; ?>"></textarea>
				</li>
	
				<li>
			
					<button farm_id="<?php echo $farm_id ?>" class="delete-farm" >Delete farm</button>
			
					<input type="hidden" name="submitted" id="submitted" value="true" />
					<input type="submit" value="Save Farm" />
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