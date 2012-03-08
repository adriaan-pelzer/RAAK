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
                <hr />
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
                <hr class="solid" />
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
            $other_posts_query = new WP_Query(array('cat'=> get_cat_ID($cat), 'posts_per_page'=> 5, 'paged'=> 1));
                while($other_posts_query->have_posts()) {
                    $other_posts_query->the_post();
?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
                }
?>
            </ul>
            <footer>
                <a class="more_link" href="<?php echo get_category_link(get_cat_id($cat)); ?>" rel="nofollow">More ▼</a>
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
            $other_posts_query = new WP_Query(array('cat'=> get_cat_ID($cat), 'posts_per_page'=> 3, 'paged'=> 1));
                while($other_posts_query->have_posts()) {
            $other_posts_query->the_post();
?>
                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php
                }
?>
            </ul>
            <footer>
                <a class="more_link" href="<?php echo get_category_link(get_cat_ID($cat)); ?>" rel="nofollow">More ▼</a>
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
        <hr class="solid" />
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
<aside class="bluebox bluebox_primary about_bluebox box rounded-corners">
    <header>
        <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps">What we do</h3>
    </header>
    <hr class="blue_hr">
    <div id="bluebox_content_what-we-do" class="bluebox_content_item bluebox_container current">
        If advertising is a tax on mediocrity, you've come to a tax free zone.
    </div><!-- bluebox_content_item -->
    <div id="bluebox_content_who-we-are" class="bluebox_container founder_quotes">
<?php
    $who_we_are = get_page_by_title('Who we are');
    global $post;
    $founder = 0;
    $who_we_are_pages = new WP_Query('post_parent=' . $who_we_are->ID . '&post_type=page&meta_key=excerpt&order=ASC');
        while ($who_we_are_pages->have_posts()) {
            $who_we_are_pages->the_post();
?>
        <div id="bluebox_content_<?php echo $post->post_name; ?>" class="bluebox_content_item<?php echo ($founder == 0) ? ' current' : ''; ?>">
<?php
            echo get_post_meta(get_the_ID(), 'excerpt', TRUE);
?> 
        </div><!-- bluebox_content_item -->
<?php
            $founder++;

        }
    wp_reset_query();
?>
    </div>
</aside>
<?php
}

add_shortcode('quotes', 'founder_quotes');

/*************************/

function whitebox_logo_project() {
    $logo_project = get_page_by_title('Logo Project');
?>

<div class="whitebox whitebox_primary logo_project_whitebox_primary whitebox-primary box rounded-corners">
    <header>
        <h2 class="din-schrift blue_20">Logo Project</h2>
    </header>
    <hr />
<?php
    echo $logo_project->post_content;
?>
</div><!-- whitebox_primary -->
<?php
}
add_shortcode('wblp', 'whitebox_logo_project');

/*************************/

