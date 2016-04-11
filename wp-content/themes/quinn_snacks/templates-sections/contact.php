<?
/*
Template Name: Contact
*/
?>

<?

if(isset($_POST['submitted'])) {
	if(trim($_POST['contactName']) === '') {
		$nameError = 'Please enter your name.';
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}

	if(trim($_POST['email']) === '')  {
		$emailError = 'Please enter your email address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = 'Please enter a message.';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		$emailTo = get_option('tz_email');
		if (!isset($emailTo) || ($emailTo == '') ){
			$emailTo = 'quinnpopcrew@quinnpopcorn.com';
		}
		$subject = 'Contact : From '.$name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

} ?>

<? get_header(); ?>

	<? if( have_posts() ) : ?>
		<? while( have_posts()) : ?>
			<? the_post() ?>

			<div id="contact-wrapper" class="row">
				<div class="inner">
					<div id="contact-rightside" class="col span-8 right">
						<div <? post_class() ?> id="post-<? the_ID(); ?>">
							<h2 class="entry-title"><? the_title(); ?></h2>
							<div class="entry-content">
								<? if( isset( $emailSent ) && $emailSent == true ) : ?>
									<div class="thanks">
										<p>Thanks, your email was sent successfully.</p>
									</div>
								<? else : ?>
									<? the_content(); ?>
									<? if( isset( $hasError ) || isset( $captchaError ) ) : ?>
										<p class="error">Sorry, an error occured.<p>
									<? endif ?>
		
									<form action="<? the_permalink() ?>" id="contactForm" method="post">
										<ul class="contactform">
											<li>
				
												<input type="text" placeholder="Name" name="contactName" id="contactName" value="<? if(isset($_POST['contactName'])) echo $_POST['contactName'] ?>" class="required requiredField form-text" />
												<? if( $nameError != '' ) : ?>
													<span class="error"><?= $nameError ?></span>
												<? endif ?>
											</li>
				
											<li>
				
												<input type="text" placeholder="Email" name="email" id="email" value="<? if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email form-text" />
												<? if( $emailError != '' ) : ?>
													<span class="error"><?= $emailError ?></span>
												<? endif ?>
											</li>
				
												<textarea placeholder="Message" name="comments" id="commentsText" rows="10" cols="70" class="required requiredField form-textarea"><? if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
												<? if( $commentError != '' ) : ?>
													<span class="error"><?= $commentError ?></span>
												<? endif ?>
											</li>
				
											<li>
												<input type="submit" class="form-submit floatright" value="submit" />
											</li>
										</ul>
										<input type="hidden" name="submitted" id="submitted" value="true" />
									</form>
								<? endif ?>
							</div>
						</div>
					</div>
	
					<div id="contact-sidebar" class="col span-4">
						<img id="contact-image" src="<? echo site_url('/') . "wp-content/quinn-images/contact-images/" . get_post_meta($post->ID, "contact_image", true); ?>.jpg" />
					</div>
				</div>
			</div>
		<? endwhile ?>
	<? endif; ?>

<? get_footer(); ?>
