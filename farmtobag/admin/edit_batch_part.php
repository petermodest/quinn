<?php 
	include 'includes/functions.php';
	include 'includes/header.php'; 
	include 'includes/sidebar.php';
	$flavor = null;

?>

<div id="main-content">

		<div class="section-header farmtobag">
			<h2>Edit Batch Part</h2>

<?

if ((isset($_GET['batch_id'])) && (isset($_GET['batch_part_id']))) {
	
		$batch_id = $_GET['batch_id'];
		$batch_part_id = $_GET['batch_part_id'];
		$batch_parts = getBatchParts($batch_part_id);

// = = = = = = = = = =  FORM SUBMIT ACTIONS = = = = = = = = = = =
			
	if(isset($_POST['submitted'])) {

		$name = mysql_real_escape_string($_POST['batchpart_name']);
		$ingredient_array = mysql_real_escape_string($_POST['ingredient_array']);
		$farm_array = mysql_real_escape_string($_POST['farm_array']);
		$production_array = mysql_real_escape_string($_POST['production_array']);
		$packaging_array = mysql_real_escape_string($_POST['packaging_array']);

		$featured_ingredients = mysql_real_escape_string($_POST['featured_ingredients']);
		$featured_farms = mysql_real_escape_string($_POST['featured_farms']);
		$featured_packaging = mysql_real_escape_string($_POST['featured_packaging']);
		$featured_production = mysql_real_escape_string($_POST['featured_production']);


	// Insert data 
		$update = "UPDATE batch_parts 
					  SET name = '$name', ingredient_array = '$ingredient_array',  farm_array = '$farm_array', production_array = '$production_array', packaging_array = '$packaging_array', featured_ingredients = '$featured_ingredients', featured_farms = '$featured_farms',  featured_packaging = '$featured_packaging', featured_production = '$featured_production'
					  WHERE id = $batch_part_id";
	
		$result = mysql_query($update);

		if (false === $result) {
			echo mysql_error();
		}

		if (false !== $result) {

		  echo( '<script type="text/javascript">window.location = "batches.php";</script>') ;

		}


	
	}
?>
	<h3>You are editing a part of batch <?php echo $batch_id; ?></h3>

		</div><!-- section-header -->


<?php 
// = = = = = = = = = =  FORM  = = = = = = = = = = =
	
	if(!isset($_POST['submitted'])) { ?>


		<?php $flavor = $batch_parts['name']; ?></li>

		<div class="whitesection">

		<?php echo showFlavorSelect($flavor); ?>

			<h3>Flavor</h3>

			</div><!-- whitesection -->

		<div class="whitesection">
	
			<h3>Ingredients</h3>
			
			<ul id="supplier_ingredients_list">

				<?php showSupplierSelect('ingredients', $batch_id); ?>
				<?php showBatchSuppliers('ingredients', $batch_parts['ingredient_array'], $batch_part_id, $batch_parts['featured_ingredients']); ?>
			
			</ul>
			
		</div><!-- whitesection -->


		<div class="whitesection">
	
			<h3>Packaging</h3>
			
			<ul id="supplier_packaging_list">

				<?php showSupplierSelect('packaging', $batch_id); ?>
				<?php showBatchSuppliers('packaging', $batch_parts['packaging_array'], null, $batch_parts['featured_packaging']); ?>
			
			</ul>
			
		</div><!-- whitesection -->

		<div class="whitesection">
	
			<h3>Production</h3>
			
			<ul id="supplier_production_list">

				<?php showSupplierSelect('production', $batch_id); ?>
				<?php  showBatchSuppliers('production', $batch_parts['production_array'], null, $batch_parts['featured_production']); ?>
			
			</ul>
			
		</div><!-- whitesection -->

			<div class="whitesection">

			<form action="#" id="batchpart_form" method="POST">

					
				<input type="hidden" id="bp_name" name="batchpart_name" value="<?php echo $batch_parts['name'] ?>" />
				<input type="hidden" id="bp_ingredients" name="ingredient_array" value="<?php echo $batch_parts['ingredient_array'] ?>" />
				<input type="hidden" id="bp_farms" name="farm_array" value="<?php echo $batch_parts['farm_array'] ?>" />
				<input type="hidden" id="bp_packaging" name="packaging_array" value="<?php echo $batch_parts['packaging_array'] ?>" />
				<input type="hidden" id="bp_production" name="production_array" value="<?php echo $batch_parts['production_array'] ?>" />
				<input type="hidden" id="bp_featured_ingredients" name="featured_ingredients" value="<?php echo $batch_parts['featured_ingredients'] ?>" />
				<input type="hidden" id="bp_featured_farms" name="featured_farms" value="<?php echo $batch_parts['featured_farms'] ?>" />
				<input type="hidden" id="bp_featured_packaging" name="featured_packaging" value="<?php echo $batch_parts['featured_packaging'] ?>" />
				<input type="hidden" id="bp_featured_production" name="featured_production" value="<?php echo $batch_parts['featured_production'] ?>" />
				
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<input type="submit" class="big-button floatright" value="Save Batch">
				<div class="clearboth"></div>
				</form>
				
			</div>

<?php

			}	
		} else {
			echo '<p>Insufficient parameters Head back to <a href="batches.php">Batch List</a></p>';
	}

 ?>
</div>

<?php include 'includes/footer.php';  ?>