function logo_project_latest_uploads() {

?>
<div class="bluebox logo_project_bluebox_primary bluebox_primary box rounded-corners">
                <header>
                    <h2 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps">Latest Uploads</h2>
                </header>
                <hr>
                <div class="smaller_arial_caps logo_project_bluebox_nav">
                    <span class="logo_project_bluebox_nav_item">
                        <span id="expand_R" class="logo_project_bluebox_nav_item_left"><a>R</a></span>
                        <span class="seperator">|</span>
                        <span class="logo_project_bluebox_nav_item_right"><a href="http://stage.wewillraakyou.com/logo-project-2/logo-archive/">View All</a></span>
                    </span>
                    <span class="logo_project_bluebox_nav_item">
                        <span id="expand_A" class="logo_project_bluebox_nav_item_left"><a>A</a></span>
                        <span class="seperator">|</span>
                        <span class="logo_project_bluebox_nav_item_right"><a href="http://wewillraakyou.com/logo-project//logo-archive/?letter=A">View All</a></span>
                    </span>
                    <span class="logo_project_bluebox_nav_item">
                        <span id="expand_K" class="logo_project_bluebox_nav_item_left"><a>K</a></span>
                        <span class="seperator">|</span>
                        <span class="logo_project_bluebox_nav_item_right"><a href="http://wewillraakyou.com/logo-project//logo-archive/?letter=K">View All</a></span>
                    </span>
                </div>
                <hr class="solid blue_hr">
                <div id="bluebox_content_R" class="bluebox_content smaller_arial_caps">
                    <div class="bluebox_content_top">
                        <div class="bluebox_content_top_left logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/3326823e578cbe72c52ca50e5b338494.jpg&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                <a href="http://www.steve-baker.co.uk">Steve Baker</a>                                </div>
                        </div><!-- bluebox_content_top_left -->
                        <div class="bluebox_content_top_center logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/a8b2a4f4c69564aa9f11381c0c260235.jpg&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                PSED                                </div>
                        </div><!-- bluebox_content_top_center -->
                        <div class="bluebox_content_top_right logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/2dcfb0448f8b53e4a913a16c8f3413f2.jpg&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                PSED                                </div>
                        </div><!-- bluebox_content_top_right -->
                    </div><!-- bluebox_content_top -->
                    <div class="bluebox_content_bottom">
                        <div class="bluebox_content_bottom_left logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/7832f12fb6b6af543b029481f0b7baa4.png&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                <a href="http://serdarozyigit.com">Serdar Ozyigit</a>                                </div>
                        </div><!-- bluebox_content_bottom_left -->
                        <div class="bluebox_content_bottom_center logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/5196b17d8503c6ad7a7accfefbdeda83.jpg&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                <a href="http://www.prostress.com">Han Hoogerbrugge</a>                                </div>
                        </div><!-- bluebox_content_bottom_center -->
                        <div class="bluebox_content_bottom_right logo_project_letter">
                            <div class="logo_project_letter_image rounded-corners">
                                <img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/a5605d2e128aaa3779904d517d211942.png&amp;width=70&amp;height=82">
                            </div>
                            <div class="logo_project_letter_blurp">
                                Submitted by
                            </div>
                            <div class="logo_project_letter_name">
                                <a href="http://www.cowafrica.co.za">Steyn</a>                                </div>
                        </div><!-- bluebox_content_bottom_right -->
                    </div><!-- bluebox_content_bottom -->
                </div><!-- bluebox_content -->
            </div>
<?php


}

add_shortcode('lplu', 'logo_project_latest_uploads');

/*************************/

function contact_whitebox() {
?>
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners">
<?php
    if (have_posts()) {
        while(have_posts()) {
            the_post();
?>
                <header>
                    <h2 class="din-schrift blue_20"><?php the_title(); ?></h2>
                </header>
                <hr>
                <div class="whitebox_primary_content">
<?php the_content(); ?>
                </div><!-- .whitebox_primary_content -->
            </div>

<?php
        }
    }
}

add_shortcode('contactwb', 'contact_whitebox');


/*************************/

function contact_bluebox() {
    $contact_page = get_page_by_title('Contact');

?>
<div class="bluebox bluebox_primary box rounded-corners">
    <header>
        <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps" id="bluebox_title">Where we are</h3>
    </header>
    <hr />
    <div id="bluebox_map">
        <a target="_blank" href="http://maps.google.com/maps?hl=en&q=<?php echo get_post_meta ($contact_page->ID, 'latitude', true); ?>,<?php echo get_post_meta ($contact_page->ID, 'longitude', true); ?>&ie=UTF8&z=14"><img alt="map to RAAK" id="gimg" src="<?php echo get_bloginfo ('template_directory'); ?>/images/map.png" /></a>
    </div>
</div>
<?php
}

add_shortcode('contactbb', 'contact_bluebox');


/*************************/

