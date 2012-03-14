<div class="comments">
<?php
if (have_comments()) {
    $comments_html = '';
    $comments_num = 0;
    $trackbacks_html = '';
    $trackbacks_num = 0;
    foreach($comments as $comment) {
        if ($comment->comment_approved == 1) {
            $timestamp = strtotime($comment->comment_date);
            if ($comment->comment_type != ('pingback' || 'trackback')) {
                $comment_content = apply_filters('comment_text', $comment->comment_content);
                $comments_html .= '
                <li id="comment-' . $comment->comment_ID . '" class="' . get_comment_type() . '">
                    <div class="comment-author vcard">' . get_avatar((($comment->user_id != 0) ? $comment->user_id : $comment->comment_author_email), $size = '32') . '
                    </div>
                    <div class="comment-meta">
                        <div class="comment-meta-author">Posted by <a href="' . $comment->comment_author_url . '" rel="external nofollow" class="url">' . $comment->comment_author . '</a>
                        </div>
                        <div class="comment-meta-date">' . date('F j, Y \a\t g:i a', $timestamp) . ' <span class="separator>|</span> <a href="#comment-' . $comment->comment_ID . '" title="Permalink to this comment">Permalink</a>
                        </div>
                    </div><p>' . $comment_content . '</p>
                    </li>';
                $comments_num++;
            } else {
                $trackbacks_html .= '
                <li id="comment-' . $comment->comment_ID . '" class="' . get_comment_type() . '">
                    <div class="comment-author">By <a href="' . $comment->comment_author_url . '" rel="external nofollow" class="url">' . $comment->comment_author . '</a> on ' . date('F j, Y \a\t g:i a', $timestamp) . '</div><p>' . $comment->comment_content . '</p>
                </li>';
                $trackbacks_num++;
            }
        }
    }
    if($comments_num != 0) {
?>
    <div id="comments-list" class="comments">
        <h3><?php echo $comments_num; ?> Comment<?php echo ($comments_num < 1) ? 's' : ''; ?></h3>
            <ul>
<?php
        echo $comments_html;
?>
            </ul>
    </div><!-- #comments-list .comments -->
<?php
    }
    if ($trackbacks_num != 0) {
?>
    <div id="trackbacks-list" class="comments">
        <h3><span><?php echo $trackbacks_num; ?></span> Trackback<?php echo ($trackbacks_num < 1) ? 's' : ''; ?></h3>
        <ul>
<?php
        echo $trackbacks_html;
?>
        </ul>
    </div><!-- #trackbacks-list .comments -->
<?php
    }
}
?>
<?php
if ( 'open' == $post->comment_status ) {
    do_action('populate_options');
    $req = get_option('require_name_email'); // Checks if fields are required. Thanks, Adam. ;-)
?>

                <div id="whitebox_primary_comments">
                    <header>
					    <h4>Leave a Comment</h4>
                    </header>

<?php
    if ( get_option('comment_registration') && !$user_ID ) { 
?>
					<p id="login-req"><?php printf(__('You must be <a href="%s" title="Log in">logged in</a> to post a comment.'),
					get_bloginfo('wpurl') . '/wp-login.php?redirect_to=' . get_permalink() ) ?></p>

<?php
    } 
    else {
?>
					<div class="formcontainer">	
						<form name="commentform" id="commentform" action="<?php bloginfo('wpurl') ?>/wp-comments-post.php" method="post">

<?php
        if ( $user_ID ) {
?>
							<p id="login"><?php printf( __( '<span class="loggedin">Logged in as <a href="%1$s" title="Logged in as %2$s">%2$s</a>.</span> <span class="logout"><a href="%3$s" title="Log out of this account">Log out?</a></span>', 'sandbox' ),
								get_bloginfo('wpurl') . '/wp-admin/profile.php',
								wp_specialchars( $user_identity, 1 ),
								get_bloginfo('wpurl') . '/wp-login.php?action=logout&amp;redirect_to=' . get_permalink() ) ?></p>

<?php
        } else {
?>

							<p class="bigger_arial_no_caps grey_text">Your email is <em>never</em> shared. <?php echo ($req) ? 'Required fields are marked <span class="required">*</span>' : ''; ?></p>

							<label class="form-label bigger_arial_caps grey_text" for="author">Name</label> <?php echo ($req) ? '<span class="required">*</span>' : ''; ?>
							<input id="author" name="author" class="text<?php echo ($req) ? ' required' : ''; ?>" type="text" value="<?php echo $comment_author ?>" size="30" maxlength="50" tabindex="3" />

							<label class="form-label bigger_arial_caps grey_text" for="email">Email</label> <?php if ($req) '<span class="required">*</span>' ?>
							<input id="email" name="email" class="text<?php echo ($req) ? ' required' : ''; ?>" type="text" value="<?php echo $comment_author_email ?>" size="30" maxlength="50" tabindex="4" />

							<label class="form-label bigger_arial_caps grey_text" for="url">Website</label>
							<input id="url" name="url" class="text" type="text" value="<?php echo $comment_author_url ?>" size="30" maxlength="50" tabindex="5" />

<?php
        }
 // REFERENCE: * if ( $user_ID ) ?>

							<label class="form-label bigger_arial_caps grey_text" for="comment">Comment</label>
							<textarea id="comment" name="comment" class="text required" cols="45" rows="8" tabindex="6"></textarea>

							<input type="hidden" name="submit" value="Post Comment" /><!--span id="commentform_submit"--><input id="submit" name="submit" class="button" type="submit" value="Post Comment" tabindex="7" /><!--/span--><input type="hidden" name="comment_post_ID" value="<?php echo $id ?>" />

							<div class="form-option"><?php do_action( 'comment_form', $post->ID ) ?></div>

						</form><!-- #commentform -->
					</div><!-- .formcontainer -->
<?php
    }
 // REFERENCE: if ( get_option('comment_registration') && !$user_ID ) ?>

				</div><!-- #respond -->
<?php
}
// REFERENCE: if ( 'open' == $post->comment_status ) ?>


</div><!-- comments -->
