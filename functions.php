<?php

/***** function for creating logo letter posts and product posts *********/

add_action('init', 'create_post_type');

function create_post_type () {
    register_post_type('raak_logo_letter', array('labels' => array('name' => __('letters'), 'singular' => __('letter')), 'public' => TRUE, 'has_archive' => TRUE, 'rewrite' => array('slug' => 'letters'), supports => array('custom-fields', 'title', 'editor', 'thumbnail')));
    register_post_type('raak_product', array('labels' => array('name' => __('products'), 'singular' => __('product')), 'public' => TRUE, 'has_archive' => TRUE, 'rewrite' => array('slug' => 'raak-products'), supports => array('custom-fields', 'title', 'editor', 'excerpt'), taxonomies => array('category', 'post_tag')));
    register_post_type('raak_project', array('labels' => array('name' => __('projects'), 'singular' => __('project')), 'public' => TRUE, 'has_archive' => TRUE, 'rewrite' => array('slug' => 'raak-projects'), supports => array('custom-fields', 'title', 'editor', 'excerpt'), taxonomies => array('category', 'post_tag')));
}


/**
 * Hooks the WP cpt_post_types filter 
 *
 * @param array $post_types An array of post type names that the templates be used by
 * @return array The array of post type names that the templates be used by
 **/
function my_cpt_post_types($post_types) {
    $post_types[] = 'raak_product';
    $post_types[] = 'raak_project';
    return $post_types;
}
add_filter('cpt_post_types', 'my_cpt_post_types');
/********************* use wp menu *******************/

register_nav_menus( array('primary' => 'Primary Navigation'));

/********** adding support for featured images **********/

add_theme_support('post-thumbnails');
set_post_thumbnail_size(35, 42);
add_image_size('logo-archive', 70, 82);

/*****************************************************/



function logo_call_to_action() {
    $letters = array('r', 'a', 'k');
    foreach($letters as $letter) {
        $current_query = new WP_Query(array('post_type' => 'raak_logo_letter', 'meta_value' => $letter, 'posts_per_page' => -1));
        ${$letter . '_num'} = $current_query->post_count;
        wp_reset_query();
    } 
    $logo_story = get_page_by_title('The perpetually changing crowdsourced RAAK logo', 'OBJECT', 'post');
    $logo_project = get_page_by_title('Logo Project');
?>
<aside id="logox_counter" class="rounded-corners din-schrift">
    <span class="point_left"></span>
    <span class="point_right"></span>
    <header>
        <h2># OF LOGO COMBINATIONS</h2>
    </header>
    <div id="logox_counter_number"><?php echo (max($r_num, 1) * max($a_num, 1) * max($a_num, 1) * max($k_num, 1)); ?></div>
    <a id="read_the_logo_story" href="<?php echo get_permalink($logo_story->ID); ?>">Read the story behind our logo</a>
    <hr>
    <a id="upload_a_letter" href="<?php echo get_permalink($logo_project->ID); ?>">Upload a letter</a>
</aside>
<?php
}

add_shortcode('logo_cta', 'logo_call_to_action');

/*******************************/

