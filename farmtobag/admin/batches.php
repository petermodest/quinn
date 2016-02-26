<?php include 'includes/functions.php' ?>
<?php include 'includes/header.php' ?>
<?php include 'includes/sidebar.php' ?>



<div id="main-content">

		<div class="section-header">
			<button id="add-batch">Add Batch</button>
			<h2>Batches</h2>

		</div><!-- section-header -->

	<ul id="batch-list">

			<?php 
			// show all ingredient suppliers
			
				$query_batches = "SELECT batches.*
										FROM batches
										"; 
												 
				$result_batches = mysql_query($query_batches);
				
				if (false === $result_batches) { echo mysql_error();}			
				if (false !== $result_batches) { 			
				
				while($data_batches = mysql_fetch_array($result_batches)) {
					$batch_id = $data_batches['id'];
					
					$id_range = $data_batches['id_range'];
					$id_range = str_replace(',',', ', $id_range);
					
					$featured = $data_batches['featured'];
					if ($featured == 1) {
						
						$featured_id = ' id="featured-batch" ';
						
					} else {
						$featured_id = ' ';
					}
				 ?>

					
					<li class="whitesection">

						<a href="add_batch_part.php?batch_id=<?php echo $batch_id; ?>" class="short-button">Add Flavor</a>

						<div class="id_range">
							<input type="text" batch_id="<?php echo $batch_id; ?>" placeholder="trigger id #s, comma deliniated" value="<?php echo $id_range ?>" />
						</div>
						
						<div class="batchnumber" <?php echo $featured_id; ?>><?php echo $data_batches['number']; ?></div>

							<?php
			
								$query_parts = "SELECT batch_parts.*
													 FROM batch_parts
													 WHERE batch_id = $batch_id
															"; 
																 
								$result_parts = mysql_query($query_parts);
								
								if (false === $result_parts) { echo mysql_error();}			
								if (false !== $result_parts) { 			
									echo '<ul class="batch_parts">';	
																
								while($data_parts = mysql_fetch_array($result_parts)) { ?>

									<li class="batch_part"><?php echo translate_flavors($data_parts['name']); ?> 
										
										<a batch_part_id="<?php echo $data_parts['id']; ?>" class="edit-link delete_batch_part">delete</a>
										
										<a href="edit_batch_part.php?batch_id=<?php echo $data_batches['id']; ?>&batch_part_id=<?php echo $data_parts['id']; ?> " class="edit-link">edit</a></li>
									
								<?php } 
									
									echo '</ul>';								

								}
							?>

						<button batch_id="<?php echo $batch_id; ?>" class="delete_batch btn-smallgray">delete batch</button>
						<button batch_id="<?php echo $batch_id; ?>" class="clone_batch btn-smallgray">clone batch</button>
						<button batch_id="<?php echo $batch_id; ?>" class="change_batch_number btn-smallgray">change number</button>

					</li>
				
				<?php 
					}
				} 
				
					?>
			</ul>
			
			

</div><!-- main-content -->

<?php include 'includes/footer.php' ?>