function big_whitebox_products() {
    $current_page = get_page_by_title('Our Products');
    $current_page_posts_loop = new WP_Query(array('category_name' => 'RAAK Products', 'posts_per_page' => -1));

    $total_rows = (ceil($current_page_posts_loop->post_count / 3));
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
    <h2 class="din-schrift blue_20"><?php echo $current_page->post_title; ?></h2>
        <nav class="box_nav smaller_arial_caps">
            <a id="whitebox_big_nav_all-products" class="whitebox_big_nav_item active">All Products</a>
        </nav>
    </header>
    <hr />
    <div class="whitebox_big_all_items">
                    <!-- hr class="solid" -->
<?php
    $item_count = 0;
?>
                    <div id="whitebox_big_all-products" class="whitebox_big_category smaller_arial_caps current">
<?php
    for($row_count = 0; $row_count < (($total_rows > 3) ? $total_rows : 3); $row_count++) {
?>
                        <div id="whitebox_big_category_row<?php echo $row_count; ?>" class="whitebox_big_category_row">
<?php
        for($row_item = 0; $row_item < 3; $row_item++) {
            if ($current_page_posts_loop->posts[$item_count]) {
?>
                            <div class="whitebox_big_category_entry" id="category_entry_<?echo $item_count; ?>">
                                <header>
                                    <h3 class="whitebox_big_category_entry_title">
                                    <span class="whitebox_big_category_entry_title_label">product:</span>
                                        <span class="whitebox_big_category_entry_title_name"><?php echo get_post_meta($current_page_posts_loop->posts[$item_count]->ID, 'Product', TRUE); ?></span>
                                    </h3><!-- .whitebox_big_category_entry_title -->
                                </header>
                                <hr class="solid">
                                <a class="whitebox_big_category_entry_content" href="<?php echo get_permalink($current_page_posts_loop->posts[$item_count]->ID); ?>">
                                    <div id="post_all-products_<?php echo $item_count; ?>_picture" class="whitebox_big_category_entry_content_picture current">
                                        <?php echo get_image ($current_page_posts_loop->posts[$item_count]->post_content, 220, 142); ?>
                                    </div><!-- post_all-products_<?php echo $item_count; ?>_picture -->
                                    <div id="post_all-products_<?php echo $item_count; ?>_overview" class="whitebox_big_category_entry_content_overview">
                                        <p><?php echo get_post_meta($current_page_posts_loop->posts[$item_count]->ID, 'Overview', TRUE); ?></p>
                                    </div><!-- #post_<?php echo $item_count; ?>_overview -->
                                </a>
                            </div><!-- .whitebox_big_category_entry -->
<?php
            } else {
?>
                            <div class="whitebox_big_category_entry">
                            </div><!-- .whitebox_big_category_entry -->
<?php
            }
            $item_count++;
        }
?>
                        </div><!-- #whitebox_big_category_row<?php echo $row_count; ?> -->
<?php
    }
?>
                    </div><!-- #whitebox_big_all-products -->
                </div><!-- #whitebox_big_all-items -->
            </div>
<?php
    wp_reset_query();
}

add_shortcode('bwb_prod', 'big_whitebox_products');


/*************************/

