<?php
/*
Template Name: Newsletter Signup
*/
?>

<?php get_header(); ?>

<div id="contact-wrapper">


	<?php if ( have_posts() ) : ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<div id="contact-sidebar">
			<img id="contact-image" src="<?php echo site_url('/') . "wp-content/quinn-images/contact-images/" . get_post_meta($post->ID, "contact_image", true); ?>.jpg" />
		</div>

		<div id="contact-rightside">
			<h2><?php the_title(); ?> </h2>
			<?php the_content(); ?>

	<?php endwhile; endif; ?>

	<form action="http://quinnpopcorn.us4.list-manage1.com/subscribe/post?u=5547f550ffea69fface2db29d&amp;id=57a1722085" method="post" id="form-newsletter" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>

	<p>First, what do you want to hear?</p>

	 <ul>
	    <li><input type="checkbox" value="1" name="group[8173][1]" id="mce-group[8173]-8173-0"><label for="mce-group[8173]-8173-0">  Save Cash - deals and specials on Quinn Popcorn</label></li>
			<li><input type="checkbox" value="2" name="group[8173][2]" id="mce-group[8173]-8173-1"><label for="mce-group[8173]-8173-1">  Food Finds - our team’s new natural food and beer discoveries</label></li>
			<li><input type="checkbox" value="4" name="group[8173][4]" id="mce-group[8173]-8173-2"><label for="mce-group[8173]-8173-2">  Backstage - join us on the roller coaster ride as we try to get QP out there</label></li>
			<li><input type="checkbox" value="8" name="group[8173][8]" id="mce-group[8173]-8173-3"><label for="mce-group[8173]-8173-3">  Startup Food - lessons learned while getting a food company off the ground</label></li>
	</ul>

	<p>Second, who are you?</p>

		<input type="email" value="" name="EMAIL" placeholder="Email Address" class="required email form-text" id="mce-EMAIL">
		<br />
		<br />
		<input type="text" value="" name="FNAME" placeholder="First Name" class="required form-text" id="mce-FNAME">

		<input type="text" value="" name="LNAME" placeholder="Last Name" class="required form-text" id="mce-LNAME">


	<input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="form-submit">
</form>

<br />
<hr>
<br />
<p><strong>Need to unsubscribe?</strong></p>

<br />

<p>Well <a href="http://quinnpopcorn.us4.list-manage.com/unsubscribe?u=5547f550ffea69fface2db29d&id=57a1722085">click here</a> and consider it done!</p>

<br />

</div><!-- contact-rightside -->
</div><!-- contact-wrapper -->

<div class="clearboth"></div>


<?php get_footer(); ?>
