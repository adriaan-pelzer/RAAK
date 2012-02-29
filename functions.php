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
    $what_we_do = get_page_by_title('What we do');
    $who_we_are = get_page_by_title('Who we are');
?>
<div class="whitebox whitebox_primary whitebox-primary box rounded-corners">
                <header>
                    <nav class="whitebox_primary_nav smaller_arial_caps box_nav">
                        <a class="active">What we do</a><span class="seperator seperator_smaller">|</span><a>Who we are</a>
                    </nav><!-- whitebox_primary_nav -->
                    <h2 class="din-schrift blue_20">About</h2>
                </header>
                <hr>
                <div id="what-we-do" class="whitebox_primary_content" style="display: none;">
<?php echo $what_we_do->post_content; ?>
                </div><!-- whitebox_primary_content -->
                <div id="who-we-are" class="whitebox_primary_content">
                    <div class="whitebox_primary_content_nav smaller_arial_caps box_nav">
<?php
    $who_we_are_query = new WP_Query('post_parent=' . $who_we_are->ID . '&post_type=page');
    print_r ($who_we_are_query);
    foreach($who_we_are_query->posts as $founder_num -> $founder) {
        while($founder->have_posts()) {
            $founder->the_post();
?>

                        <?php echo ($founder_num != 0) ? '<span class="seperator seperator_smaller">|</span>' : ''; ?><a id="whitebox_primary_content_nav_gerrie" class="whitebox_primary_content_nav_item active" ><?php the_title(); ?></a>
<?php
        }
    }
?>
                        <span class="seperator seperator_smaller">|</span>
                        <a id="whitebox_primary_content_nav_wessel" class="whitebox_primary_content_nav_item" onclick="javascript: expand_person('wessel');">Wessel van Rensburg</a>
                        <span class="seperator seperator_smaller">|</span>
                        <a id="whitebox_primary_content_nav_adriaan" class="whitebox_primary_content_nav_item" onclick="javascript: expand_person('adriaan');">Adriaan Pelzer</a>
                    </div><!-- whitebox_primary_content_nav -->
                    <hr class="solid">
                    <section id="whitebox_primary_content_adriaan" class="whitebox_primary_content_founder">
                        <div class="whitebox_primary_content_founder_info smaller_arial_caps box_nav">
                            <div class="whitebox_primary_content_founder_name">Adriaan Pelzer</div>
                            <div class="whitebox_primary_content_founder_social">
                                <div class="whitebox_primary_content_founder_social_title">Follow me…</div>
                                <div class="whitebox_primary_content_founder_social_right"> 
                                    <div class="whitebox_primary_content_founder_social_network social_linkedin">
                                        <span class="whitebox_primary_content_founder_social_linkedin_icon"><a href="http://za.linkedin.com/pub/adriaan-pelzer/4/874/860"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/linked_in_icon.png" alt="LinkedIn"></a></span>
                                        <span class="whitebox_primary_content_founder_social_linkedin_text"><a href="http://za.linkedin.com/pub/adriaan-pelzer/4/874/860">Linked In</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_linkedin -->
                                    <div class="whitebox_primary_content_founder_social_network social_facebook">
                                        <span class="whitebox_primary_content_founder_social_facebook_icon"><a href="http://www.facebook.com/adriaan.pelzer"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/facebook_icon.png" alt="Facebook"></a></span>
                                        <span class="whitebox_primary_content_founder_social_facebook_text"><a href="http://www.facebook.com/adriaan.pelzer">Facebook</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_facebook -->
                                    <div class="whitebox_primary_content_founder_social_network social_twitter">
                                        <span class="whitebox_primary_content_founder_social_twitter_icon"><a href="http://www.twitter.com/adriaan_pelzer"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/twitter_icon.png" alt="Twitter"></a></span>
                                        <span class="whitebox_primary_content_founder_social_twitter_text"><a href="http://www.twitter.com/adriaan_pelzer">Twitter</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_twitter -->
                                </div><!-- whitebox_primary_content_founder_social_right -->
                            </div><!-- whitebox_primary_content_founder_social -->
                        </div><!-- whitebox_primary_content_founder_info -->
                        <div class="whitebox_primary_content_founder_picture">
                            <img title="Adriaan Pelzer - Creative technologist" src="http://www.wewillraakyou.com/wp-content/uploads/2010/07/Last-12-Months-11-259x300.jpg" alt="Adriaan Pelzer - Creative technologist" width="200" height="232">
                            <!--img alt="Adriaan Pelzer" src="http://test.wewillraakyou.com/wp-content/uploads/2010/07/Last-12-Months-11.jpg" /-->
                        </div><!-- whitebox_primary_content_founder_picture -->
                        <hr class="solid">
                        <div class="whitebox_primary_content_founder_text">
                            
