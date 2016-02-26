<?php

include('includes/header.php'); 

if (isset($_GET['id'])) {

	$range_id = $_GET['id'];
	$range_id = $range_id;

	$query_batches = "SELECT batches.*
							FROM batches
							WHERE FIND_IN_SET('$range_id', batches.id_range) > 0
							LIMIT 1
							"; 
													 
	$result_batches = mysql_query($query_batches);
	
	if (false === $result_batches) { 
		echo mysql_error();
		}			
	if (false !== $result_batches) { 							
		$data_batches = mysql_fetch_array($result_batches);
	
		$batch_id = $data_batches['id'];
		$batch_number = $data_batches['number'];
	}

	if (isset($batch_id)) {

	$batch_parts = getBatchParts($batch_id);
	$featured_suppliers = getFeaturedInfo($batch_parts);

  ?>
		
		<div id="view-header-wrapper">
		
			<div id="view-header">
				<h1>BATCH <span>#<?php echo $batch_number; ?></span></h1>
				<div id="checkanotherbatch_wrapper">
					<div id="checkanotherbatch">
						<a href="http://www.quinnsnacks.com/farmtobag" >&larr; check another batch</a>
					</div>
				</div>
			</div>
			
		</div><!-- view header-wrapper -->	
		
	<div id="main-content">

		<div id="tab-wrapper">
		
			<div id="tab-nav">

				<ul>
				<li> 
					<h3><a href="#tab-featured">Featured Suppliers</a></h3>
				</li>

			<?php
				foreach($batch_parts as $val) {
					echo '<li><h3><a href="#tab-' . $val['name'] . '">' . translate_flavors($val['name']) . '</a></h3></li>';
					echo "\n\t\t";
				}
			?>
				</ul>
			</div>
	
			<div class="tab" id="tab-featured">

				<div id="featured-map"><?php 
				
				showFeaturedMap($featured_suppliers); ?></div>	
				<div id="featured-suppliers-wrap">

				<p><strong>Select your flavor above to see its ingredients.</strong></p>

					<?php echo showFeaturedList($featured_suppliers); ?>
					
		</div><!-- featured-supplier-wrap -->
						
		</div><!-- featured-supplies -->

			<?php 
	
			foreach($batch_parts as $val) {
	
				echo '<div class="tab" id="tab-' . $val['name'] . '">';
		
					//$featured_states = getFeaturedStates($val, 'all');
					//showMap($featured_states, $val['name']);
		
					echo '<div class="batch-sections">';
					
						echo	showBatchSuppliers($val, 'ingredients');
						echo	showBatchSuppliers($val, 'packaging');
						//echo	showBatchSuppliers($val, 'production');
		
					echo "</div>";
	
				echo '</div><!-- .batch-part -->'; 
		
			}
			?>
		
			</div>
		
		</div><!-- tab-wrapper -->
	
	</div><!-- main-content -->


<div id="layersdeep-info">

	<p>Rustic photos of farmers are wonderful, but information on each and every ingredient is more meaningful. That’s why we created layers deep. It keeps this from becoming a marketing gimmick. It keeps us honest.</p>
	<ol> 
		<li><strong>1 Layer Deep</strong>: Full ingredient name. No ‘natural flavors’, or other ingredient obfuscation. </li>
		<li><strong>2 Layers Deep</strong>: Source listed. This should include the name of the supplier and the region that the ingredient is farmed, harvested, or created. Basic ingredient certifications should also be shown.</li>
		<li><strong>3 Layers Deep</strong>: Farm level information. This should include the name of the farm(s), the location of the farm, and an overview of their farming practices.</li>
		<li><strong>4 Layers Deep</strong>: Harvest information. This should include the date and location that the ingredient was harvested, processed, etc. This should also include an overview of employee work standards.</li>
	</ol>

</div>

<?php 

	}// if batch ID is set
	else {
		echo '<p class="errormessage">Hmm ... No batch ID matches that number. <a href="index.php">Try again</a>?</p>';
	}
 
} else { // if GET is not set

	echo '<p class="errormessage"> Hmm, there seems to be a problem retrieving your batch. <a href="index.php">Try again</a>?</p>';

}

include('includes/footer.php'); 


?>