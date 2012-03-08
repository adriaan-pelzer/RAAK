<?php
/*
Template Name: Blog 
 */
?>
<?php get_header() ?>

    <div class="container rounded-corners blog">
        <div class="content">
<?php do_shortcode('[sb]'); ?>
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="2" num_pages="10" tab="0" ]'); ?>
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" colourscheme="blue" ]'); ?>
            <div class="whitebox-secondary tab_container">
                <div class="multiple_tabs">
                    <header>
                        <div class="tab rounded-corners tab108">
                            <h3><a onclick="javascript: expand('mostviewed');">Most Viewed</a></h3>
                        </div>
                        <div class="tab rounded-corners tab108 active">
                            <h3><a onclick="javascript: expand('category');">Category</a></h3>
                        </div>
                    </header>
                </div><!-- multiple_tabs -->
                <div class="whitebox_secondary blog_whitebox_secondary whitebox box rounded-corners">
                    <div id="whitebox_secondary_mostviewed" style="display: none">
                        <ul>
                            <li><a href="http://wewillraakyou.com/2010/12/klout-is-broken/">Klout is broken</a></li>
                            <li><a href="http://wewillraakyou.com/2011/06/google-plusone-button-howto/">How to add a Google +1 button to your website</a></li>
                            <li><a href="http://wewillraakyou.com/2010/02/the-answer-to-die-antwoords-marketing-social-media/">The answer to Die Antwoord's marketing success</a></li>
                            <li><a href="http://wewillraakyou.com/2010/07/facebook-extended-permissions-theyre-not-as-bad-as-you-think-they-are/">Facebook Extended Permissions – they're not as bad as you think they are</a></li>
                            <li><a href="http://wewillraakyou.com/2011/06/twitter-steals-devnest/">Twitter eats its Babies</a></li>
                            <li><a href="http://wewillraakyou.com/2010/10/how-do-url-shorteners-work/">How do URL shorteners work?</a></li>
                        </ul>
                    </div><!-- #whitebox_secondary_mostviewed -->
                    <div id="whitebox_secondary_category">
                        <ul>
                            <li><a href="<?php echo get_page_link(5245); ?>">Inspiration</a></li>
                            <li><a href="http://wewillraakyou.com/category/Must%20Read/">Must Read</a></li>
                            <li><a href="http://wewillraakyou.com/category/RAAKonteur/">RAAKonteur</a></li>
                            <li><a href="http://wewillraakyou.com/category/Worth%20a%20look/">Worth a look</a></li>
                        </ul>
                    </div><!-- #whitebox_secondary_category -->
                </div><!-- whitebox_secondary -->
            </div><!-- whitebox-secondary -->
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