<p>Adriaan is RAAK's Technical Dude. Creative Technical Dude that is.</p>

<p>He studied electronic engineering at the University of Pretoria in South Africa, after which he started his professional career installing mobile subsystems on site for Vodacom, Ericsson and Siemens in South Africa and Botswana during the mobile boom in late 90s Southern Africa.</p>

<p>In 2000 Adriaan started working first as a QA engineer and later as a software developer at a Cryptographic Software house called Trispen Technologies. With his wife, Mareli, Adriaan started up sound studio &amp; video production house PIT Productions, which, amongst others, produced two TV series for South African TV. One of them, Kompleks, was quite a bit of a cult hit.</p>

<p>Adriaan also fronts the South African Industrial Metal band NuL.</p>

<p>In the last few years Adriaan has developed an extensive knowledge of web technologies, especially everything surrounding Social Media. That ranges from API implementations to iPhone apps and building 12,000 lines of bespoke PHP code for a social network.</p>

<p>Add to that his talent for thinking creatively and you have, well, a Creative Technical Dude.</p>
                        </div><!-- .whitebox_primary_content_founder_text -->
                    </section><!-- whitebox_primary_content_founder -->
                    <section id="whitebox_primary_content_wessel" class="whitebox_primary_content_founder" style="display: none;">
                        <div class="whitebox_primary_content_founder_info smaller_arial_caps box_nav">
                            <div class="whitebox_primary_content_founder_name">Wessel van Rensburg</div>
                            <div class="whitebox_primary_content_founder_social">
                                <div class="whitebox_primary_content_founder_social_title">Follow me…</div>
                                <div class="whitebox_primary_content_founder_social_right"> 
                                    <div class="whitebox_primary_content_founder_social_linkedin">
                                        <span class="whitebox_primary_content_founder_social_linkedin_icon"><a href="http://uk.linkedin.com/in/wesselvanrensburg"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/linked_in_icon.png" alt="LinkedIn"></a></span>
                                        <span class="whitebox_primary_content_founder_social_linkedin_text"><a href="http://uk.linkedin.com/in/wesselvanrensburg">Linked In</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_linkedin -->
                                    <div class="whitebox_primary_content_founder_social_twitter">
                                        <span class="whitebox_primary_content_founder_social_twitter_icon"><a href="http://twitter.com/wildebees"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/twitter_icon.png" alt="Twitter"></a></span>
                                        <span class="whitebox_primary_content_founder_social_twitter_text"><a href="http://twitter.com/wildebees">Twitter</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_twitter -->
                                </div><!-- whitebox_primary_content_founder_social_right -->
                            </div><!-- whitebox_primary_content_founder_social -->
                        </div><!-- whitebox_primary_content_founder_info -->
                        <div class="whitebox_primary_content_founder_picture">
                            <img title="Wessel van Rensburg - Social media strategist" src="http://www.wewillraakyou.com/wp-content/uploads/2009/06/Wessel-259x300.jpg" alt="" width="200" height="232">
                            <!--img alt="Wessel van Rensburg" src="" /-->
                        </div><!-- whitebox_primary_content_founder_picture -->
                        <hr class="solid">
                        <div class="whitebox_primary_content_founder_text">
                            

<p>Wessel has more than 12 years experience as digital strategist, product development manager and consultant.

</p><p>His love affair with media started when a rightwing nutter &amp; his senior at university residence, warned him of the evils of the local lefty student newspaper. Wessel joined said paper the next day.</p>

<p>After becoming editor of said paper, and completing a law degree he was honoured to be appointed an investigator for the historic South African Truth and Reconciliation Commission.</p>

