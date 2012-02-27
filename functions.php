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

function display_latest_posts($args) {
    extract(shortcode_atts(array('category' => '0', 'posts_per_page' => 0, 'num_posts' => '0'), $args));
    $latest_posts = get_posts(array('numberposts' => $num_posts, 'category' => get_cat_id ($category)));
    $blog_archive_page = get_page_by_title('Blog Archive');
?>
    <div class="tab_container whitebox-primary">
        <div class="grey_tab tab tab104 rounded-corners">
            <header>
                <h2>Latest Posts</h2>
            </header>
        </div><!-- .grey_tab -->
        <div class="whitebox whitebox_primary box rounded-corners">
<?php
    foreach($latest_posts as $post_number => $latest_post) {
        setup_postdata($latest_post);
        $author_data = get_userdata($latest_post->post_author);
        $author_full_name = $author_data->first_name . ' ' . $author_data->last_name;
        $author_page = get_page_by_title($author_full_name);
        if (($post_number % $posts_per_page) == 0) {
?>
            <div id="whitebox_primary_post_<?php echo $post_number; ?>" class="whitebox_primary_post<?php if ($post_number == 0) { echo " current"; } ?>">
<?php
        }
?>
                <article>
                    <header>
                    <h3><a href="<?php echo get_permalink($logo_project->ID); ?>"><?php echo $latest_post->post_title; ?></a></h3>
                    </header>
                    <hr>
                    <div class="whitebox_primary_post_attr">
                    <span class="whitebox_primary_post_attr_item author">Posted by <a href="<?php echo get_permalink($author_page->ID); ?>"><?php echo $author_full_name; ?></a></span>
                        <span class="seperator">|</span>
                        <span class="whitebox_primary_post_attr_item date"><?php echo strftime ('%e %h %Y', strtotime ($latest_post->post_date)); ?></span>
                        <span class="seperator">|</span>
                        <span class="whitebox_primary_post_attr_item comments"><img alt="comment icon" class="commenticon" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/whitebox_primary_body_attr_comment_icon.png"><?php echo $latest_post->comment_count." comment".(($latest_post->comment_count == 1)?"":"s"); ?></span>
                    </div><!-- .whitebox_primary_post_attr -->
                    <div class="whitebox_primary_post_content">
                        <div class="whitebox_primary_post_content_right">
                                    <a href="<?php echo get_permalink ($latest_post->ID); ?>"><?php echo get_image_or_video ($latest_post->post_content, 162, 104); ?></a>
                            <a class="more_link" href="<?php echo get_permalink($logo_project->ID); ?>">More ►</a>
                        </div><!-- .whitebox_primary_post_content_right -->
                        <p>
                            <?php echo $latest_post->post_excerpt; ?>
                        </p>
                    </div><!-- .whitebox_primary_post_content -->
                    <hr class="solid">
                </article>
<?php
        if (($post_number % 2) == 1) {
?>
            </div>
<?php
        }

    }
?>
            <footer class="whitebox_primary_footer box_nav small_arial_caps">
                <a class="whitebox_primary_footer_left" href="<?php echo get_permalink($blog_archive_page->ID); ?>">All blog posts</a>
                <div class="whitebox_primary_footer_right pagination">
                    <a class="previous active"><span class="arrow">◄</span> Previous</a>
                    <span class="seperator">|</span>
                    <a class="next">Next <span class="arrow">►</span></a>
                </div><!-- .whitebox_primary_footer_right -->
            </footer><!-- .whitebox_primary_footer -->
        </div><!-- whitebox_primary -->
    </div><!-- tab_container -->
<?php
}

add_shortcode('latest_posts', 'display_latest_posts');

