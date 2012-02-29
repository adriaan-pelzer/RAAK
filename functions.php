<?php

/*******************************/

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

/*******************************/

function display_latest_posts($atts) {
    extract(shortcode_atts(array('category' => '0', 'posts_per_page' => '2', 'num_pages' => '10'), $atts));
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
    for($page = 1; $page <= $num_pages; $page++) {
?>
            <div id="whitebox_primary_post_<?php echo $page; ?>" class="whitebox_primary_post<?php if ($page == 1) { echo " current"; } ?>">
<?php
        $latest_posts_loop = new WP_Query(array('cat' => get_cat_id($category), 'posts_per_page' => $posts_per_page, 'paged' => $page));
        while ($latest_posts_loop->have_posts()) {
            $latest_posts_loop->the_post();
            $author_full_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
            $author_page = get_page_by_title($author_full_name);
?>
                <article>
                    <header>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </header>
                    <hr>
                    <div class="whitebox_primary_post_attr">
                    <span class="whitebox_primary_post_attr_item author">Posted by <a href="<?php echo get_permalink($author_page->ID);  ?>"><?php echo $author_full_name; ?></a></span>
                        <span class="seperator">|</span>
                        <span class="whitebox_primary_post_attr_item date"><?php the_date(); ?></span>
                        <span class="seperator">|</span>
                        <span class="whitebox_primary_post_attr_item comments"><img alt="comment icon" class="commenticon" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/whitebox_primary_body_attr_comment_icon.png"><?php comments_number(); ?></span>
                    </div><!-- .whitebox_primary_post_attr -->
                    <div class="whitebox_primary_post_content">
                        <div class="whitebox_primary_post_content_right">
                                    <a href="<?php echo get_permalink (get_the_ID()); ?>"><?php echo get_image_or_video (get_the_content(), 162, 104); ?></a>
                            <a class="more_link" href="<?php echo get_permalink(get_the_ID()); ?>">More ►</a>
                        </div><!-- .whitebox_primary_post_content_right -->
                            <?php the_excerpt(); ?>
                    </div><!-- .whitebox_primary_post_content -->
                    <hr class="solid">
                </article>
<?php
        }
?>
            </div><!-- whitebox_primary_post -->
<?php
        wp_reset_query();
    
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

/*******************************/

function our_work()
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
    </div><!-- bluebox_home_left -->
    <div id="bluebox_home_right" class="bluebox bluebox_primary_no_margin box rounded-corners">
        <nav class="bluebox_nav box_nav our_work_nav">
<?php
    foreach($work_categories as $cat_number => $work_category)
    {
?>
            <?php if($cat_number != 0){?><span class="seperator">|</span><?php } ?>
            <h3 class="bluebox_nav_item small_arial_caps"><a class="<?php echo $work_category->category_nicename . ' '; if($cat_number == 0){?>active<?php } ?>"><?php echo $work_category->name; ?></a></h3>
<?php
        $current_our_work_post_cat = get_cat_id ($work_category->name);
        $current_our_work_query = new WP_Query('cat=' . get_cat_id($work_category->name) .'&posts_per_page=1$paged=1');
        $current_our_work_post = $current_our_work_query->post;
        $current_our_work_post_id = ($current_our_work_post->ID);
        $our_work_bluebox_content .= '<section class="bluebox_content our_work_bluebox_content';
        if($cat_number == 0){
            $our_work_bluebox_content .= ' current';
        }
        $our_work_bluebox_content .= '" id="' . $work_category->category_nicename . '">';
        $our_work_bluebox_content .= '<a href="' . get_permalink($current_our_work_post_id) . '">';
        $our_work_bluebox_content .= get_image_or_video ($current_our_work_post->post_content, 315) . '</a>';
        $our_work_bluebox_content .= '<ul><li class="bluebox_content_sub"><span class="label">Client:</span><span class="title">' . get_post_meta ($current_our_work_post_id, 'Client', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_sub"><span class="label">Project:</span><span class="title">' . get_post_meta ($current_our_work_post_id, 'Project', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_sub"><span class="label">Overview:</span><span class="overview">' . get_post_meta ($current_our_work_post_id, 'Overview', true) . '</span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_link"><a href="' . get_category_link($current_our_work_post_cat) . '" rel="nofollow">More Projects &#9660;</a></li></ul></section>';
        wp_reset_query();
    }
?>
        </nav>
<?php
    echo $our_work_bluebox_content;
?>
    
    </div><!-- bluebox_home_right -->

<?php
}

add_shortcode('our_work', 'our_work');

/*******************************/

function display_other_posts($atts) {
    extract(shortcode_atts(array('category1' => '', 'category2' => '', 'category3' => ''), $atts));
?>
<div class="tab_container whitebox-secondary other_posts">
                <div class="grey_tab tab tab104 rounded-corners">
                    <header>
                        <h2>Other Posts</h2>
                    </header>
                </div><!-- .grey_tab -->
                <div class="whitebox_secondary whitebox box rounded-corners">
<?php
    foreach($atts as $cat_num => $cat) {
        if($cat_num == 'category1') {
?>
                    <section class="other_posts_content_one">
                        <header>
                        <h3 class="small_arial_caps"><?php echo $category1; ?></h3>
                        </header>
                        <ul>
<?php
            $other_posts_query = new WP_Query(array('cat'=> get_cat_id($cat), 'posts_per_page'=> 5, 'paged'=> 1));
                while($other_posts_query->have_posts()) {
                    $other_posts_query->the_post();
?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
                }
?>
                        </ul>
                        <footer>
                            <a class="more_link" href="<?php get_category_link(get_cat_id($cat)); ?>" rel="nofollow">More ▼</a>
                        </footer>
                    </section><!-- other_posts_content_one -->
<?php
            wp_reset_query();
        } else {
?>
                    <section class="other_posts_content_<?php echo ($cat_num == 'category2') ? 'two' : 'three'; ?>">
                        <header>
                            <h3 class="small_arial_caps"><?php echo ($cat_num == 'category2') ? $category2 : $category3; ?></h3>
                        </header>
                        <ul>
<?php
            $other_posts_query = new WP_Query(array('cat'=> get_cat_id($cat), 'posts_per_page'=> 3, 'paged'=> 1));
                while($other_posts_query->have_posts()) {
            $other_posts_query->the_post();
?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
                }
?>
                        </ul>
                        <footer>
                            <a class="more_link" href="<?php get_category_link(get_cat_id($cat)); ?>" rel="nofollow">More ▼</a>
                        </footer>
                    </section><!-- other_posts_content_<?php echo ($cat_num == 'category2') ? 'two' : 'three'; ?> -->
<?php
            wp_reset_query();
        }
    }
?>
                </div><!-- #whitebox_secondary -->
            </div>
<?php
}
add_shortcode('other_posts', 'display_other_posts');

/*******************************/

function who_we_are_what_we_do() {
    global $post;
    $what_we_do = get_page_by_title('What we do');
    $who_we_are = get_page_by_title('Who we are');
    $who_we_are_content = '';
?>
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners">
                <header>
                    <nav class="whitebox_primary_nav smaller_arial_caps about_nav box_nav">
                        <a class="active">What we do</a><span class="seperator seperator_smaller">|</span><a>Who we are</a>
                    </nav><!-- whitebox_primary_nav -->
                    <h2 class="din-schrift blue_20">About</h2>
                </header>
                <hr>
                <div id="what-we-do" class="whitebox_primary_content about_content current">
<?php echo $what_we_do->post_content; ?>
                </div><!-- whitebox_primary_content -->
                <div id="who-we-are" class="whitebox_primary_content about_content">
                    <nav class="whitebox_primary_content_nav smaller_arial_caps box_nav">
<?php
    $founder = 0;
    $who_we_are_query = new WP_Query('post_parent=' . $who_we_are->ID . '&post_type=page&order=ASC');
    while($who_we_are_query->have_posts()) {
        $who_we_are_query->the_post();
?>

                        <?php echo ($founder != 0) ? '<span class="seperator seperator_smaller">|</span>' : ''; ?><a id="whitebox_primary_content_nav_<?php echo $post->post_name; ?>" class="whitebox_primary_content_nav_item <?php echo ($founder == 0) ? 'active' : ''; ?>" ><?php the_title(); ?></a>
<?php
        $who_we_are_content .= '<section id="whitebox_primary_content_' . $post->post_name . '" class="whitebox_primary_content_founder'; 
        if($founder == 0) {
            $who_we_are_content .= ' current';
        }
        $who_we_are_content .= '"><div class="whitebox_primary_content_founder_info smaller_arial_caps box_nav">
                            <div class="whitebox_primary_content_founder_name">' . $post->post_title . '</div>
                            <div class="whitebox_primary_content_founder_social">
                                <div class="whitebox_primary_content_founder_social_title">Follow me…</div>
                                <div class="whitebox_primary_content_founder_social_right">'; 
        if (get_post_meta($post->ID, 'linkedin', TRUE)) {
            $who_we_are_content .= '<div class="whitebox_primary_content_founder_social_network social_linkedin">
                                        <span class="whitebox_primary_content_founder_social_linkedin_icon"><a href="http://' . get_post_meta($post->ID, 'linkedin', TRUE) . '"><img src="' . get_bloginfo("template_url") . '/images/linked_in_icon.png" alt="LinkedIn"></a></span>
                                        <span class="whitebox_primary_content_founder_social_linkedin_text"><a href="http://' . get_post_meta($post->ID, 'linkedin', TRUE) . '">Linked In</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_linkedin -->';
        }
        if (get_post_meta($post->ID, 'facebook', TRUE)){
            $who_we_are_content .= '<div class="whitebox_primary_content_founder_social_network social_facebook">
                                        <span class="whitebox_primary_content_founder_social_facebook_icon"><a href="http://' . get_post_meta($post->ID, 'facebook', TRUE) . '"><img src="' . get_bloginfo("template_url") . '/images/facebook_icon.png" alt="Facebook"></a></span>
                                        <span class="whitebox_primary_content_founder_social_facebook_text"><a href="http://' . get_post_meta($post->ID, 'facebook', TRUE) . '">Facebook</a></span>
                                        </div><!-- whitebox_primary_content_founder_social_facebook -->';
        }
        if (get_post_meta($post->ID, 'twitter', TRUE)) {
            $who_we_are_content .= '<div class="whitebox_primary_content_founder_social_network social_twitter">
                                        <span class="whitebox_primary_content_founder_social_twitter_icon"><a href="http://' . get_post_meta($post->ID, 'twitter', TRUE) . '"><img src="' . get_bloginfo("template_url") . '/images/twitter_icon.png" alt="Twitter"></a></span>
                                        <span class="whitebox_primary_content_founder_social_twitter_text"><a href="http://' . get_post_meta($post->ID, 'twitter', TRUE) . '">Twitter</a></span>
                                        </div><!-- whitebox_primary_content_founder_social_twitter -->';
        }
        $who_we_are_content .= '</div><!-- whitebox_primary_content_founder_social_right -->
                            </div><!-- whitebox_primary_content_founder_social -->
                        </div><!-- whitebox_primary_content_founder_info -->
                        <div class="whitebox_primary_content_founder_picture">';

        $who_we_are_content .= get_image_or_video ($post->post_content, 200);
        $who_we_are_content .= '</div><!-- whitebox_primary_content_founder_picture -->
                        <hr class="solid">
                        <div class="whitebox_primary_content_founder_text">';
        $who_we_are_content .= preg_replace ("/<a[^>]+><img[^>]+><\/a>/", "", $post->post_content);
        $who_we_are_content .= '</div><!-- .whitebox_primary_content_founder_text -->
                        </section><!-- whitebox_primary_content_founder -->';
        $founder++;
    }
?>
                    </nav><!-- whitebox_primary_content_nav -->
                    <hr class="solid">
<?php
    echo $who_we_are_content;
?>
                </div><!-- whitebox_primary_content -->
            </div>

<?php
    wp_reset_query();
}

add_shortcode('who_what', 'who_we_are_what_we_do'); 

/*************************/

function founder_quotes() {
?>
<aside class="bluebox bluebox_primary box rounded-corners">
    <header>
<?php
    $about = get_page_by_title('About');
    $about_pages = new WP_Query('post_parent=' . $about->ID . '&post_type=page');
        while ($about_pages->have_posts() {
            $about_pages->the_post();
?>
        <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps"><?php the_title(); ?></h3>
<?php

        }
?>
                <header>
                    <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps">What we do</h3>
                </header>
                <hr class="blue_hr">
                <div id="bluebox_content_what-we-do" class="bluebox_content_item">
                    If advertising is a tax on mediocrity, you've come to a tax free zone.
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_adriaan" class="bluebox_content_item" style="display: none;">
                    I dream code.<br>I write machine poetry, that makes electrons dance.<br>
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_wessel" class="bluebox_content_item" style="display: none;">
                    I breathe media.<br>I inhale news and exhale content.<br>Marked up, tagged and loaded.
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_gerrie" class="bluebox_content_item" style="display: none;">
                    I'm intrigued by innovation.<br>Not very interested in the status quo.<br>
                </div><!-- bluebox_content_item -->
            </aside>
<?php
}

add_shortcode('quotes', 'founder_quotes');

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