<p>But Wessel loved media, and he left South Africa to do a masters degree in Hypermedia in London. He programmed interactive multi-media toys in Macromedia Director and learned about virtual communities and the history of the computing, media and telecoms industry.</p>
<p>
He was part of the dot.com excitement and ultimately its bust after being hired by internet start-up eCountries.com.</p>
<p>
But he survived the experience all the better for it. And for the next 5 years served as Lycos Europe Senior Mobile Producer, Product Manager and Manager of New Product Development Manager respectively. Here he managed the UK's largest youth orientated mobile community website, and brought numerous products to market. Including a blogging platform and LycosIQ, a knowledge sharing community.</p>
<p>
Since then Wessel has been consulting on new and particular social media for organisations like the World Economic Forum (WEF).</p>
<p>
That's until he and Gerrie founded RAAK.</p>
<p>
Wessel also makes documenatries in his spare time and keeps a popular blog on South African politics and culture.</p>
                        </div><!-- .whitebox_primary_content_founder_text -->
                    </section><!-- whitebox_primary_content_founder -->
                    <section id="whitebox_primary_content_gerrie" class="whitebox_primary_content_founder" style="display: none;">
                        <div class="whitebox_primary_content_founder_info smaller_arial_caps box_nav">
                            <div class="whitebox_primary_content_founder_name">Gerrie Smits</div>
                            <hr>
                            <div class="whitebox_primary_content_founder_social">
                                <div class="whitebox_primary_content_founder_social_title">Follow me…</div>
                                <div class="whitebox_primary_content_founder_social_right"> 
                                    <div class="whitebox_primary_content_founder_social_linkedin">
                                        <span class="whitebox_primary_content_founder_social_linkedin_icon"><a href="http://uk.linkedin.com/in/gerriesmits"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/linked_in_icon.png" alt="LinkedIn"></a></span>
                                        <span class="whitebox_primary_content_founder_social_linkedin_text"><a href="http://uk.linkedin.com/in/gerriesmits">Linked In</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_linkedin -->
                                    <div class="whitebox_primary_content_founder_social_twitter">
                                        <span class="whitebox_primary_content_founder_social_twitter_icon"><a href="http://twitter.com/grrRAAK"><img src="http://wewillraakyou.com/wp-content/themes/RAAK/images/twitter_icon.png" alt="Twitter"></a></span>
                                        <span class="whitebox_primary_content_founder_social_twitter_text"><a href="http://twitter.com/grrRAAK">Twitter</a></span>
                                    </div><!-- whitebox_primary_content_founder_social_twitter -->
                                </div><!-- whitebox_primary_content_founder_social_right -->
                            </div><!-- whitebox_primary_content_founder_social -->
                        </div><!-- whitebox_primary_content_founder_info -->
                        <div class="whitebox_primary_content_founder_picture">
                            <img title="Gerrie Smits - RAAK founder" src="http://www.wewillraakyou.com/wp-content/uploads/2009/06/Last-12-Months-0-259x300.jpg" alt="Gerrie Smits - RAAK founder" width="200" height="232">
                            <!--img alt="Gerrie Smits" src="" /-->
                        </div><!-- whitebox_primary_content_founder_picture -->
                        <hr class="solid">
                        <div class="whitebox_primary_content_founder_text">
                            

<p>Gerrie started his media career as a music journalist known for his discerning taste and disarming prose.</p>

<p>He had studied visual communication, so when opportunity beckoned with MTV it was a natural next step up. That step turned into a 7-year career that encompassed script writing and early experiments with nascent interactive TV to launching new local channels.</p>

<p>He then founded Pixelspew, a production company that soon developed into a creative agency. It curated mobile content, conceptualised virals, creative-directed tv campaigns, directed music videos and repositioned tv &amp; internet channels.</p>

<p>Still, it wasn't enough. Aware of the massive changes in media and intrigued by innovation, Gerrie was restless. The emerging power of what was being labeled Web 2.0 was a confirmation of a lot of the principles and ways of doing media that Gerrie had come to do. Things like the importance of authenticity in media and truly remarkable content.</p>

<p>So what if one could combine the interactive communications capabilities of new digital media with the narrative skills of old media he thought?</p>

<p>After many caffeine and pint fueled discussions over the course of a year it became obvious. He and <a title="Wessel van Rensburg" href="/about/the-founders/wessel-van-rensburg/">WVR</a> would put their combined media skills under one roof.</p>
                        </div><!-- .whitebox_primary_content_founder_text -->
                    </section><!-- whitebox_primary_content_founder -->
                </div><!-- whitebox_primary_content -->
            </div>

<?php
}

add_shortcode('who_what', 'who_we_are_what_we_do'); 

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
