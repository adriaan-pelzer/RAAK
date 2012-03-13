<div class="comments">
<?php
if (have_comments()) {
    $comments = '';
    $comments_num = 0;
    $trackbacks = '';
    $trackbacks_num = 0;
    foreach($commments as $comment) {
        if ($comment->comment_approved == 1) {
            $timestamp = strtotime($comment->comment_date);
            if ($comment->comment_type != ('pingback' || 'trackback')) {
                $comments .= '
                <li id="comment-' . $comment->comment_ID . '" class="' . get_comment_type() . '">
                    <div class="comment-author vcard">' . get_avatar(($comment->user_id != 0) ? $comment->user_id : $comment->$comment_author_email, $size = '32') . '
                    </div>
                    <div class="comment-meta">
                        <div class="comment-meta-author">Posted by <a href="' . $comment->comment_author_url . '" rel="external nofollow" class="url">' . $comment->comment_author . '</a>
                        </div>
                        <div class="comment-meta-date">' . date('F j, Y \a\t g:i a', $timestamp) . ' <span class="separator>|</span> <a href="' . get_comment_link($comment->comment_ID) . '" title="Permalink to this comment">Permalink</a>
                        </div>
                    </div>' . $comment->comment_content . '
                    </li>';
                $comments_num++;
            } else {
                $trackbacks .= '
                <li id="comment-' . $comment->comment_ID . '" class="' . get_comment_type() . '">
                    <div class="comment-author">By <a href="' . $comment->comment_author_url . '" rel="external nofollow" class="url">' . $comment->comment_author . '</a> on ' . date('F j, Y \a\t g:i a', $timestamp) . '</div>' . $comment->comment_content . '
                </li>';
                $trackbacks_num++;
            }
        }
    }
    if($comments_num != 0) {
?>
    <div id="comments-list" class="comments">
        <h3><?php echo $comments_num; ?> Comment<?php echo ($comments_num == 1) ? 's' : ''; ?></h3>
            <ul>
<?php
        echo $comments;
?>
            </ul>
    </div><!-- #comments-list .comments -->
<?php
    }
    if ($trackbacks_num != 0) {
?>
    <div id="trackbacks-list" class="comments">
        <h3><span><?php echo $trackbacks_num; ?></span> Trackback<?php echo ($trackbacks_num == 1) ? 's' : ''; ?></h3>
        <ul>
<?php
        echo $trackbacks;
?>
        </ul>
    </div><!-- #trackbacks-list .comments -->
<?php
    }
}
?>
</div><!-- comments -->