function big_whitebox_projects() {
    $current_page = get_page_by_title('Our Work');
    if($_GET['category']) {
        $active = $_GET['category'];
    }

?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
    <h2 class="din-schrift blue_20"><?php echo $current_page->post_title; ?></h2>
<?php
        $work_categories = get_categories (array ('child_of'=>get_cat_id ('RAAK projects'), 'orderby'=>'slug', 'order'=>'desc'));

?>
        <nav class="box_nav smaller_arial_caps">
        <a id="whitebox_big_nav_all-projects" class="whitebox_big_nav_item <?php echo ($active == 'all-projects') ? 'active' : ''; ?>">All Projects</a>
<?php 
    $children_cats = '';
        foreach ($work_categories as $work_category) {
?>
            <span class="seperator seperator_smaller">|</span>
            <a id="whitebox_big_nav_<?php echo $work_category->category_nicename; ?>" class="whitebox_big_nav_item <?php echo ($active == $work_category->category_nicename) ? 'active' : ''; ?>"><?php echo $work_category->name; ?></a>
<?php
            $current_cat_loop = new WP_Query(array('category_name' => ($work_category->name), 'posts_per_page' => -1));
            $total_rows = (ceil($all_projects_loop->post_count / 3));
            $children_cats_item_count = 0;
            $children_cats .= '<div id="whitebox_big_' . $work_category->category_nicename . '" class="whitebox_big_category smaller_arial_caps'. (($active == $work_category->category_nicename) ? ' current' : '') . '">';
            for($row_count = 0; $row_count < (($total_rows > 3) ? $total_rows : 3); $row_count++) {
                $children_cats .= '<div id="whitebox_big_category_row' . $row_count . '" class="whitebox_big_category_row">';
                for($row_item = 0; $row_item < 3; $row_item++) {
                    if ($current_cat_loop->posts[$children_cats_item_count]) {
                        $children_cats .= '<div class="whitebox_big_category_entry" id="category_entry_' .$children_cats_item_count . '">
                                <header>
                                    <h3 class="whitebox_big_category_entry_title">
                                    <span class="whitebox_big_category_entry_title_label">client:</span>
                                        <span class="whitebox_big_category_entry_title_name">' . get_post_meta($current_cat_loop->posts[$children_cats_item_count]->ID, 'Client', TRUE) . '</span>
                                    </h3><!-- .whitebox_big_category_entry_title -->
                                </header>
                                <hr class="solid">
                                <a class="whitebox_big_category_entry_content" href="' . get_permalink($current_cat_loop->posts[$children_cats_item_count]->ID) . '">
                                    <div id="post_all-products_' . $children_cats_item_count . '_picture" class="whitebox_big_category_entry_content_picture current">';
                        $children_cats .= get_image ($current_cat_loop->posts[$children_cats_item_count]->post_content, 220, 142);
                        $children_cats .= '</div><!-- post_all-products_' . $children_cats_item_count . '_picture -->
                                    <div id="post_all-products_' . $children_cats_item_count . '_overview" class="whitebox_big_category_entry_content_overview">
                                        <p>' . get_post_meta($current_cat_loop->posts[$children_cats_item_count]->ID, 'Overview', TRUE) . '</p>
                                    </div><!-- #post_' . $children_cats_item_count . '_overview -->
                                </a>
                                </div><!-- .whitebox_big_category_entry -->
                                ';
                    } else {
                        $children_cats .= '<div class="whitebox_big_category_entry">
                            </div><!-- .whitebox_big_category_entry -->
                            ';
                    }
                    $children_cats_item_count++;
                }
                $children_cats .= '</div><!-- #whitebox_big_category_row' . $row_count . ' -->';
            }
            $children_cats .= '</div><!-- whitebox_big_' . $work_category->category_nicename . ' -->';
            wp_reset_query();
        }
?>
        </nav>
    </header>
    <hr />
    <div class="whitebox_big_all_items">
                    <!-- hr class="solid" -->
<?php
    $all_projects_loop = new WP_Query(array('category_name' => 'RAAK Projects', 'posts_per_page' => -1));

    $total_rows = (ceil($all_projects_loop->post_count / 3));
    $item_count = 0;
?>
                    <div id="whitebox_big_all-projects" class="whitebox_big_category smaller_arial_caps<?php echo ($active == 'all-projects') ? ' current' : ''; ?>">
<?php
    for($row_count = 0; $row_count < (($total_rows > 3) ? $total_rows : 3); $row_count++) {
?>
                        <div id="whitebox_big_category_row<?php echo $row_count; ?>" class="whitebox_big_category_row">
<?php
        for($row_item = 0; $row_item < 3; $row_item++) {
            if ($all_projects_loop->posts[$item_count]) {
?>
                            <div class="whitebox_big_category_entry" id="category_entry_<?echo $item_count; ?>">
                                <header>
                                    <h3 class="whitebox_big_category_entry_title">
                                    <span class="whitebox_big_category_entry_title_label">client:</span>
                                        <span class="whitebox_big_category_entry_title_name"><?php echo get_post_meta($all_projects_loop->posts[$item_count]->ID, 'Client', TRUE); ?></span>
                                    </h3><!-- .whitebox_big_category_entry_title -->
                                </header>
                                <hr class="solid">
                                <a class="whitebox_big_category_entry_content" href="<?php echo get_permalink($all_projects_loop->posts[$item_count]->ID); ?>">
                                    <div id="post_all-products_<?php echo $item_count; ?>_picture" class="whitebox_big_category_entry_content_picture current">
                                        <?php echo get_image ($all_projects_loop->posts[$item_count]->post_content, 220, 142); ?>
                                    </div><!-- post_all-products_<?php echo $item_count; ?>_picture -->
                                    <div id="post_all-products_<?php echo $item_count; ?>_overview" class="whitebox_big_category_entry_content_overview">
                                        <p><?php echo get_post_meta($all_projects_loop->posts[$item_count]->ID, 'Overview', TRUE); ?></p>
                                    </div><!-- #post_<?php echo $item_count; ?>_overview -->
                                </a>
                            </div><!-- .whitebox_big_category_entry -->
<?php
            } else {
?>
                            <div class="whitebox_big_category_entry">
                            </div><!-- .whitebox_big_category_entry -->
<?php
            }
            $item_count++;
        }
?>
                        </div><!-- #whitebox_big_category_row<?php echo $row_count; ?> -->
<?php
    }
?>
                    </div><!-- #whitebox_big_all-products -->
<?php echo $children_cats; ?>
                </div><!-- #whitebox_big_all-items -->
            </div>
<?php
    wp_reset_query();
}

