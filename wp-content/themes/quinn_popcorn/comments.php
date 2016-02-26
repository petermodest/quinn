<div id="comment-section">

<?php // Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if (!empty($post->post_password)) { // if there's a password
		if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie
			?>

			<p class="nocomments">This post is password protected. Enter the password to view comments.</p>

			<?php
			return;
		}
	}

	/* This variable is for alternating comment background */
	$oddcomment = 'class="alt" ';
?>

<!-- You can start editing here. -->

	<h2 id="title-comments">COMMENTS</h2>

	<?php comments_popup_link('<p class="nocomment">No comments yet, you\'re the first!</p>', '', ''); ?></p>

<?php if ($comments) : ?>



	<ol id="comment-list">

	<?php foreach ($comments as $comment) : ?>

		<li <?php echo $oddcomment; ?>id="comment-<?php comment_ID() ?>">


			<div class="comment-metadata">
				<?php comment_date('F jS, Y') ?> <br /> at <?php comment_time() ?> 
				
				<?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?>
				</div>


	
			<div class="comment-content">
			<h4><strong><?php comment_author_link() ?></strong> wrote:</h4>
			
				<?php if ($comment->comment_approved == '0') : ?>
				<em>Your comment is awaiting moderation.</em>
				<?php endif; ?>
				
			<?php comment_text() ?>

			</div><!-- comment-content -->
			
		</li>

	<?php
		/* Changes every other comment to a different class */
		$oddcomment = ( empty( $oddcomment ) ) ? 'class="alt" ' : '';
	?>

	<?php endforeach; /* end for each comment */ ?>

	</ol>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ('open' == $post->comment_status) : ?>

<div id="comment-responseform">

<h2 id="respond">COMMENT</h2>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p class="loggedin-in-as">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<input placeholder="Name (required)"  class="form-text" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

<input type="text" placeholder="Email (will not be published)"  class="form-text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p><textarea placeholder="Comment"  class="form-textarea" name="comment" id="comment" cols="65" rows="10" tabindex="4"></textarea></p>

<p><input class="form-submit" name="submit" type="submit" id="submit" tabindex="5" value="submit" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>
<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
</div><!-- #comment-responseform -->
</div><!-- #comment-section -->