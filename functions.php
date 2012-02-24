<?php
function logo_call_to_action() {
    $logo_story = get_page_by_title('The perpetually changing crowdsourced RAAK logo', 'OBJECT', 'post');
    $logo_project = get_page_by_title('Logo Project');
?>
    <aside id="logox_counter" class="rounded-corners din-schrift">
        <span class="point_left"></span>
        <span class="point_right"></span>
        <header>
            <h2># OF LOGO COMBINATIONS</h2>
        </header>
        <div id="logox_counter_number">7744</div>
        <a id="read_the_logo_story" href="<?php echo get_permalink($logo_story->ID); ?>">Read the story behind our logo</a>
        <hr>
        <a id="upload_a_letter" href="<?php echo get_permalink($logo_project->ID); ?>">Upload a letter</a>
    </aside>
<?php
}

add_shortcode('logo_cta', 'logo_call_to_action');

function display_latest_posts() {
    $args = array('numberposts' => 20, 'category' => get_cat_id ('Blog'));
    print_r($args);
    $latest_posts = get_posts($args);
    $blog_archive_page = get_page_by_title('Blog Archive');
?>
    <div class="tab_container whitebox-primary">
        <div class="grey_tab tab tab104 rounded-corners">
            <header>
                <h2>Latest Posts</h2>
            </header>
        </div><!-- .grey_tab -->
        <div class="whitebox whitebox_primary box rounded-corners">
            <div id="whitebox_primary_post_0" class="whitebox_primary_post">
<?php
    foreach($latest_posts as $post_number => $post) {
        setup_postdata($post);
        $author_data = get_userdata($post->post_author);
        $author_full_name = $author_data->first_name . ' ' . $author_data->last_name;
        $author_page = get_page_by_title($author_full_name);
?>
                <article>
                    <header>
                    <h3><a href="<?php echo get_permalink($logo_project->ID); ?>"><?php echo $post->post_title; ?></a></h3>
                    </header>
                    <hr>
                    <div class="whitebox_primary_post_attr">
                    <span class="whitebox_primary_post_attr_item author">Posted by <a href="<?php echo get_permalink($author_page->ID); ?>"><?php echo $author_full_name; ?></a></span>
                        <span class="seperator">|</span>
                        <span class="whitebox_primary_post_attr_item date"><?php echo strftime ('%e %h %Y', strtotime ($post->post_date)); ?></span>
                        <span class="seperator">|</span>
                        <!--span class="whitebox_primary_post_attr_item time">12:44</span>
                        <span class="seperator">|</span-->
                        <span class="whitebox_primary_post_attr_item comments"><img alt="comment icon" class="commenticon" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/whitebox_primary_body_attr_comment_icon.png"><?php echo $post->comment_count." comment".(($post->comment_count == 1)?"":"s"); ?></span>
                    </div><!-- .whitebox_primary_post_attr -->
                    <div class="whitebox_primary_post_content">
                        <div class="whitebox_primary_post_content_right">
                            <a class="more_link" href="<?php echo get_permalink($logo_project->ID); ?>">More ►</a>
                        </div><!-- .whitebox_primary_post_content_right -->
                            <?php echo $post->post_excerpt; ?>
                    </div><!-- .whitebox_primary_post_content -->
                    <hr class="solid">
                </article>
<?php
    }
?>

            </div>
            <footer class="whitebox_primary_footer box_nav small_arial_caps">
                <a class="whitebox_primary_footer_left" href="<?php echo get_permalink($blog_archive_page->ID); ?>">All blog posts</a>
                <div class="whitebox_primary_footer_right">
                    <a class="active" onclick="javascript: previous();"><span class="arrow">◄</span> Previous</a>
                    <span class="seperator">|</span>
                    <a onclick="javascript: next();">Next <span class="arrow">►</span></a>
                </div><!-- .whitebox_primary_footer_right -->
            </footer><!-- .whitebox_primary_footer -->
        </div><!-- #whitebox_primary -->
    </div>

<?php
}

add_shortcode('latest_posts', 'display_latest_posts');
?>