add_shortcode('bwb_proj', 'big_whitebox_projects');

/*************************/

function single_project_whitebox() {
    if (have_posts()) {
        while(have_posts()) {
            the_post();
            $poss_cats = array();
            $cats = get_the_category();
            $num_cats = count($cats);
            for($count = 0; $count < $num_cats; $count++) {
                $poss_cats[$count] = $cats[$count]->cat_name;
            }
            if (in_array('RAAK products', $poss_cats)) {
                $page_title = 'Our Products';
            } else {
                $page_title = 'Our Work';
            }

            
?>

<div class="whitebox_big whitebox box big_box big_box_short rounded-corners_top_bottom_right">
    <header>
        <h2 class="din-schrift blue_20"><?php echo $page_title; ?></h2>
<?php 
            if ($page_title == 'Our Work') {
                $our_work = get_page_by_title('Our Work');
                $work_categories = get_categories (array ('child_of'=>get_cat_id ('RAAK projects'), 'orderby'=>'slug', 'order'=>'desc'));

?>
        <nav class="box_nav smaller_arial_caps">
        <a href="<?php echo get_permalink($our_work->ID); ?>?category=all-projects" id="whitebox_big_nav_all-projects" class="whitebox_big_nav_item">All Projects</a>
<?php 
                foreach ($work_categories as $work_category) {
?>
            <span class="seperator seperator_smaller">|</span>
            <a href="<?php echo get_permalink($our_work->ID); ?>?category=<?php echo $work_category->category_nicename; ?>" id="whitebox_big_nav_<?php echo $work_category->category_nicename; ?>" class="whitebox_big_nav_item"><?php echo $work_category->name; ?></a>
<?php
                }
            }
?>
        </nav>
    </header>
        <hr />
</div><!-- whitebox_big -->
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners_bottom">
    <div class="product_whitebox_primary_project whitebox_primary_section bigger_arial_caps">
<?php
            if ($page_title == 'Our Products') 
            {
?>
        <div class="whitebox_primary_section_label">Product:</div>
        <div class="whitebox_primary_section_content"><a class="grey_text" target="_blank" href="<?php echo get_post_meta(get_the_ID(), 'link', TRUE); ?>"><?php echo get_post_meta(get_the_ID(), 'Product', TRUE); ?></a></div>
    </div><!-- whitebox_primary_section -->
    <hr class="solid thicker_hr lightblue_hr" />
    <div class="whitebox_primary_solution whitebox_primary_section">
        <div class="whitebox_primary_section_label bigger_arial_caps">Descript:</div>
        <div class="whitebox_primary_section_content"><?php echo get_post_meta(get_the_ID(), 'Descript', TRUE); ?></div><!-- .whitebox_primary_section_content -->
    </div><!-- .whitebox_primary_section -->
<?php
            } else {
?>
        <div class="whitebox_primary_section_label">Client:</div>
        <div class="whitebox_primary_section_content grey_text"><?php echo get_post_meta(get_the_ID(), 'Client', TRUE); ?></div>
    </div><!-- .whitebox_primary_section -->
    <hr class="solid thicker_hr lightblue_hr" />
    <div class="whitebox_primary_project whitebox_primary_section bigger_arial_caps">
        <div class="whitebox_primary_section_label">Project:</div>
        <div class="whitebox_primary_section_content grey_text"><?php echo get_post_meta(get_the_ID(), 'Project', TRUE); ?></div>
    </div><!-- .whitebox_primary_section -->
    <hr class="solid thicker_hr lightblue_hr" />
    <div class="whitebox_primary_brief whitebox_primary_section">
        <div class="whitebox_primary_section_label bigger_arial_caps">Brief:</div>
        <div class="whitebox_primary_section_content"><?php echo get_post_meta(get_the_ID(), 'Brief', TRUE); ?></div>
    </div><!-- .whitebox_primary_section -->
    <hr class="solid thicker_hr lightblue_hr" />
    <div class="whitebox_primary_solution whitebox_primary_section">
        <div class="whitebox_primary_section_label bigger_arial_caps">Solution:</div>
        <div class="whitebox_primary_section_content"><?php echo get_post_meta(get_the_ID(), 'Solution', TRUE); ?></div>
    </div><!-- .whitebox_primary_section -->
<?php
            }
?>
</div><!-- whitebox_primary -->
<?php
        }
    }
}

