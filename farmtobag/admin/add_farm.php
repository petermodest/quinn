<?php 
	
	include 'includes/header.php'; 
	include 'includes/sidebar.php';
	include 'includes/templates.php';

	$state = null;
?>

<div id="main-content">

		<div class="section-header farmtobag">
			<h2>Add Farm</h2>
<?php 

	if (isset($_GET['supplier_id'])) {
		$supplier_id = $_GET['supplier_id'];

	// get supplier name for header 
	
	
		$find_supplier = "SELECT supplier_ingredients.* 
								FROM supplier_ingredients 
								WHERE id = $supplier_id
							 	LIMIT 1 
							 	"; 
			
			$find_supplier_result = mysql_query($find_supplier);
			
			if (false === $find_supplier_result) { echo mysql_error(); }			

			if (false !== $find_supplier_result) { 
					
				$find_supplier_data = mysql_fetch_array($find_supplier_result); 
			
			
			} ?>
			
			<h3>You are adding a farm to <?php echo $find_supplier_data['name']; ?></h3>	
			

		</div><!-- section-header -->

		<div class="whitesection">


<?
	if(isset($_POST['submitted'])) {

	// Validate Name (only required field) 
	
		if(trim($_POST['name']) === '') {
			$nameError = 'Please enter a farm name.';
			$hasError = true;
		} else {

		$name = mysql_real_escape_string($_POST['name']);

		}

		$supplier_id = $find_supplier_data['id'];
		
		$description = mysql_real_escape_string($_POST['description']);
		$locations = mysql_real_escape_string($_POST['locations']);


	// Insert data 
		$insert = "INSERT INTO farms (`name`, `description`, `locations`, `supplier_id`  )
					 VALUES ('$name', '$description', '$locations', '$supplier_id' )";
	
		$result = mysql_query($insert);
	

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {
							
	// find most recent ID 				
			$find_recent = "  SELECT farms.* 
									FROM farms 
								 	ORDER BY id DESC
								 	LIMIT 1 
								 	"; 
			
			$recent_result = mysql_query($find_recent);
			
			if (false === $recent_result) { 
			
				echo mysql_error();
					
					}			

			if (false !== $recent_result) { 		

		
				$recent_data = mysql_fetch_array($recent_result); ?> 
		
				<div id="add_summary">
				
					<h2>Farm Saved!</h2>
		
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
	
	
					</ul>
	
					<a class="floatright big-button" href="edit_farm.php?farm_id=<?php echo $recent_data['id']; ?>">Edit Entry</a>		
					<a class="floatright big-button" href="suppliers.php">View supplier list</a>
					<div class="clearboth"></div>
				</div><!-- add summary -->
			<?php
			}

		}
} 

	if(!isset($_POST['submitted'])) {

?>

<div id="add-edit-form-wrapper">
	
	<form action="#"  method="post">

		<ul class="data-list">
			<li>
				<label>Name</label>
				<input type="text" name="name" />
			</li>

			<li>
				<label>Description</label>
				<textarea name="description"></textarea>
			</li>

			<li>
				<label>Location(s)</label>
					<?php showLocationInput(); ?>
					<input type="text" class="location-tally" name="locations"  value=''/>
			</li>

			<li>

			<li>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<input type="submit" value="Save Farm" />
			</li>

		</ul>

	</form>


	</form>
</div> <!-- add-edit-form-wrapper -->
<? }

} // isset GET id
else {
	echo '<p>No supplier ID was assigned. Head back to <a href="suppliers.php">Supplier/Farm List</a></p>';
}

 ?>


<?php include 'includes/footer.php';  ?>