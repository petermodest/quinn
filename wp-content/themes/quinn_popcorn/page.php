

<?php get_header(); ?>


	<?php if ( have_posts() ) : ?>


			<?php while ( have_posts() ) : the_post(); ?>

				<div id="page-template-content">						
				
						<?php
						
						
						/* starts way higher */
						/* h2 gets sucked up in to the image */
						/* manually add class for superwidth imgs */
						
						
						 the_content(); ?> 
				</div>
			
			
				<?php endwhile; endif; ?>




<?php get_footer(); ?>