add_shortcode('sp_wb', 'single_project_whitebox');

/*************************/

function single_project_bluebox() {
?>
<div class="bluebox bluebox_primary box bluebox-primary rounded-corners bluebox_top_margin">
    <div class="bluebox_bigpic">
    </div>
    <hr class="solid blue_hr" />
    <div class="bluebox_thumbpic">
<?php the_content(); ?>
    </div>
</div><!-- #bluebox -->
<?php
}

add_shortcode('sp_bb', 'single_project_bluebox');

/*************************/

function search_box() {
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
        <form class="whitebox_big_search smaller_arial_caps" method="get" action="http://www.google.com/search">
            <input class="submit_button" type="submit" value="Search" />
            <input type="text" id="searchtext" name="q" maxlength="255" value="" />
            <input type="hidden"  name="sitesearch" value="wewillraakyou.com" />
        </form>
        <!-- span class="whitebox_big_search smaller_arial_caps"><a onclick="javascript: google_search();">Search</a><input type="text" id="searchtext"></span -->
        <h2 class="din-schrift blue_20">Our Blog</h2>
    </header>
</div>

<?php
}

add_shortcode('sb', 'search_box');
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


function get_image ($post_content, $width=NULL, $height=NULL) {
    $returncode = NULL;
    $gallerytext = array();
    $matches_img = array();
    $matches_gal = array();

    if (preg_match ("/<img[^>]+>/", $post_content, $matches_img, PREG_OFFSET_CAPTURE)) {
        if (preg_match ("/\[nggallery id=(\d+)\]/", $post_content, $matches_gal, PREG_OFFSET_CAPTURE) && ($matches_gal[0][1] < $matches_img[0][1])) {
            return patch_dimensions (mine_gallery ($matches_gal[1][0]), $width, $height);
        } else {
            $returncode = $matches_img[0][0];

            $returncode = patch_dimensions ($returncode, $width, $height);

            $returncode = preg_replace ("/ class=\"[^\"]*\"/", "", $returncode);
        }
    } else if (preg_match ("/\[nggallery id=(\d+)\]/", $post_content, $matches_gal, PREG_OFFSET_CAPTURE)) {
        return patch_dimensions (mine_gallery ($matches_gal[1][0]), $width, $height);
    }

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