function display_latest_posts($atts) {
    extract(shortcode_atts(array('category' => '0', 'posts_per_page' => '2', 'num_pages' => '10', 'tab' => '1'), $atts));
    $blog_archive_page = get_page_by_title('Blog Archive');
    if ($tab == 1) {

?>
<div class="tab_container whitebox-primary">
    <div class="grey_tab tab tab104 rounded-corners">
        <header>
            <h2>Latest Posts</h2>
        </header>
    </div><!-- .grey_tab -->
    <div class="whitebox whitebox_primary box rounded-corners">
<?php
    } else {
?>
    <div class="whitebox_top_margin whitebox-primary whitebox whitebox_primary box rounded-corners">
<?php
    }
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
                    <span class="whitebox_primary_post_attr_item date"><?php the_date('j F Y'); ?></span>
                    <span class="seperator">|</span>
                    <span class="whitebox_primary_post_attr_item comments_count"><img alt="comment icon" class="commenticon" src="<?php echo get_bloginfo('template_url'); ?>/images/whitebox_primary_body_attr_comment_icon.png"><?php comments_number('0 comments', '1 comment', '% comments'); ?></span>
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
<?php
    if ($tab == 1) {
?>
</div><!-- tab_container -->
<?php
    }
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
        $current_our_work_query = new WP_Query(array('cat' => get_cat_id($work_category->name), 'posts_per_page' => 1, 'paged' => 1, 'post_type' => 'raak_project'));
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
        $our_work_bluebox_content .= '<li class="bluebox_content_sub"><span class="label">Overview:</span><span class="overview"><a href="' . get_permalink($current_our_work_post_id) . '">' . get_post_meta ($current_our_work_post_id, 'Overview', true) . '</a></span></li>';
        $our_work_bluebox_content .= '<li class="bluebox_content_link"><a href="' . get_permalink($our_work->ID) . '?category=' . $work_category->category_nicename . '" rel="nofollow">More Projects &#9660;</a></li></ul></section>';
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
    extract(shortcode_atts(array('category1' => '', 'category2' => '', 'category3' => '', 'colourscheme' => 'white'), $atts));
    $cats_array = array();
    foreach($atts as $key => $value) {
        if ((strpos($key, 'category')) !== FALSE) {
        $cats_array[$key] = $value;
        }
    }
    if($colourscheme == 'white') {
        $box_colour = 'white';
        $tab_colour = 'grey';
    } else if($colourscheme == 'blue') {
        $box_colour = 'blue';
        $tab_colour = 'blue';
    }
?>
<div class="tab_container <?php echo ($box_colour == 'white') ? 'whitebox-secondary' : 'bluebox-primary'; ?> other_posts">
    <div class="<?php echo $tab_colour; ?>_tab tab tab104 rounded-corners">
        <header>
            <h2>Other Posts</h2>
        </header>
    </div><!-- .<?php echo $tab_colour; ?>_tab -->
    <div class="<?php echo ($box_colour == 'white') ? 'whitebox_secondary' : 'bluebox_primary blog_bluebox_primary'; ?> <?php echo $box_colour; ?>box box rounded-corners">
<?php
    foreach($cats_array as $cat_num => $cat) {
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
    </div><!-- <?php echo ($box_colour == 'white') ? 'whitebox_secondary' : 'bluebox_primary'; ?> -->
</div><!-- tab_container -->
<?php
}
add_shortcode('other_posts', 'display_other_posts');

/*******************************/

function who_we_are_what_we_do() {
    global $post;
    $current_uri = $_SERVER['REQUEST_URI'];
    $uri_array = explode('/', $current_uri);
    $founders = array('adriaan-pelzer', 'gerrie-smits', 'wessel-van-rensburg');
    $current_page = 'about';
    foreach($founders as $founder) {
        if (in_array($founder, $uri_array)) {
            $current_page = $founder;
        }
    }
    $what_we_do = get_page_by_title('What we do');
    $who_we_are = get_page_by_title('Who we are');
    $who_we_are_content = '';
?>
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners">
    <header>
        <nav class="whitebox_primary_nav smaller_arial_caps about_nav box_nav">
        <a<?php echo ($current_page == 'about') ? ' class="active"' : ''; ?>>What we do</a><span class="seperator seperator_smaller">|</span><a<?php echo ($current_page != 'about') ? ' class="active"' : ''; ?>>Who we are</a>
        </nav><!-- whitebox_primary_nav -->
        <h2 class="din-schrift blue_20">About</h2>
    </header>
    <hr>
    <div id="what-we-do" class="whitebox_primary_content about_content<?php echo ($current_page == 'about') ? ' current' : ''; ?>">
<?php echo $what_we_do->post_content; ?>
    </div><!-- whitebox_primary_content -->
    <div id="who-we-are" class="whitebox_primary_content about_content<?php echo ($current_page != 'about') ? ' current' : ''; ?>">
        <nav class="whitebox_primary_content_nav smaller_arial_caps box_nav">
<?php
    $founder_num = 0;
    $who_we_are_query = new WP_Query('post_parent=' . $who_we_are->ID . '&post_type=page&order=ASC');
    while($who_we_are_query->have_posts()) {
        $who_we_are_query->the_post();
?>

                        <?php echo ($founder_num != 0) ? '<span class="seperator seperator_smaller">|</span>' : ''; ?><a id="whitebox_primary_content_nav_<?php echo $post->post_name; ?>" class="whitebox_primary_content_nav_item <?php echo (($current_page == 'about') && ($founder_num == 0)) ? 'active' : (($current_page == $post->post_name) ? 'active' : ''); ?>" ><?php the_title(); ?></a>
<?php
        $who_we_are_content .= '<section id="whitebox_primary_content_' . $post->post_name . '" class="whitebox_primary_content_founder'; 
        if(($current_page == 'about') && ($founder_num == 0)) {
            $who_we_are_content .= ' current';
        } else if($current_page == $post->post_name) {
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
        $founder_num++;
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
    $current_uri = $_SERVER['REQUEST_URI'];
    $uri_array = explode('/', $current_uri);
    $founders = array('adriaan-pelzer', 'gerrie-smits', 'wessel-van-rensburg');
    $current_page = 'about';
    foreach($founders as $founder) {
        if (in_array($founder, $uri_array)) {
            $current_page = $founder;
        }
    }
?>
<aside class="bluebox bluebox_primary about_bluebox box rounded-corners">
    <header>
    <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps"><?php echo($current_page == 'about') ? 'What we do' : 'Who we are'; ?></h3>
    </header>
    <hr class="blue_hr">
    <div id="bluebox_content_what-we-do" class="bluebox_content_item bluebox_container<?php echo($current_page == 'about') ? ' current' : ''; ?>">
        If advertising is a tax on mediocrity, you've come to a tax free zone.
    </div><!-- bluebox_content_item -->
    <div id="bluebox_content_who-we-are" class="bluebox_container founder_quotes<?php echo($current_page != 'about') ? ' current' : ''; ?>">
<?php
    $who_we_are = get_page_by_title('Who we are');
    global $post;
    $founder_num = 0;
    $who_we_are_pages = new WP_Query('post_parent=' . $who_we_are->ID . '&post_type=page&meta_key=excerpt&order=ASC');
        while ($who_we_are_pages->have_posts()) {
            $who_we_are_pages->the_post();
?>
        <div id="bluebox_content_<?php echo $post->post_name; ?>" class="bluebox_content_item<?php echo (($current_page == 'about') && ($founder_num == 0)) ? ' current' : (($current_page == $post->post_name) ? ' current' : ''); ?>">
<?php
            echo get_post_meta(get_the_ID(), 'excerpt', TRUE);
?> 
        </div><!-- bluebox_content_item -->
<?php
            $founder_num++;

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
    $logo_archive = get_page_by_title('Logo Archive');
    $different_letters = array('r', 'a', 'k');
?>
<div class="bluebox logo_project_bluebox_primary bluebox_primary box rounded-corners">
    <header>
        <h2 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps">Latest Uploads</h2>
    </header>
    <hr>
    <div class="smaller_arial_caps logo_project_bluebox_nav">
<?php
    $content = '';
    foreach ($different_letters as $letter) {
?>
        <span class="logo_project_bluebox_nav_item">
        <span class="logo_project_bluebox_nav_item_left"><a id="expand_<?php echo $letter; ?>"<?php echo ($letter == 'r') ? ' class="active"' : ''; ?>><?php echo strtoupper($letter); ?></a></span>
            <span class="seperator">|</span>
            <span class="logo_project_bluebox_nav_item_right"><a href="<?php echo get_permalink($logo_archive->ID); ?>?letter=<?php echo strtoupper($letter); ?>">View All</a></span>
        </span>
<?php
        $content .= '
    <div id="bluebox_content_' . $letter . '" class="bluebox_content smaller_arial_caps' . (($letter == 'r') ? ' current' : '') . '">
        <div class="bluebox_content_top">';
        $get_letters = new WP_Query(array('post_type' => 'raak_logo_letter', 'posts_per_page' => '6', 'paged' => '1', 'orderby' => 'date', 'meta_query' => array(array('key' => 'character', 'value' => $letter))));
        for($position = 0; $position < 6; $position++) {
            switch ($position) {
            case 0:
                $suffix = 'top_left';
                break;
            case 1:
               $suffix = 'top_center'; 
               break;
            case 2:
               $suffix = 'top_right'; 
               break;
            case 3:
               $suffix = 'bottom_left'; 
               break;
            case 4:
               $suffix = 'bottom_center'; 
               break;
            case 5:
               $suffix = 'bottom_right'; 
               break;
            }
            $current_letter = $get_letters->posts[$position];
            if(($current_letter > 0)) {
                $content .= '
            <div class="bluebox_content_' . $suffix . ' logo_project_letter">
                <div class="logo_project_letter_image rounded-corners">' . get_the_post_thumbnail($current_letter->ID, 'logo-archive') . '</div>
                <div class="logo_project_letter_blurp">
                    Submitted by
                </div>
                <div class="logo_project_letter_name">';
                $user_url = get_post_meta($current_letter->ID, 'creatorurl', TRUE);
                if ($user_url != '') {
                    if ((substr_count($user_url, 'http://') == 0) && (substr_count($user_url, 'https://') == 0)) { 
                        $user_url = 'http://' . $user_url;
                    }
                    $content .= '
                    <a href="' . $user_url . '" target="_blank">' . get_post_meta($current_letter->ID, 'creatorname', TRUE) . '</a>';
                } else {
                    $content .= get_post_meta($current_letter->ID, 'creatorname', TRUE);
                }
                $content .= '
                </div>
            </div><!-- bluebox_content_' . $suffix . ' -->';
            }
            if($position == 2) {
                $content .= '
        </div><!-- bluebox_content_top -->
        <div class="bluebox_content_bottom">';
            }
        }
        $content .= '
        </div><!-- bluebox_content_bottom -->
    </div><!-- bluebox_content -->';
    }
?>
    </div>
    <hr class="solid blue_hr">
<?php
    echo $content;
?>
</div>
<?php


}

add_shortcode('lplu', 'logo_project_latest_uploads');

/*************************/

function logo_project_upload_letter() {
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
?>
<div class="whitebox-secondary tab_container">
    <div class="grey_tab tab tab112 rounded-corners">
        <header>
            <h2>Upload a letter</h2>
        </header>
    </div>
    <div class="whitebox_secondary whitebox box rounded-corners">
        If you would like to be part of this project and contribute to the RAAK logo by uploading a letter, please access this site from a computer.
    </div>
</div>
<?php
    } else {
        $width = 700;
        $height = 840;
        $error_messages = array (
            'upload_letter'=>"Please choose a letter to upload",
            'upload_email'=>"Please enter a valid email address",
            'upload_url'=>"Please enter a valid url",
            'upload_name'=>"Please enter your name",
            'upload_agree'=>"Please tick to agree to the terms & conditions",
            'upload_file'=>"Please select a file to upload",
            'upload_file_type'=>"Picture type should be jpg or png",
            'upload_file_size'=>"Picture size too big",
            'upload_file_dim'=>"Picture dimensions wrong - it should be ".$width."x".$height,
            'upload_file_copy'=>"Picture can not be copied",
            'upload_db_insert'=>"Picture cannot be inserted into the database",
            'upload_db_update'=>"Picture confirmation state cannot be updated"
        );
        $error = array();
        $state = 0;
        $terms = get_page_by_title('Terms and conditions');

        if (isset ($_POST['upload_submit'])) {
            /* required fields */
            foreach (array ('upload_letter', 'upload_email', 'upload_name', 'upload_agree') as $errkey) {
                if (!(isset ($_POST[$errkey])) || ($_POST[$errkey] == "")) {
                    array_push ($error, $errkey);
                }
            }
            /* /required fields */

            /* validation */
            $regex_url = "((https?|ftp)\:\/\/)?"; // SCHEME 
            $regex_url .= "([a-z0-9+!*(),;?&=\$_.-]+(\:[a-z0-9+!*(),;?&=\$_.-]+)?@)?"; // User and Pass 
            $regex_url .= "([a-z0-9-.]*)\.([a-z]{2,3})"; // Host or IP 
            $regex_url .= "(\:[0-9]{2,5})?"; // Port 
            $regex_url .= "(\/([a-z0-9+\$_-]\.?)+)*\/?"; // Path 
            $regex_url .= "(\?[a-z+&\$_.-][a-z0-9;:@&%=+\/\$_.-]*)?"; // GET Query 
            $regex_url .= "(#[a-z_.-][a-z0-9+\$_.-]*)?"; // Anchor 

            if ((isset ($_POST['upload_url']) && ($_POST['upload_url'] != "")) && (!(preg_match ("/^".$regex_url."$/", $_POST['upload_url'])))) {
                array_push ($error, 'upload_url');
            }

            $regex_email = "([a-z0-9-.]*)\@([a-z0-9-.]*)";

            if ((isset ($_POST['upload_email']) && ($_POST['upload_email'] != "")) && (!(preg_match ("/^".$regex_email."$/", $_POST['upload_email'])))) {
                array_push ($error, 'upload_email');
            }
            /* /validation */

            if (($_FILES['upload_file']["name"] == "") && !(isset ($_POST['uploaded_file']))) {
                array_push ($error, 'upload_file');
            }

            if ($_POST['upload_agree'] != 'on') {
                array_push ($error, 'upload_agree');
            }

            if ($_FILES['upload_file']["name"] != "") {
                unset ($_POST['new_letter_id']);
                unset ($_POST['uploaded_file']);
                unset ($_POST['filename']);

                $imagesize = getimagesize ($_FILES["upload_file"]["tmp_name"]);

                if (($_FILES["upload_file"]["type"] != "image/jpeg") && ($_FILES["upload_file"]["type"] != "image/pjpeg") && ($_FILES["upload_file"]["type"] != "image/png") && ($_FILES["upload_file"]["type"] != "image/x-png")) {
                    array_push ($error, 'upload_file_type');
                } else if ($_FILES['upload_file']['size'] > $_POST['MAX_FILE_SIZE']) {
                    array_push ($error, 'upload_file_size');
                } else if (!(($imagesize[0] == $width) && ($imagesize[1] == $height))) {
                    array_push ($error, 'upload_file_dim');
                } else {
                    //$file_just_name = md5 ($_FILES["upload_file"]["name"].time());
                    $filename = md5 ($_FILES["upload_file"]["name"].time()).((($_FILES["upload_file"]["type"] == "image/jpeg") || ($_FILES["upload_file"]["type"] == "image/pjpeg"))?".jpg":".png");
                    $upldir = wp_upload_dir();
                    if (!(move_uploaded_file ($_FILES["upload_file"]["tmp_name"], $upldir['path'] .'/' . $filename))) {
                        array_push ($error, 'upload_file_copy');
                    } else {
                        $file_info = array('guid' => $upldir['url'] .'/' .$filename, 'post_mime_type' => ($_FILES['upload_file']['type']), 'post_title' => $_FILES['upload_file']['name'], 'post_status' => 'inherit', 'post_content' => '');
                        $inserted_file = wp_insert_attachment($file_info, $upldir['path'] . '/' . $filename);
                        require_once(ABSPATH . 'wp-admin/includes/image.php');
                        $file_data = wp_generate_attachment_metadata($inserted_file, $upldir['url'] . '/' . $filename);
                        wp_update_attachment_metadata( $inserted_file, $file_data );

                        $uploaded_file = $filename;

                        if (sizeof ($error) == 0) {

                            $upload_url = ($_POST['upload_url'] == "")?NULL:$_POST['upload_url'];

                            $new_letter = array('post_title' => ($_POST['upload_letter'] . ' - ' . $_POST['upload_name']),  'post_type' => 'raak_logo_letter');
                            $new_letter_id = wp_insert_post($new_letter);
                            if ($new_letter_id != 0) {
                                add_post_meta($new_letter_id, 'character', strtolower($_POST['upload_letter']));
                                add_post_meta($new_letter_id, 'creatormail', $_POST['upload_email']);
                                add_post_meta($new_letter_id, 'creatorname', $_POST['upload_name']);
                                add_post_meta($new_letter_id, 'creatorurl', $_POST['upload_url']);
                                add_post_meta($new_letter_id, 'file', $filename);
                                add_post_meta($new_letter_id, 'creatorip', (get_ip()));
                                add_post_meta($new_letter_id, 'originalname', $_FILES["upload_file"]["name"]);
                                add_post_meta($new_letter_id,'_thumbnail_id', $inserted_file);
                            }
                            $state = 2;

                        }
                    }
                }
            } 
        }
        if (isset ($_POST['preview_submit']) && isset ($_POST['new_letter_id']) && isset ($_POST['uploaded_file'])) {
            wp_publish_post($_POST['new_letter_id']);
            $state = 3;

            $data = array ('confirmed'=>1);
            $where = array ('new_letter_id'=>$_POST['new_letter_id']);

        }

        if (sizeof ($error) > 0) {
            $state = 1;
             if (in_array ('upload_letter', $error)) {
                 $state = 0;
             }
        }
    
?>
<div class="whitebox-secondary tab_container">
    <div class="multiple_tabs logo_letter_upload_tabs">
        <header>
            <div id="letter_upload" class="tab rounded-corners tab112 <?php echo ($state == 0) ? 'active' : ''; ?>">
                <h2>Upload a letter</h2>
            </div>
            <div id="letter_submit" class="tab rounded-corners tab75 <?php echo ($state == 1) ? 'active' : ''; ?>">
                <h2>Submit</h2>
            </div>
            <div id="letter_preview" class="tab rounded-corners tab75 <?php echo ($state == 2) ? 'active' : ''; ?>">
                <h2>Preview</h2>
            </div>
            <div id="letter_finsh" class="tab rounded-corners tab74 <?php echo ($state == 3) ? 'active' : ''; ?>">
                <h2>Finish</h2>
            </div>
        </header>
    </div><!-- multiple_tabs -->
    <div class="whitebox_secondary whitebox box letter_upload rounded-corners">
        <form method="post" enctype="multipart/form-data">
<?php
        if (isset ($_POST['filename'])) {
?>
        <input id="filename" type="hidden" name="filename" value="<?php echo $_POST['filename']; ?>" />
<?php
        } else if (isset ($_FILES["upload_file"]["name"]) && ($_FILES["upload_file"]["name"] != "")) {
?>
        <input id="filename" type="hidden" name="filename" value="<?php echo $_FILES["upload_file"]["name"]; ?>" />
<?php
        }
        if (isset ($new_letter_id) && ($new_letter_id != 0)) {
?>
        <input id="new_letter_id" type="hidden" name="new_letter_id" value="<?php echo $new_letter_id; ?>" />
<?php
        } else if (isset ($_POST['new_letter_id'])) {
?>
        <input id="new_letter_id" type="hidden" name="new_letter_id" value="<?php echo $_POST['new_letter_id']; ?>" />
<?php
        }
        if (isset ($uploaded_file) && ($uploaded_file != "")) {
?>
        <input id="uploaded_file" type="hidden" name="uploaded_file" value="<?php echo $uploaded_file; ?>" />
<?php
        } else if (isset ($_POST['uploaded_file'])) {
?>
        <input id="uploaded_file" type="hidden" name="uploaded_file" value="<?php echo $_POST['uploaded_file']; ?>" />
<?php
        }
?>

    <section id="whitebox_secondary_upload" <?php echo ($state == 0) ? 'class="current"' : ''; ?>>
        <p>Choose the letter you've designed</p>
<?php
        if (in_array ('upload_letter', $error)) {
?>
        <div class="error">
<?php echo $error_messages ['upload_letter']; ?>
        </div>
<?php
        }
?>
        <div id="whitebox_secondary_upload_letters">
            <input id="upload_letter" type="hidden" name="upload_letter" value="<?php echo(isset($_POST['upload_letter']) ? $_POST['upload_letter'] : 'R'); ?> ">
            <span class="letter"><a id="letter_R" class="selected"><img alt="logo r" src="<?php echo get_bloginfo('template_url'); ?>/images/ar.jpg"></a></span>
            <span class="letter"><a id="letter_A"><img alt="logo a" src="<?php echo get_bloginfo('template_url'); ?>/images/ay1.jpg"></a></span>
            <span class="letter"><a id="letter_K"><img alt="logo k" src="<?php echo get_bloginfo('template_url'); ?>/images/kay.jpg"></a></span>
        </div>
        <div id="whitebox_secondary_upload_next">
            <a class="smaller_arial_caps">Next &#9658;</a>
        </div>
    </section><!-- whitebox_secondary_upload -->
    <section id="whitebox_secondary_submit" <?php echo ($state == 1) ? 'class="current"' : ''; ?>>
<?php
        foreach ($error as $errkey) {
            if (preg_match ("/upload_db/", $errkey)) {
?>
                <li class="error"><?php echo $error_messages [$errkey]; ?></li>
<?php
            }
        }
?>
                <ul class="smaller_arial_caps">
<?php
        if (in_array ('upload_name', $error)) {
?>
                <li class="error"><?php echo $error_messages ['upload_name']; ?></li>
<?php
        }
?>
                    <li id="whitebox_secondary_submit_name">
                        <label for="upload_name">Your Name</label>
                        <input id="upload_name" name="upload_name" type="text" maxlength="40">
                    </li>
<?php
        if (in_array ('upload_email', $error)) {
?>
                    <li class="error"><?php echo $error_messages ['upload_email']; ?></li>
<?php
        }
?>
                    <li id="whitebox_secondary_submit_email">
                        <label for="upload_email">Email</label>
                        <input id="upload_email" name="upload_email" type="text" maxlength="255">
                    </li>
<?php
        if (in_array ('upload_url', $error)) {
?>
                    <li class="error"><?php echo $error_messages ['upload_url']; ?></li>
<?php
        }
?>
                    <li id="whitebox_secondary_submit_url">
                        <label for="upload_url">URL</label>
                        <input id="upload_url" name="upload_url" type="text" maxlength="255">
                    </li>
<?php
        foreach ($error as $errkey) {
            if (preg_match ("/upload_file/", $errkey)) {
                if ($errkey == "upload_file_type") {
?>
                    <li class="error"><?php echo $error_messages [$errkey].": file type: ".$_FILES["upload_file"]["type"]; ?></li>
<?php
                } else {
?>
                    <li class="error"><?php echo $error_messages [$errkey]; ?></li>
<?php
                }
            }
        }
?>

                    <li id="whitebox_secondary_submit_file">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                        <label for="upload_file">Browse for file</label>
                        <div id="file_replace"><input id="upload_file" name="upload_file" type="file"><p id="dummy_file_text"></p></div>
                    </li>
<?php
        if (in_array ('upload_agree', $error)) {
?>
                            <li class="error"><?php echo $error_messages ['upload_agree']; ?></li>
<?php
        }
?>
                    <li id="whitebox_secondary_submit_agree">
                    <label for="upload_agree">I agree to the <a href="<?php echo get_permalink($terms->ID); ?>">terms &amp; conditions</a></label>
                        <input id="upload_agree" name="upload_agree" type="checkbox">
                        <input name="upload_submit" type="submit" value="Submit &#9658;">
                    </li>
                    <li class="whitebox_secondary_logo_project_back">
                        <a id="logo_project_submit_back">&#9668; Go back</a>
                    </li>
                </ul>
            </section><!-- #whitebox_secondary_submit -->
            <section id="whitebox_secondary_preview" class="smaller_arial_caps<?php echo ($state == 2) ? ' current' : ''; ?>">
                <div id="whitebox_secondary_preview_letters">
<?php
        $my_letter = 0;
        $input_letter = $_POST['upload_letter'];
        if ($input_letter == 'A') {
            $my_letter = 1;
        } else if ($input_letter == 'K') {
            $my_letter = 3;
        }
        $letters = array('R'=>'/images/r.jpeg', 'A1'=>'/images/a1.jpeg', 'A2'=>'/images/a2.jpeg', 'K'=>'/images/k.jpeg');
        $curr_letter = 0;
        $preview_content = '';
        foreach($letters as $letter => $letter_img) {
            if ($curr_letter != $my_letter) {
                $preview_content .= '<span class="logo_container" id="preview_letter_' . $letter . '"><span><img alt="logo ' . $letter .'" src="' . get_bloginfo('template_url') . $letter_img .'" /></span></span>';
            } else {
                $preview_content .= '<span class="logo_/*for iphone*ocontainer" id="my_letter_'. $_POST['upload_letter'] . '"><span>' . get_the_post_thumbnail($new_letter_id) . '</span></span>';
            }
            $curr_letter++;
        }
        echo $preview_content;
?>
                </div>
                <div id="whitebox_secondary_preview_submit">
                    <input name="preview_submit" type="submit" value="HAPPY? Then SUBMIT your letter ►">
                </div>
                <div class="whitebox_secondary_logo_project_back">
                    <a id="logo_project_preview_back">&#9668; Go back</a>
                </div>
            </section><!-- #whitebox_secondary_preview -->
            <section id="whitebox_secondary_finish" <?php echo ($state == 3) ? 'class="current"' : ''; ?>>
                <p class="big_and_bold">THANKS for taking part!</p>
                <p>Your letter is now part of the loop.</p>
                <button id="again">Upload another letter</button>
            </section><!-- #whitebox_secondary_finish -->
        </form>
    </div><!-- whitebox_secondary -->
</div>

<?php
    }
}

add_shortcode('upload', 'logo_project_upload_letter');


/*************************/

function logo_project_archive() {
    if(isset($_GET['letter'])) {
        $current_letter = $_GET['letter'];
    } else {
        $current_letter = 'R';
    }
    $letters = array('R', 'A', 'K');
    $content = '';
    $logo_project_page = get_page_by_title('Logo Project');
?>
<div class="bluebox_big bluebox box big_box rounded-corners">
    <header>
        <h2 class="din-schrift blue_20">Logo Project</h2>
        <nav id="bluebox_big_nav" class="smaller_arial_caps box_nav">
<?php
    foreach($letters as $letter) {
?>
            <a id="expand_<?php echo $letter; ?>"<? echo ($current_letter == $letter) ? ' class="active"' : ''; ?>><?php echo $letter; ?></a>
            <span class="seperator seperator_smaller">|</span>
<?php
        $content .= '
    <section id="bluebox_big_content_' . $letter .'" class="bluebox_big_content smaller_arial_caps' . (($current_letter == $letter) ? ' current' : '') . '">
        <h3 id="expanded_letter_' . strtolower($letter) . '" class="expanded_letter smaller_arial_caps">Letter ' . $letter .' </h3>
        <hr class="solid blue_hr" />
        <div class="bluebox_big_content_row">';
        $all_letters = new WP_Query(array('post_type' => 'raak_logo_letter', 'meta_value' => strtolower($letter), 'post_status' => 'publish'));
        $total_rows = (ceil($all_letters->post_count / 6));
        $row_counter = 0;
        while($all_letters->have_posts()) {
            $all_letters->the_post();
            $current_letter_id = get_the_ID();
            $content .= '
            <div class="bluebox_big_content_row_item logo_archive_logo_project_letter logo_project_letter">
                <div class="logo_project_letter_image rounded-corners">' . get_the_post_thumbnail($current_letter_id, 'logo-archive') . '</div>
                <div class="logo_project_letter_blurp">
                    Submitted by
                </div>
                <div class="logo_project_letter_name">';
                $user_url = get_post_meta($current_letter_id, 'creatorurl', TRUE);
                if ($user_url != '') {
                    if ((substr_count($user_url, 'http://') == 0) && (substr_count($user_url, 'https://') == 0)) { 
                        $user_url = 'http://' . $user_url;
                    }
                    $content .= '
                    <a href="' . $user_url . '" target="_blank">' . get_post_meta($current_letter_id, 'creatorname', TRUE) . '</a>
                </div>';
                } else {
                    $content .= get_post_meta($current_letter_id, 'creatorname', TRUE) . '
                </div>';
                }if ($row_counter == 6) {
                    $content .= '
            </div><!-- bluebox_big_content_row_item -->
        </div><!-- .bluebox_big_content_row -->
        <div class="bluebox_big_content_row">';
                } else {
                    $content .= '
            </div><!-- bluebox_big_content_row_item -->';
                }

                $row_counter++;
        }
        $content .= '
        </div><!-- .bluebox_big_content_row -->
    </section><!-- bluebox_big_content -->';
        wp_reset_query();
    }
?>
    <a id="bluebox_big_nav_back" href="<?php echo get_permalink($logo_project_page->ID); ?>">Back</a>
        </nav>
    </header>
    <hr />
<?php
    echo $content;
?>
</div>
<?php
}

add_shortcode('logo_archive', 'logo_project_archive');

/*************************/

function template_download_box() {
?>
<aside class="whitebox-secondary tab_container">
    <div class="tab blue_tab tab112 rounded-corners">
        <header>
            <h2>Downloads</h2>
        </header>
    </div>
    <div class="whitebox_secondary logo_project_whitebox_secondary whitebox box rounded-corners">
        <ul>
            <li><a href="<?php echo get_bloginfo('template_url'); ?>/templates/RAAK-letter-Illustrator-template.zip">Illustrator Template</a></li>
            <li><a href="<?php echo get_bloginfo('template_url'); ?>/templates/raak-letter-PS-template.zip">Photoshop Template</a></li>
        </ul>
    </div>
</aside><!-- whitebox-secondary -->

<?php
}

add_shortcode('tmplt_dl_b', 'template_download_box');

/************************/

function basic_whitebox($atts) {
    extract(shortcode_atts(array('page' => ''), $atts));
?>
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners">
<?php
    if ($page == 'contact') {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        $iphone = (strpos($useragent, 'iPhone') !== FALSE);
        if($iphone) {
?>
<style>form.wpcf7-form p {font-size: 6px!important;}</style>
<?php
        }
    }
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
        wp_reset_query();
    }
}

add_shortcode('basic_wb', 'basic_whitebox');

/************************/

function theraakonteur_whitebox() {
?>
<div class="whitebox whitebox_primary whitebox_top_margin theraakonteur_whitebox_primary whitebox-primary box rounded-corners">
<?php
    if (have_posts()) {
        while(have_posts()) {
            the_post();
?>
                <header>
                    <h3><?php the_title(); ?></h3>
                </header>
                <hr>
                <div class="whitebox_primary_content">
<?php the_content(); ?>
                </div><!-- .whitebox_primary_content -->
            </div>

<?php
        }
        wp_reset_query();
    }
}

add_shortcode('raak_wb', 'theraakonteur_whitebox');

/*************************/

function theraakonteur_bluebox() {
    $the_raakonteurs = new WP_Query(array('cat'=> get_cat_id('RAAKonteur'), 'posts_per_page' => 10));

?>
<div class="tab_container bluebox-primary">
    <div class="blue_tab tab tab108 rounded-corners">
        <header>
            <h3>Raakonteurs</h3>
        </header>
    </div><!-- bluebox_tab -->
    <div class="raakonteur_bluebox_primary bluebox_primary bluebox box rounded-corners">
        <ul>
<?php
    if($the_raakonteurs->have_posts()) {
        while($the_raakonteurs->have_posts()) {
            $the_raakonteurs->the_post();
?>
            <li><a href="<?php echo get_permalink(the_ID()); ?>"><?php the_title(); ?></a></li>
<?php
        }
    }
?>
        </ul>
        <hr class="blue_hr" />
    </div>
</div>
<?php
}

add_shortcode('raak_bb', 'theraakonteur_bluebox');

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
        <a target="_blank" href="<?php echo get_post_meta ($contact_page->ID, 'googlemaplink', true); ?>"><img alt="map to RAAK" id="gimg" src="<?php echo get_bloginfo ('template_directory'); ?>/images/map2.png" /></a>
    </div>
</div>
<?php
}

add_shortcode('contactbb', 'contact_bluebox');


/*************************/

function big_whitebox_products() {
    $current_page = get_page_by_title('Our Products');
    $current_page_posts_loop = new WP_Query(array('post_type' => 'raak_product', 'posts_per_page' => -1));

    $total_rows = (ceil($current_page_posts_loop->post_count / 3));
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
    <h2 class="din-schrift blue_20"><?php echo $current_page->post_title; ?></h2>
        <!-- nav class="box_nav smaller_arial_caps">
            <a id="whitebox_big_nav_all-products" class="whitebox_big_nav_item active">All Products</a>
        </nav -->
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
    } else {
        $active = 'all-projects';
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
            $current_cat_loop = new WP_Query(array('category_name' => ($work_category->name), 'post_type' => 'raak_project', 'posts_per_page' => -1, 'orderby' => 'date'));
            $total_rows = (ceil($current_cat_loop->post_count / 3));
            $children_cats_item_count = 0;
            $children_cats .= '<div id="whitebox_big_' . $work_category->category_nicename . '" class="whitebox_big_category smaller_arial_caps'. (($active == $work_category->category_nicename) ? ' current' : '') . '">';
            for($row_count = 0; $row_count < (($total_rows > 3) ? $total_rows : 3); $row_count++) {
                $children_cats .= '<div id="whitebox_big_category_row_' . $work_category->category_nicename . '_' . $row_count . '" class="whitebox_big_category_row">';
                for($row_item = 0; $row_item < 3; $row_item++) {
                    if ($current_cat_loop->posts[$children_cats_item_count]) {
                        $children_cats .= '<div class="whitebox_big_category_entry" id="category_entry_' . $work_category->category_nicename . '_' . $children_cats_item_count . '">
                                <header>
                                    <h3 class="whitebox_big_category_entry_title">
                                    <span class="whitebox_big_category_entry_title_label">client:</span>
                                        <span class="whitebox_big_category_entry_title_name">' . get_post_meta($current_cat_loop->posts[$children_cats_item_count]->ID, 'Client', TRUE) . '</span>
                                    </h3><!-- .whitebox_big_category_entry_title -->
                                </header>
                                <hr class="solid">
                                <a class="whitebox_big_category_entry_content" href="' . get_permalink($current_cat_loop->posts[$children_cats_item_count]->ID) . '">
                                    <div id="post_all-products_' . $work_category->category_nicename . '_' . $children_cats_item_count . '_picture" class="whitebox_big_category_entry_content_picture current">';
                        $children_cats .= get_image ($current_cat_loop->posts[$children_cats_item_count]->post_content, 220, 142);
                        $children_cats .= '</div><!-- post_all-products_' . $work_category->category_nicename . '_' . $children_cats_item_count . '_picture -->
                                    <div id="post_all-products_' . $work_category->category_nicename . '_' . $children_cats_item_count . '_overview" class="whitebox_big_category_entry_content_overview">
                                        <p>' . get_post_meta($current_cat_loop->posts[$children_cats_item_count]->ID, 'Overview', TRUE) . '</p>
                                    </div><!-- #post_' . $work_category->category_nicename . '_' . $children_cats_item_count . '_overview -->
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
                $children_cats .= '</div><!-- #whitebox_big_category_row' . $work_category->category_nicename . '_' . $row_count . ' -->';
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
    $all_projects_loop = new WP_Query(array('post_type' => 'raak_project', 'posts_per_page' => -1, 'orderby' => 'date'));

    $total_rows = (ceil($all_projects_loop->post_count / 3));
    $item_count = 0;
?>
                    <div id="whitebox_big_all-projects" class="whitebox_big_category smaller_arial_caps<?php echo ($active == 'all-projects') ? ' current' : ''; ?>">
<?php
    for($row_count = 0; $row_count < (($total_rows > 3) ? $total_rows : 3); $row_count++) {
?>
                        <div id="whitebox_big_category_row_all-projects<?php echo $row_count; ?>" class="whitebox_big_category_row">
<?php
        for($row_item = 0; $row_item < 3; $row_item++) {
            if ($all_projects_loop->posts[$item_count]) {
?>
                            <div class="whitebox_big_category_entry" id="category_entry_all-projects_<?echo $item_count; ?>">
                                <header>
                                    <h3 class="whitebox_big_category_entry_title">
                                    <span class="whitebox_big_category_entry_title_label">client:</span>
                                        <span class="whitebox_big_category_entry_title_name"><?php echo get_post_meta($all_projects_loop->posts[$item_count]->ID, 'Client', TRUE); ?></span>
                                    </h3><!-- .whitebox_big_category_entry_title -->
                                </header>
                                <hr class="solid">
                                <a class="whitebox_big_category_entry_content" href="<?php echo get_permalink($all_projects_loop->posts[$item_count]->ID); ?>">
                                    <div id="post_all-products_all-projects_<?php echo $item_count; ?>_picture" class="whitebox_big_category_entry_content_picture current">
                                        <?php echo get_image ($all_projects_loop->posts[$item_count]->post_content, 220, 142); ?>
                                    </div><!-- post_all-products_all-projects<?php echo $item_count; ?>_picture -->
                                    <div id="post_all-products_all-projects_<?php echo $item_count; ?>_overview" class="whitebox_big_category_entry_content_overview">
                                        <p><?php echo get_post_meta($all_projects_loop->posts[$item_count]->ID, 'Overview', TRUE); ?></p>
                                    </div><!-- #post_all-projects<?php echo $item_count; ?>_overview -->
                                </a>
                            </div><!-- .whitebox_big_category_entry all-projects -->
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
            if (strpos($_SERVER['REQUEST_URI'], 'raak-products') !== false) {
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
?>
        </nav>
<?php
            }
?>
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
        wp_reset_query();
    }
}

add_shortcode('sp_wb', 'single_project_whitebox');

/*************************/

function single_project_bluebox() {
?>
<div class="bluebox bluebox_primary box bluebox-primary rounded-corners bluebox_top_margin">
    <div class="bluebox_bigpic">
    </div>
<?php
    if (($homepage = get_post_meta(get_the_id(), 'homepage', true)) != '') {
?>
    <a class="homepage_link bigger_arial_no_caps" href="<?php echo $homepage; ?>">Website home page</a>
<?php
    }
?>
    <hr class="solid blue_hr single_project_bluebox_hr" />
    <div class="bluebox_thumbpic">
<?php
    ob_start();
    the_content();
    $gallery_contents = ob_get_contents();
    ob_end_clean();
    $img_count = substr_count($gallery_contents, 'img');
    $img_array = array();
    $link_start = strpos($gallery_contents, '<a');
    for($img_counter = 0; $img_counter < $img_count; $img_counter++) {
        $start_pos = strpos($gallery_contents, '"', $link_start);
        $end_pos = strpos($gallery_contents, '"', ($start_pos + 1));
        $img_tag = substr($gallery_contents, ($start_pos +1), (($end_pos - $start_pos) -1));
        array_push($img_array, $img_tag);
        $link_start = strpos($gallery_contents, '<a', $end_pos);
    }
    foreach($img_array as $img_src) {
        echo '<img class="preloaded_img" src="' . $img_src . '" />';
    }
    echo $gallery_contents;
?>
    </div>
</div><!-- #bluebox -->
<?php
}

add_shortcode('sp_bb', 'single_project_bluebox');

/*************************/

function search_box($atts) {
    extract(shortcode_atts(array('page' => 'blog'), $atts));
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
        <form class="whitebox_big_search smaller_arial_caps" method="get" action="http://www.google.com/search">
            <input class="submit_button" type="submit" value="Search" />
            <input type="text" id="searchtext" name="q" maxlength="255" value="" />
            <input type="hidden"  name="sitesearch" value="wewillraakyou.com" />
        </form>
        <!-- span class="whitebox_big_search smaller_arial_caps"><a onclick="javascript: google_search();">Search</a><input type="text" id="searchtext"></span -->
        <h2 class="din-schrift blue_20"><?php echo ($page == '404') ? 'Oops ... you\'ve hit a 404!' : 'Our Blog'; ?></h2>
    </header>
</div>

<?php
}

add_shortcode('sb', 'search_box');

/*************************/

function category_box($atts) {
    extract(shortcode_atts(array('tab1' => '', 'tab2' => ''), $atts));
?>
<div class="whitebox-secondary tab_container">
<?php
    if ($tab2 != '') {
?>
    <div class="multiple_tabs">
        <header>
            <div class="tab rounded-corners tab108 active" id="<?php echo $tab1; ?>">
            <h3><a><?php echo str_replace('-', ' ', $tab1); ?></a></h3>
            </div>
            <div class="tab rounded-corners tab108" id="<?php echo $tab2; ?>">
                <h3><a><?php echo str_replace('-', ' ', $tab2); ?></a></h3>
            </div>
        </header>
    </div><!-- multiple_tabs -->
<?php
    } else {
?>
    <div class="tab rounded-corners tab108 active">
        <header>
            <h3><a id="<?php echo $tab1; ?>"></a><?php echo str_replace('-', ' ', $tab1); ?></a></h3>
        </header>
    </div><!-- tab -->
<?php
    }
?>
    <div class="whitebox_secondary blog_whitebox_secondary whitebox box rounded-corners">
        <div id="whitebox_secondary_item_most-viewed" class="whitebox_secondary_item current">
            <ul>
<?php
    
    $most_viewed = new WP_Query(array('orderby' => 'meta_value_num', 'meta_key' => 'postviews', 'posts_per_page' => 6, 'paged' => 1));
    foreach(($most_viewed->posts) as $viewed_post) {
?>

                <li><a href="<?php echo get_permalink($viewed_post->ID); ?>"><?php echo $viewed_post->post_title; ?></a></li>
<?php
    }
    wp_reset_query();
?>
            </ul>

        </div><!-- #whitebox_secondary_mostviewed -->
<?php
    if ($tab2 == 'category') {
        $cat_array = array('Inspiration', 'Must Read', 'Raakonteur', 'Worth a look');
?>
        <div id="whitebox_secondary_item_category" class="whitebox_secondary_item">
            <ul>
<?php
        foreach ($cat_array as $category) {
?>

                <li><a href="<?php echo get_category_link(get_cat_id($category)); ?>"><?php echo $category; ?></a></li>
<?php 
        }
?>
            </ul>
        </div><!-- #whitebox_secondary_category -->
<?php
    }
?>
    </div><!-- whitebox_secondary -->
</div>

<?php
}

add_shortcode('cat_box', 'category_box');

/*************************/

function single_blog_post() {
    $useragent=$_SERVER['HTTP_USER_AGENT'];
    $iphone = (strpos($useragent, 'iPhone') !== FALSE);
    if($iphone) {
?>
<style>.opengraphprotocoltools-div{height:24px;}</style>
<?php
    }
    if(have_posts()) {
        while(have_posts()) {
            the_post();
            setPostViews(get_the_ID());
            $author_full_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
            $author_page = get_page_by_title($author_full_name);
?>
<div class="whitebox whitebox_primary blog_single_whitebox_primary blog_whitebox_primary whitebox-primary box rounded-corners">
                <article class="whitebox_primary_post">
                    <header>
                        <h3 id="whitebox_primary_title"><?php the_title(); ?></h3>
                    </header>
                    <hr>
                    <div class="whitebox_primary_post_attr">
                        <div class="whitebox_primary_post_attr_item author">Posted by <a rel="author" href="<?php echo get_permalink($author_page->ID);  ?>"><?php echo $author_full_name; ?></a></div>
                        <div class="whitebox_primary_post_attr_item date"><?php the_date('j F Y'); ?></div>
                        <div class="whitebox_primary_post_attr_item time"><?php the_time('G:i'); ?></div>
                        <div class="whitebox_primary_post_attr_item comments_count"><img class="commenticon" src="<?php echo get_bloginfo('template_url'); ?>/images/whitebox_primary_body_attr_comment_icon.png"><?php comments_number('0 comments', '1 comment', '% comments'); ?></div>
                    </div><!-- .whitebox_primary_post_attr -->
                    <div class="whitebox_primary_share">
                        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-via="<?php echo $twittername; ?>" data-related="RAAKonteurs" data-text="<?php the_title(); ?> &#9733; RAAK">Tweet</a>
                        <script>
                            !function(d,s,id){
                                var js,fjs=d.getElementsByTagName(s)[0];
                                if(!d.getElementById(id)){
                                    js=d.createElement(s);
                                    js.id=id;js.src="//platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js,fjs);
                                }
                            }
                        (document,"script","twitter-wjs");
                        </script>
                                    <div id="fb-root"></div>
                        <script>
                        (function(d, s, id) {
                            var js, fjs = d.getElementsByTagName(s)[0];
                            if (d.getElementById(id)) return;
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                        (document, 'script', 'facebook-jssdk'));
                        </script>
<?php
/**
 * Include this code on your theme for single blog posts (for example, in your single.php file)
 * or on your blogs main page to include a Facebook "Like" iframe
 */
            if (function_exists('the_opengraphprotocoltools_like_code')):
                ob_start();
                the_opengraphprotocoltools_like_code();
                $likecode = ob_get_contents();
                ob_end_clean();
                echo str_replace ("layout=standard", "layout=button_count", $likecode);
            else:
                echo "<!-- opengraphprotocoltools is not activated -->";
endif;
?>
                            <!--fb:like href="<?php the_permalink(); ?>" send="false" layout="button_count" width="450" show_faces="false"></fb:like-->
                        <!-- div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div -->
                        <fb:send></fb:send>
                        <!-- Place this tag where you want the +1 button to render -->
                        <g:plusone size="medium"></g:plusone>

                        <!-- Place this render call where appropriate -->
                        <script type="text/javascript">
                          (function() {
                            var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                            po.src = 'https://apis.google.com/js/plusone.js';
                            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                          })();
                        </script>
                    </div><!-- .whitebox_primary_share -->
                    <hr class="solid">
                    <div class="whitebox_primary_content">
<?php
            the_content();
?>
                    </div><!-- .whitebox_primary_content -->
                    <p>
                        <span><em>Posted by <a rel="author" href="<?php echo get_permalink($author_page->ID);  ?>"><?php echo $author_full_name; ?></a></em></span>
                    </p>
                    <div class="whitebox_primary_flwbtn">
                        <a href="https://twitter.com/<?php echo get_post_meta($author_page->ID, 'twitterhandle', TRUE); ?>" class="twitter-follow-button" data-show-count="true">Follow @<?php echo get_post_meta($author_page->ID, 'twitterhandle', TRUE); ?></a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </article><!-- .whitebox_primary_post -->
                <div class="whitebox_primary_comments">
<?php comments_template(); ?>
                </div><!-- whitebox_primary_comments -->
            </div>
<?php
        }
        wp_reset_query();
    }
}

add_shortcode('single_post', 'single_blog_post');

/*************************/

function related_blog_posts() {
    ob_start();
    wp_related_posts();
    $related_posts = ob_get_contents();
    ob_end_clean();
    $r_posts = array();
    foreach (explode ("</a></li><li><a href=\"", $related_posts) as $post_carcass) {
        list ($href, $post_carcass) = explode ("\" title=\"", $post_carcass, 2);
        list ($alt, $title) = explode ("\">", $post_carcass, 2);
        foreach (explode ('/', $href) as $slug) {
            if ($slug != '') {
                $page_name = $slug;
            }
        }
        array_push ($r_posts, get_post_by_name ($page_name));
    }
?>
<?php
?>
<div class="tab_container bluebox-primary other_posts">
    <div class="blue_tab tab tab108 rounded-corners">
        <header>
            <h3>Related Posts</h3>
        </header>
    </div><!-- bluebox_tab -->
    <div class="bluebox_primary blog_single_bluebox_primary blog_bluebox_primary bluebox box rounded-corners">
        <div class="bluebox_content_top">
<?php
    $post_number = 0;
    if (sizeof ($r_posts) > 0) {
        while(!$r_posts[$post_number]) {
            $post_number++;
        }
?>
            <div class="bluebox_content_quarter bluebox_content_top_left">
                <a href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo get_image_or_video ($r_posts[$post_number]->post_content, 120, 85); ?></a>
                <h4><a class="grey_text" href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo $r_posts[$post_number]->post_title; ?></a></h4>
            </div>
<?php
        $post_number++;
    }
    if (sizeof ($r_posts) > 1) {
        while(!$r_posts[$post_number]) {
            $post_number++;
        }
?>

            <div class="bluebox_content_quarter bluebox_content_top_right">
                <a href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo get_image_or_video ($r_posts[$post_number]->post_content, 120, 85); ?></a>
                <h4><a class="grey_text" href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo $r_posts[$post_number]->post_title; ?></a></h4>
            </div>
<?php
        $post_number++;
    }
?>
        </div><!-- bluebox_content_top -->
<?php
    if (sizeof($r_posts) > 2) {
?>
        <hr id="left_related_posts_hr" class="solid blue_hr related_posts_hr" />
        <hr id="right_related_posts_hr" class="solid blue_hr related_posts_hr" />
<?php
    }
?>
        <div class="bluebox_content_bottom">
<?php
    if (sizeof($r_posts) > 2) {
        while(!$r_posts[$post_number]) {
            $post_number++;
        }
?>
            <div class="bluebox_content_quarter bluebox_content_bottom_left">
                <a href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo get_image_or_video ($r_posts[$post_number]->post_content, 120, 85); ?></a>
                <h4><a class="grey_text" href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo $r_posts[$post_number]->post_title; ?></a></h4>
            </div>
<?php
        $post_number++;
    }
    if(sizeof($r_posts) > 3) {
        while(!$r_posts[$post_number]) {
            $post_number++;
        }
?>
            <div class="bluebox_content_quarter bluebox_content_bottom_right">
                <a href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo get_image_or_video ($r_posts[$post_number]->post_content, 120, 85); ?></a>
                <h4><a class="grey_text" href="<?php echo get_permalink($r_posts[$post_number]->ID); ?>"><?php echo $r_posts[$post_number]->post_title; ?></a></h4>
            </div>
<?php
    }
?>
        </div><!-- bluebox_content_bottom -->
    </div><!-- bluebox_primary -->
</div><!-- bluebox-primary -->

<?php

}

add_shortcode('rel_posts', 'related_blog_posts');

/*************************/

function big_title_box($atts) {
    extract(shortcode_atts(array('page_type' => ''), $atts));
    switch($page_type) {
    case 'tag':
        $page_title = 'Blog Archive: ' . single_tag_title('', FALSE);
        break;
    case 'author' :
        $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
        $page_title = 'Author: ' . $curauth->display_name;
        break;
    case 'category' :
        $page_title = 'Category: ' . single_cat_title('', FALSE);
        break;
    case 'theraakonteur' :
        $page_title = 'The Raakonteur';
        break;
    default:
        if(have_posts()) {
            while(have_posts()){
                the_post();
                $page_title = get_the_title();
            }
        }
        break;
    }
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
    <header>
    <h2 class="din-schrift blue_20"><?php echo $page_title; ?></h2>
    </header>
</div>
<?php
}

add_shortcode('title', 'big_title_box');

/*************************/


function blog_archive_post_list($atts) {
    extract(shortcode_atts(array('page_type' => ''), $atts));
    $page_num = (get_query_var('page')) ? get_query_var('page') : 1; 
    $blog_archive_page = get_page_by_title('Blog Archive');
    $tag = '';
    $author = '';
    $cat = 'blog';
    switch($page_type) {
    case 'tag' :
        $tag = get_query_var('tag');
        break;
    case 'author' :
        $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
        $author = $curauth->ID;
        break;
    case 'category' :
        $cat = strtolower(single_cat_title('', FALSE));
        break;
    default:
        break;
    }
    $archive_posts = new WP_Query(array('category_name' => $cat, 'tag' => $tag, 'author' => $author, 'posts_per_page' => '20', 'paged' => $page_num));
?>
<div class="whitebox whitebox_primary blog_whitebox_primary_title_only blog_whitebox_primary whitebox-primary box rounded-corners">
<?php
    $post_num = 0;
    while($archive_posts->have_posts()) {
        $archive_posts->the_post();
            $author_full_name = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
            $author_page = get_page_by_title($author_full_name);
?>
    <div id="whitebox_primary_post_<?php echo $post_num; ?>" class="whitebox_primary_post">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <hr />
        <div class="whitebox_primary_post_attr">
        <span class="whitebox_primary_post_attr_item author">Posted by <a rel="author" href="<?php echo get_permalink($author_page->ID); ?>"><?php echo $author_full_name; ?></a></span>
            <span class="seperator">|</span>
            <span class="whitebox_primary_post_attr_item date"><?php the_date('j F Y'); ?></span>
            <span class="seperator">|</span>
            
            <span class="whitebox_primary_post_attr_item comments_count"><img class="commenticon" alt="comment icon" src="<?php echo get_bloginfo('template_url'); ?>/images/whitebox_primary_body_attr_comment_icon.png" /><?php comments_number('0 comments', '1 comment', '% comments'); ?></span>
        </div><!-- .whitebox_primary_attr -->
        <hr class="solid" />
    </div>
<?php
            $post_num++;
    }
?>
    <footer class="whitebox_primary_footer box_nav small_arial_caps">
        <a class="whitebox_primary_footer_left"  href="<?php echo get_permalink($blog_archive_page->ID); ?>">All blog posts</a>
        <div class="whitebox_primary_footer_right">
<?php
    if($page_num < $archive_posts->max_num_pages) {
?>

            <a class="active" href="?page=<?php echo ($page_num + 1); ?>"><span class="arrow">&#9668;</span>Previous</a>
<?php
    } else {
?>
            <a href=""><span class="arrow">&#9668;</span>Previous</a>
<?php
    }
?>
<span class="seperator">|</span>
<?php
    if($page_num > 1) {
?>
            <a class="active" href="?page=<?php echo ($page_num - 1); ?>">Next<span class="arrow">&#9658;</span></a>
<?php
    } else {
?>
            <a href="">Next<span class="arrow">&#9658;</span></a>
<?php
    }
?>
        </div><!-- .whitebox_primary_footer_right -->
    </footer><!-- .whitebox_primary_footer -->
</div><!-- whitebox_primary -->
<?php
    wp_reset_query();
}

add_shortcode('archive_list', 'blog_archive_post_list');


/*************************/

function blog_tag_box($atts) {
    extract(shortcode_atts(array('all_tags' => '0'), $atts));
    if($all_tags != '0') {
        $tag_num = 0;
    } else {
        $tag_num = 60;
    }
    $blog_tags = new WP_Query(array('category_name'=>'blog', 'posts_per_page'=>-1));
    if($blog_tags->have_posts()){
        while ($blog_tags->have_posts()) {
            $blog_tags->the_post();
            $all_tag_objects = get_the_tags();
            if($all_tag_objects){
                foreach($all_tag_objects as $tag) {
                    if($tag->count > 0) {$all_tag_ids[] = $tag -> term_id;}
                }
            }
        }
    }
    $tag_ids_unique = array_unique($all_tag_ids);
?>
<div class="tab_container bluebox-primary other_posts">
    <div class="blue_tab tab tab108 rounded-corners">
        <header>
            <h2>Tags</h2>
        </header>
    </div><!-- blue_tab -->
    <div class="bluebox_primary blog_bluebox_primary bluebox box rounded-corners">
<?php
    wp_tag_cloud('include=' . implode(',', $tag_ids_unique) . '&number=' . $tag_num . '');
?>
    </div><!-- bluebox_primary -->
</div><!-- bluebox-primary -->
<?php
}
add_shortcode('tags', 'blog_tag_box');

/*************************/

function post_authors() {
?>
<div class="whitebox-secondary tab_container">
    <div class="blue_tab tab tab108 rounded-corners">
        <header>
            <h2>Authors</h2>
        </header>
    </div><!-- blue_tab -->
    <div class="whitebox_secondary blog_whitebox_secondary whitebox box rounded-corners">
        <ul>
<?php
    wp_list_authors('show_fullname=1&orderby=post_count&order=DESC');
?>
        </ul>
    </div><!-- whitebox_secondary -->
</div>
<?php
}
add_shortcode ('authors', 'post_authors');

/*************************/

function whitebox_404_page_function() {
?>
<div class="blog_whitebox_primary whitebox whitebox_primary error404 not-found whitebox-primary box rounded-corners">
    <h3 class="whitebox_primary_title">Did you know?</h3>
    <hr />
        <p>'RAAK' means 'Spot-on' in Afrikaans. This time, though, it's not really applicable. The page you were looking for, is nowhere to be found. Hmmm ... we're feeling a bit uncomfortable now. What are we going to say next?</p>
        <p>Ah! How about a random fortune?</p>
        <blockquote>
<?php
$ch = curl_init ("http://www.fortunefortoday.com/getfortuneonly.php");
curl_exec($ch);
?>
        </blockquote>
    <hr class="solid" />
    <footer class="whitebox_primary_footer box_nav small_arial_caps">
        <a class="whitebox_primary_footer_left" href="<?php echo get_permalink($blog_archive_page->ID); ?>">All blog posts</a>
    </footer><!-- .whitebox_primary_footer -->
</div>
<?php
}
add_shortcode('wb_404', 'whitebox_404_page_function'); 

/*************************/

function default_page_function() {
?>
<div class="whitebox_big whitebox box big_box rounded-corners">
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

<?php
        }
        wp_reset_query();
    }
?>
</div>
<?php
}
add_shortcode('default', 'default_page_function'); 
?>
<?php 

/*************************/

function twitter_users_page() {
    require_once 'Browser.php';
    function is_ie678(){
        $browser = new Browser ();
        switch ($browser->getBrowser()) {
        case Browser::BROWSER_IE:
            if ($browser->getVersion() >= 9) {
                return FALSE;
            } else if ($browser->getVersion() >= 8) {
                return TRUE;
            } else if ($browser->getVersion() >= 7) {
                return TRUE;
            } else if ($browser->getVersion() >= 6) {
                return TRUE;
            } else {
                return TRUE;
            }
            break;
        default:
            return FALSE;
        }
    }
    class TwitterState {
        const START = 0;
        const INIT = 1;
        const AUTH = 2;
        const RESP = 3;
        const ERR = 4;
    }
    $twitter_status = TwitterState::START;
    if (is_ie678()) {
        $enable_see_yourself = false;
    } else {
        $enable_see_yourself = true;
    }
    if ($enable_see_yourself && !empty($_REQUEST['screen_name'])) {
        require_once (dirname(__FILE__)."/tmhOAuth.php");
        $twitter_status = TwitterState::INIT;
        $twitter = new tmhOAuth(array(
            'consumer_key' => 'j3ipoBsLRTURQKsClTw1Q',
            'consumer_secret' => 'c4zwwzhuTJNBWfRzEHKwHY8ESowH2Zb52e3SwjL3kM',
            'user_token' => '169026281-8AagsypAkgOpKPyM5SA8MFTeosfYQ2lMyAEfIfDi',
            'user_secret' => 'oPZgstaEPsQzul2q3d0CVOs096vXd30lMonG7w9c'
        ));
        if ($twitter) {
            $twitter_status = TwitterState::AUTH;
            $code = $twitter->request('GET', $twitter->url('1/users/lookup'), array('screen_name' => $_REQUEST['screen_name']));
            if ($code == 200) {
                $user = json_decode($twitter->response['response']);
                $twitter_status = TwitterState::RESP;
            } else {
                if ($code > 499) {
                    $error = "Something is broken at Twitter right now, please try again in a while";
                } else if ($code == 400) {
                    $error = "There are too many of you! We are being rate limited by Twitter. Please try again in a while";
                } else if ($code == 401) {
                    $error = "I think we might have been blocked by Twitter. Oops!";
                } else if ($code = 404) {
                    $error = "There is no such user. Please check if you've typed your name correctly";
                } else if ($code = 406) {
                    $error = "Twitter returned a \"not acceptable\" error. My God, they're weird ...";
                }
                $twitter_status = TwitterState::ERR;
            }
        } else {
            $error = "Cannot init twitter";
            $twitter_status = TwitterState::ERR;
        }
    }
    echo "<!--".is_ie678()."-->\n";
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            $maxid = 0;
            if ($msql = mysql_connect("localhost", "twats_twats", "tW4Ts!")) {
                if (mysql_select_db("twats_twats", $msql)) {
                    if ($resource = mysql_query("SELECT MAX(`id`) FROM `users`;", $msql)) {
                        if ($row = mysql_fetch_array($resource)) {
                            $maxid = $row[0];
                        }
                    }
                    if ($resource = mysql_query("SELECT `time` FROM `users` WHERE `id`=".$maxid.";", $msql)) {
                        if ($row = mysql_fetch_array($resource)) {
                            $maxtime = $row[0];
                        }
                    }
                    if ($resource = mysql_query("SELECT MIN(`id`) FROM `users`;", $msql)) {
                        if ($row = mysql_fetch_array($resource)) {
                            $minid = $row[0];
                        }
                    }
                    if ($resource = mysql_query("SELECT `time` FROM `users` WHERE `id`=".$minid.";", $msql)) {
                        if ($row = mysql_fetch_array($resource)) {
                            $mintime = $row[0];
                        }
                    }
                }
            }
            ob_start();
            the_content();
            $content = ob_get_contents();
            ob_end_clean();
            if ($enable_see_yourself) {
                $html_to_replace = '<div id="see_yourself_form">';
                $html_to_replace .= empty($error)?'':'<p class="error">'.$error.'</p>';
                $html_to_replace .= '<p>';
                $html_to_replace .= 'Do you want to see where you are on the graph below? Type your twitter name in the box below and submit.';
                $html_to_replace .= '</p>';
                $html_to_replace .= '<form action="' . get_page_link() . '" method="get">';
                $html_to_replace .= '<input type="text" name="screen_name" style="margin-right: 20px;" />';
                $html_to_replace .= '<input type="submit" name="submit_screen_name" value="See Yourself on the Graph" />';
                $html_to_replace .= '</form>';
                $html_to_replace .= '</div>';
                $content = str_replace("[see_yourself]", $html_to_replace, $content);
            } else {
                if (is_ie678()) {
                    $content = str_replace("[see_yourself]", '<p class="error">You are using Internet Explorer. Even worse, you\'re using Internet Explorer 8 or below. If you want to be able to view the content below properly, and see yourself on the graph, please download a real browser. <a href="http://google.co.uk/chrome">Google Chrome</a> is a good choice.</p>', $content);
                } else {
                    $content = str_replace("[see_yourself]", "", $content);
                }
            }
?>
    <div style="display:none;"><?php echo get_page_link(); ?></div>
            <div class="whitebox_big whitebox box rounded-corners big_box">
                <header>
                    <h2 class="din-schrift blue_20"><?php echo $maxid?"Twitter now has ".$maxid." registered users.":"Twitter Users"; ?></h2>
                </header>
                <hr />
<?php echo $content; ?>
            </div><!-- #whitebox_big -->
<?php
            $text_size = 15;
            $width = 1700;
            $height = 1200;
            $margintop = 50;
            $marginbottom = 50;
            $marginleft = 150;
            $marginright = 50;
            $nwidth = 740;
            $nheight = 522;
            $wratio = $nwidth/$width;
            $hratio = $nheight/$height;
            $ntext_size = $text_size * $hratio;
            $nmargintop = $margintop * $hratio;
            $nmarginbottom = $marginbottom * $hratio;
            $nmarginleft = $marginleft * $wratio;
            $nmarginright = $marginright * $wratio;
            if ($twitter_status == TwitterState::RESP) {
                $usery = $nheight - $nmarginbottom - (($user[0]->id - $minid)/($maxid - $minid))*($nheight - $nmarginbottom - $nmargintop);
                $userx = $nmarginleft + ((strtotime($user[0]->created_at) - $mintime)/($maxtime - $mintime))*($nwidth - $nmarginright - $nmarginleft);
?>
                <script>
                var addUser = function(ctx, color, x, y, txtcolor, screen_name) {
                    ctx.fillStyle = color;
                    ctx.fillRect(x - 2, y - 2, 4, 4);
                    ctx.fillStyle = txtcolor;
                    ctx.textBaseline = 'bottom';
                    ctx.textAlign = 'right';
                    ctx.fillText(screen_name, x, y);
                };

                $(document).ready(function() {
                    var graph = new Image();
                    var imgttl = $('.whitebox_big img').attr('title');
                    var imgalt = $('.whitebox_big img').attr('alt');
                    var imgsrc = $('.whitebox_big img').attr('src');
                    var ctx;

                    graph.src = imgsrc;

                    $(graph).load(function () {
                        if ($('#graph').length > 0) {
                            ctx = document.getElementById('graph').getContext('2d');
                            ctx.clearRect(0, 0, <?php echo $nwidth; ?>, <?php echo $nheight; ?>);
                        } else {
                            $('.whitebox_big img').replaceWith('<canvas width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" id="graph"><img alt="' + imgalt + '" src="' + imgsrc + '" title="' + imgttl + '" width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" /></canvas>');
                        $('.whitebox_big img').replaceWith('<canvas width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" id="graph"><img alt="' + imgalt + '" src="' + imgsrc + '" title="' + imgttl + '" width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" /></canvas>');
                            ctx = document.getElementById('graph').getContext('2d');
                        }

                        ctx.drawImage(graph, 0, 0, <?php echo $width; ?>, <?php echo $height; ?>, 0, 0, <?php echo $nwidth; ?>, <?php echo $nheight; ?>);

                        addUser(ctx, "#0b0", <?php echo $userx; ?>, <?php echo $usery; ?>, '#000', '<?php echo $_REQUEST['screen_name']; ?>');
                        addUser(ctx, "#00b", 122.4, 500.2, '#777', 'scobleizer');
                        addUser(ctx, "#00b", 275.2, 486.6, '#777', 'ladygaga');
                        addUser(ctx, "#00b", 339.9, 484.1, '#777', 'dailymirror');
                        addUser(ctx, "#00b", 531.2, 346.0, '#777', 'lord_sugar');
                        addUser(ctx, "#00b", 701.9, 67.76, '#777', 'rupertmurdoch');
                    });
                });
                </script>
<?php
            } else {
?>
                <script>
                var addUser = function(ctx, color, x, y, txtcolor, screen_name) {
                    ctx.fillStyle = color;
                    ctx.fillRect(x - 2, y - 2, 4, 4);
                    ctx.fillStyle = txtcolor;
                    ctx.textBaseline = 'bottom';
                    ctx.textAlign = 'right';
                    ctx.fillText(screen_name, x, y);
                };

                $(document).ready(function() {
                    var graph = new Image();
                    var imgttl = $('.whitebox_big img').attr('title');
                    var imgalt = $('.whitebox_big img').attr('alt');
                    var imgsrc = $('.whitebox_big img').attr('src');
                    var ctx;
                    var graphsize = $('#graph').length;

                    graph.src = imgsrc;

                    $(graph).load(function () {
                        if (graphsize > 0) {
                            ctx = document.getElementById('graph').getContext('2d');
                            ctx.clearRect(0, 0, <?php echo $nwidth; ?>, <?php echo $nheight; ?>);
                        } else {
                            $('.whitebox_big img').replaceWith('<canvas width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" id="graph"><img alt="' + imgalt + '" src="' + imgsrc + '" title="' + imgttl + '" width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" /></canvas>');
                        $('.whitebox_big img').replaceWith('<canvas width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" id="graph"><img alt="' + imgalt + '" src="' + imgsrc + '" title="' + imgttl + '" width="<?php echo $nwidth; ?>" height="<?php echo $nheight; ?>" /></canvas>');
                            ctx = document.getElementById('graph').getContext('2d');
                        }

                        ctx.drawImage(graph, 0, 0, <?php echo $width; ?>, <?php echo $height; ?>, 0, 0, <?php echo $nwidth; ?>, <?php echo $nheight; ?>);

                        addUser(ctx, "#00b", 122.4, 500.2, '#777', 'scobleizer');
                        addUser(ctx, "#00b", 275.2, 486.6, '#777', 'ladygaga');
                        addUser(ctx, "#00b", 339.9, 484.1, '#777', 'dailymirror');
                        addUser(ctx, "#00b", 531.2, 346.0, '#777', 'lord_sugar');
                        addUser(ctx, "#00b", 701.9, 67.76, '#777', 'rupertmurdoch');
                    });
                });
                </script>
<?php
            }
        }
    }
}

add_shortcode('twit_use', 'twitter_users_page');



/*************************** from http://goldenapplesdesign.com/2010/07/03/front-end-file-uploads-in-wordpress/ *******************/

/*function insert_attachment($file_handler,$post_id,$setthumb='false') {
    // check to make sure its a successful upload
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) __return_false();
 
    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');
 
    $attach_id = media_handle_upload( $file_handler, $post_id );
 
    if ($setthumb) update_post_meta($post_id,'_thumbnail_id',$attach_id);
    return $attach_id;
}*/

/***************************** copy/paste from net to track post views as meta **************************/

function setPostViews($postID) {
    $count_key = 'postviews';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 0);
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/***************************** From local functions on old site **************************/

function get_ip () {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function get_post_by_name($page_name) {
    global $wpdb;

    $post = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE `post_name` = '%s' AND `post_type`='post'", $page_name ));
    if ( $post )
        return get_post($post);

    return null;
}

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
