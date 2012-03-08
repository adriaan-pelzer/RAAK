<?php
/*
Template Name: Blog 
 */
?>
<?php get_header() ?>

    <div class="container rounded-corners blog">
        <div class="content">
<?php do_shortcode('[sb]'); ?>
<?php do_shortcode('[latest_posts]'); ?>
            <div class="tab_container bluebox-primary other_posts">
                <div class="blue_tab tab tab108 rounded-corners">
                    <header>
                        <h2>Other Posts</h2>
                    </header>
                </div><!-- blue_tab -->
                <div class="bluebox_primary blog_bluebox_primary bluebox box rounded-corners">
                    <div class="other_posts_content_one">
                        <header>
                            <h3 class="small_arial_caps">Must Reads</h3>
                        </header>
                        <ul>
                            <li><a href="http://wewillraakyou.com/2012/01/tweet-discount-klout-miista/">"Bribing your customers to become brand advocates"</a></li>
                            <li><a href="http://wewillraakyou.com/2010/12/klout-is-broken/">Klout is broken</a></li>
                            <li><a href="http://wewillraakyou.com/2010/11/the-perpetually-changing-crowdsourced-raak-logo/">The perpetually changing crowdsourced RAAK logo</a></li>
                            <li><a href="http://wewillraakyou.com/2010/11/edgerank-the-secrets-facebooks-pagerank/">EdgeRank – the secrets of Facebook’s PageRank</a></li>
                            <li><a href="http://wewillraakyou.com/2010/10/mad-mixers-brands-ads-the-importance-of-mixing-paid-earned-media/">Mad Mixers: Brands ads & the importance of mixing paid & earned media</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/category/must-read/" rel="nofollow">More &#9660;</a>
                        </footer>
                    </div><!-- content_one -->
                    <div class="other_posts_content_two">
                        <header>
                            <h3 class="small_arial_caps">Worth a look</h3>
                        </header>
                        <ul>
                            <li><a href="http://wewillraakyou.com/2011/09/identity-and-location-and-sex-welcome-to-people-discovery/">Identity and location (and sex) - welcome to people discovery </a></li>
                            <li><a href="http://wewillraakyou.com/2011/08/measure-fake-follower-twitter/">Is Newt Gingrich a cheat?</a></li>
                            <li><a href="http://wewillraakyou.com/2011/05/curating-your-own-serendipity-filters/">Curating your own serendipity filters</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/category/worth-a-look/" rel="nofollow">More &#9660;</a>
                        </footer>
                    </div><!-- content_two -->
                    <div class="other_posts_content_three">
                        <header>
                            <h3 class="small_arial_caps">The RAAKonteur</h3>
                        </header>
                        <ul>
                            <li><a href="http://wewillraakyou.com/2012/01/the-raakonteur-69-apple-out-to-smash-textbook-publishing-seo-by-celebrity/">The RAAKonteur #69 - Apple out to smash textbook publishing & SEO by Celebrity</a></li>
                            <li><a href="http://wewillraakyou.com/2012/01/the-raakonteur-68-why-googles-new-personal-search-matters-and-revenge-served-cold/">The RAAKonteur #68 - Why Google's new Personal Search matters, and Revenge served Cold</a></li>
                            <li><a href="http://wewillraakyou.com/2011/12/the-raakonteur-67-we-predict-2012/">The RAAKonteur #67 - We predict 2012</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/category/raakonteur/" rel="nofollow">More &#9660;</a>
                        </footer>
                    </div><!-- content_three -->
                </div><!-- bluebox_primary -->
            </div><!-- bluebox-primary -->
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
