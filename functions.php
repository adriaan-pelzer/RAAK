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
        if ((($page - 1) % 2) == 0) {
?>
            <div id="whitebox_primary_post_<?php echo $page; ?>" class="whitebox_primary_post<?php if ($page == 1) { echo " current"; } ?>">
<?php
        }
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
                    <span class="whitebox_primary_post_attr_item author">Posted by <a href="<?php echo get_permalink($author_page->ID);  ?>"><?php the_author_meta('first_name'); ?> <?php the_author_meta('last_name'); ?></a></span>
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
        if ((($page - 1) % 2) == 1) {
?>
            </div><!-- whitebox_primary_post -->
<?php
        }
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
    foreach($atts as $cat) {
        echo $cat;
    }
    $must_reads_cat_id = get_cat_id('Must Read');
    echo $must_reads_cat_id;
?>

<div class="tab_container whitebox-secondary other_posts">
                <div class="grey_tab tab tab104 rounded-corners">
                    <header>
                        <h2>Other Posts</h2>
                    </header>
                </div><!-- .grey_tab -->
                <div class="whitebox_secondary whitebox box rounded-corners">
                    <section class="other_posts_content_one">
                        <header>
                            <h3 class="small_arial_caps">Must Reads</h3>
                        </header>
                        <ul>
<?php
    $must_reads = new WP_Query(array('cat'=> $must_reads_cat_id, 'posts_per_page'=> 5, 'paged'=> 1));
 while ($must_reads->have_posts()) {
            $must_reads->the_post();
?>
                            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
    }
?>
                        </ul>
                        <footer>
                            <a class="more_link" href="<?php get_category_link($must_reads_cat_id); ?>" rel="nofollow">More ▼</a>
                        </footer>
                    </section><!-- _content_one -->
                    <section class="other_posts_content_two">
                        <header>
                            <h3 class="small_arial_caps">Worth a Look</h3>
                        </header>
                        <ul>
                            <li><a href="http://wewillraakyou.com/2011/09/identity-and-location-and-sex-welcome-to-people-discovery/">Identity and location (and sex) - welcome to people discovery </a></li>
                            <li><a href="http://wewillraakyou.com/2011/08/measure-fake-follower-twitter/">Is Newt Gingrich a cheat?</a></li>
                            <li><a href="http://wewillraakyou.com/2011/05/curating-your-own-serendipity-filters/">Curating your own serendipity filters</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/category/worth-a-look/" rel="nofollow">More ▼</a>
                        </footer>
                    </section><!-- content_two -->
                    <section class="other_posts_content_three">
                        <header>
                            <h3 class="small_arial_caps">The RAAKonteur</h3>
                        </header>
                        <ul>
                            <li><a href="http://wewillraakyou.com/2011/12/the-raakonteur-66-the-spotify-platform-how-people-look-at-your-facebook-profile-wordpress-ads-and-more/">The RAAKonteur #66 - Spotify Platform, How people look at your Facebook profile, Wordpress Ads and more</a></li>
                            <li><a href="http://wewillraakyou.com/2011/11/the-raakonteur-65-kevin-roses-new-project-the-facebook-freakyline-and-more/">The RAAKonteur #65 - Kevin Rose's new project, The Facebook Freakyline and more</a></li>
                            <li><a href="http://wewillraakyou.com/2011/11/the-raakonteur-64-twitter-now-a-serious-business-and-why-like-is-actually-want/">The RAAKonteur #64 - Twitter now a serious business and why 'Like' is actually 'Want'</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/blog/the-raakonteur/" rel="nofollow">More ▼</a>
                        </footer>
                    </section><!-- content_three -->
                </div><!-- #whitebox_secondary -->
            </div>
<?php
wp_reset_query();
}
add_shortcode('other_posts', 'display_other_posts');
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