function our_work_home_blue()
{
    $home = get_page_by_title('Home');
    $our_work = get_page_by_title('Our Work');
    $work_categories = get_categories(array('child_of'=>get_cat_id ('RAAK projects'), 'order'=>'desc'));
    $our_work_bluebox_content = '';
    
?>
    <div id="bluebox_home_left" class="bluebox box rounded-corners">
        <header>
            <h2 class="din-schrift"><a href="<?php get_permalink($our_work->ID); ?>">Our Work</a></h2>
        </header>
        <hr>
        <?php echo $home->post_content; ?>    
    </div>
    <div id="bluebox_home_right" class="bluebox bluebox_primary_no_margin box rounded-corners">
        <nav class="bluebox_nav box_nav">
<?php
    foreach($work_categories as $cat_number => $work_category)
    {
?>
            <?php if($cat_number != 0){?><span class="seperator">|</span><?php } ?>
            <h3 class="bluebox_nav_item small_arial_caps"><a class="<?php echo $work_category->category_nicename . ' '; if($cat_number == 0){?>active<?php } ?>"><?php echo $work_category->name; ?></a></h3>
<?php
        $current_our_work_post_cat = get_cat_id ($work_category->name);
        $current_our_work_post = new WP_Query('cat=' . $current_our_work_post_cat .'', ); get_posts(array('numberposts' => 1, 'category' => $current_our_work_post_cat));
        $current_our_work_post_id = ($current_our_work_post[0]->ID);
        $our_work_bluebox_content .= '<section class="bluebox_content our_work_bluebox_content';
        if($cat_number == 0){
            $our_work_bluebox_content .= ' current';
        }
        $our_work_bluebox_content .= '" id="' . $work_category->category_nicename . '">';
        $our_work_bluebox_content .= '<a href="' . get_permalink($current_our_work_post_id) . '">';
        $our_work_bluebox_content .= get_image_or_video ($current_our_work_post[0]->post_content, 315) . '</a>';
        $our_work_bluebox_content .= '<ul><li class="bluebox_content_sub"><span class="label">Client:</span><span class="title">' . get_post_meta ($current_our_work_post_id, 'Client', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_sub"><span class="label">Project:</span><span class="title">' . get_post_meta ($current_our_work_post_id, 'Project', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_sub"><span class="label">Overview:</span><span class="title">' . get_post_meta ($current_our_work_post_id, 'Overview', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_link"><a href="' . get_category_link($current_our_work_post_cat) . '" rel="nofollow">More Projects &#9660;</a></li></ul></section>';
    }
?>
        </nav>
<?php
    echo $our_work_bluebox_content;
?>
    
    </div>

<?php
}

add_shortcode('OW_home', 'our_work_home_blue');
?>
<?php 
/***************************** From local functions on old site **************************/

function patch_dimensions ($code, $width, $height) {
    $widthtexts = array();
    $heighttexts = array();
    $oldwidth = -1;
    $oldheight = -1;

    if (preg_match ("/width=\"([^\"]+)\"/", $code, $widthtexts)) {
        $oldwidth = $widthtexts[1];
    }

    if (preg_match ("/height=\"([^\"]+)\"/", $code, $heighttexts)) {
        $oldheight = $heighttexts[1];
    }

    if ($width && $height) {
        $patchwidth = TRUE;
        $patchheight = TRUE;
    } else if ($height) {
        $patchwidth = FALSE;
        $patchheight = TRUE;
    } else if ($width) {
        $patchwidth = TRUE;
        $patchheight = FALSE;
    } else {
        $patchwidth = FALSE;
        $patchheight = FALSE;
    }

    if ($patchwidth && $patchheight) {
        if ($oldwidth == -1) {
            $code = preg_replace ("/\/?>$/", " width=\"".$width."\" />", $code);
        } else {
            $code = preg_replace ("/width=\"[^\"]+\"/", " width=\"".$width."\"", $code);
        }
        if ($oldheight == -1) {
            $code = preg_replace ("/\/?>$/", " height=\"".$height."\" />", $code);
        } else {
            $code = preg_replace ("/height=\"[^\"]+\"/", "height=\"".$height."\"", $code);
        }
    } else if ($patchwidth) {
        if ($oldwidth == -1) {
            $code = preg_replace ("/\/?>$/", " width=\"".$width."\" />", $code);
        } else {
            $code = preg_replace ("/width=\"[^\"]+\"/", " width=\"".$width."\"", $code);
            if ($oldheight != -1) {
                $code = preg_replace ("/height=\"[^\"]+\"/", "height=\"".$width*$oldheight/$oldwidth."\"", $code);
            }
        }
    } else if ($patchheight) {
        if ($oldheight == -1) {
            $code = preg_replace ("/\/?>$/", " height=\"".$height."\" />", $code);
        } else {
            $code = preg_replace ("/height=\"[^\"]+\"/", "height=\"".$height."\"", $code);
            if ($oldwidth != -1) {
                $code = preg_replace ("/width=\"[^\"]+\"/", "width=\"".$height*$oldwidth/$oldheight."\"", $code);
            }
        }
    }

    return $code;
}

function mine_gallery ($id) {
    global $wpdb;

    $records = $wpdb->get_results ("SELECT path FROM ".$wpdb->nggallery." WHERE gid=".$id);

    $path = $records[0]->path;

    $records = $wpdb->get_results ("SELECT filename FROM ".$wpdb->nggpictures." WHERE galleryid=".$id." ORDER BY `sortorder` LIMIT 1");
    $filename = $records[0]->filename;

    $returncode = "<img alt=\"".$records[0]->alttext."\" src=\"".get_bloginfo('url')."/".$path."/".$filename."\" ";

    if ($width) {
        $returncode .= "width=\"".$width."\" ";
    }

    if ($height) {
        $returncode .= "height=\"".$height."\" ";
    }

    $returncode .= "/>";

    return $returncode;
}

function get_image_or_video ($post_content, $width=NULL, $height=NULL) {
    $returncode = NULL;
    $gallerytext = array();
    $videotext = array();
    $imagetext = array();

    $gallerymatch = preg_match ("/\[nggallery id=(\d+)\]/", $post_content, $gallerytext, PREG_OFFSET_CAPTURE);
    $videomatch = preg_match ("/<object.*<\/object>/", $post_content, $videotext, PREG_OFFSET_CAPTURE);
    $imagematch = preg_match ("/<img[^>]+>/", $post_content, $imagetext, PREG_OFFSET_CAPTURE);

    if ($gallerymatch && $videomatch && $imagematch) {
        if (($gallerytext[0][1] < $videotext[0][1]) && ($gallerytext[0][1] < $imagetext[0][1])) {
            return patch_dimensions (mine_gallery ($gallerytext[1][0]), $width, $height);
        } else if (($videotext[0][1] < $gallerytext[0][1]) && ($videotext[0][1] < $imagetext[0][1])) {
            return patch_dimensions ($videotext[0][0], $width, $height);
        } else {
            return preg_replace ("/ class=\"[^\"]*\"/", "", patch_dimensions ($imagetext[0][0], $width, $height));
        }
    } else if ($gallerymatch && $videomatch) {
        if ($gallerytext[0][1] < $videotext[0][1]) {
            return patch_dimensions (mine_gallery ($gallerytext[1][0]), $width, $height);
        } else {
            return patch_dimensions ($videotext[0][0], $width, $height);
        }
    } else if ($gallerymatch && $imagematch) {
        if ($gallerytext[0][1] < $imagetext[0][1]) {
            return patch_dimensions (mine_gallery ($gallerytext[1][0]), $width, $height);
        } else {
            return preg_replace ("/ class=\"[^\"]*\"/", "", patch_dimensions ($imagetext[0][0], $width, $height));
        }
    } else if ($videomatch && $imagematch) {
        if ($videotext[0][1] < $imagetext[0][1]) {
            return patch_dimensions ($videotext[0][0], $width, $height);
        } else {
            return preg_replace ("/ class=\"[^\"]*\"/", "", patch_dimensions ($imagetext[0][0], $width, $height));
        }
    } else if ($gallerymatch) {
        return patch_dimensions (mine_gallery ($gallerytext[1][0]), $width, $height);
    } else if ($videomatch) {
        return patch_dimensions ($videotext[0][0], $width, $height);
    } else if ($imagematch) {
        return preg_replace ("/ class=\"[^\"]*\"/", "", patch_dimensions ($imagetext[0][0], $width, $height));
    } else {
        return null;
    }
}
?>
