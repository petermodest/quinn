<?php 
	
	include 'includes/header.php'; 
	include 'includes/sidebar.php';
	include 'includes/templates.php';
	$state = null;
?>


<div id="main-content">

<?php 

	if (isset($_GET['supplier_type'])) {

		$supplier_type = $_GET['supplier_type'];
		$tablename = 'supplier_'.$supplier_type;

	?>
			<div class="section-header farmtobag">
			<h2>Add <?php echo $supplier_type; ?> Supplier</h2>
		
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
		 
		$insert = "INSERT INTO supplier_ingredients (`name`, `supply`, `description`, `locations`, `certifications`, `website`, `extra_links`, `media`, `layers_deep`, `images`  )
					 VALUES ('$name', '$supply', '$description', '$locations', '$certifications', '$website', '$extra_links', '$media', '$layers_deep', '$images' )";
		}
		else {

		$insert = "INSERT INTO $tablename (`name`, `supply`, `description`, `locations`  )
					 VALUES ('$name', '$supply', '$description', '$locations' )";

		}
		
			$result = mysql_query($insert);
		
	
			if (false === $result) {
				echo mysql_error();
			}
	
			if (false !== $result) {
								
		// find most recent ID 				
			$find_recent = "  SELECT $tablename.* 
									FROM $tablename 
								 	ORDER BY id DESC
								 	LIMIT 1 
								 	"; 
				
				$recent_result = mysql_query($find_recent);
				
				if (false === $recent_result) { 
				
					echo mysql_error();
						
						}			
	
				if (false !== $recent_result) {

			
					$recent_data = mysql_fetch_array($recent_result);

// create featured document with basic data
					
					$dir = '../content/featured/';
					$file = $dir . 'supplier_template.txt';
					$newfile = $dir . $supplier_type . '_' . $recent_data['id'] .'.html';

					$file = file_get_contents($file, FILE_USE_INCLUDE_PATH);

					$new_file_contents = str_replace('%NAME%', $recent_data['name'], $file);

					file_put_contents($newfile, $new_file_contents);

					?> 
			



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
		


						<a class="floatright big-button" href="edit_supplier.php?supplier_id=<?php echo $recent_data['id']; ?>&supplier_type=<?php echo $supplier_type; ?>">Edit</a>		
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
					<input type="text" name="name" value=""/>
				</li>

				<li>
					<label>Supply</label>
					<input type="text" name="supply"  value="" />
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
	
		<?php if ($supplier_type == 'ingredients') { ?>
				<li>
					<label>Certifications</label>
					<input type="text" name="certifications" value=""/>
				</li>
	
				<li>
					<label>Website</label>
					<input type="text" name="website" value="" />
				</li>
	
				<li>
					<label>Media</label>
					<textarea name="media" value=""></textarea>
				</li>
	
				<li>
					<label>Extra Links</label>
					<textarea name="extra_links" value=""></textarea>
				</li>
	
				<li>
					<label>Layers Deep</label>
					<input type="text" name="layers_deep" value="" />
				</li>

		<?php } ?>

				<li>
					<label>Images</label>
					<input type="text" name="images" placeholder="Upload to content/images. Filenames here, comma delinated." value="" />
				</li>
				
				<li>
					<input type="hidden" name="submitted" id="submitted" value="true" />
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