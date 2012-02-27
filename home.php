<?php
/*
Template Name:Home 
 */
?>
<?php get_header() ?>

    <div class="container rounded-corners home">
        <div class="content">
<?php do_shortcode('[logo_cta]'); ?>
<?php do_shortcode('[our_work]'); ?>
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="2" num_pages="5" ]'); ?>
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
                            <li><a href="http://wewillraakyou.com/2010/12/klout-is-broken/">Klout is broken</a></li>
                            <li><a href="http://wewillraakyou.com/2010/11/the-perpetually-changing-crowdsourced-raak-logo/">The perpetually changing crowdsourced RAAK logo</a></li>
                            <li><a href="http://wewillraakyou.com/2010/11/edgerank-the-secrets-facebooks-pagerank/">EdgeRank – the secrets of Facebook’s PageRank</a></li>
                            <li><a href="http://wewillraakyou.com/2010/10/mad-mixers-brands-ads-the-importance-of-mixing-paid-earned-media/">Mad Mixers: Brands ads & the importance of mixing paid & earned media</a></li>
                            <li><a href="http://wewillraakyou.com/2010/08/big-society-when-a-poke-becomes-a-nudge/">Big Society: When a Poke becomes a Nudge</a></li>
                        </ul>
                        <footer>
                            <a class="more_link" href="http://wewillraakyou.com/category/must-read/" rel="nofollow">More &#9660;</a>
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
                            <a class="more_link" href="http://wewillraakyou.com/category/worth-a-look/" rel="nofollow">More &#9660;</a>
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
                            <a class="more_link" href="http://wewillraakyou.com/blog/the-raakonteur/" rel="nofollow">More &#9660;</a>
                        </footer>
                    </section><!-- content_three -->
                </div><!-- #whitebox_secondary -->
            </div><!-- tab_container -->
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
