<?php
/*
Template Name: Tag Archive
 */
?>
<?php get_header(); ?>

    <div class="container rounded-corners blog_archive">
        <div class="content">
<?php print_r($_POST); ?>
<?php do_shortcode('[tag_title]'); ?>
<?php do_shortcode('[archive_list]'); ?>
<?php do_shortcode('[tags]'); ?>
            <div class="whitebox-secondary tab_container">
                <div class="blue_tab tab tab108 rounded-corners">
                    <header>
                        <h2>Authors</h2>
                    </header>
                </div><!-- blue_tab -->
                <div class="whitebox_secondary blog_whitebox_secondary whitebox box rounded-corners">
                    <ul>
                        <!--li></li-->      
                        <li><a href="http://wewillraakyou.com/author/adriaan/">Adriaan Pelzer</a></li>      
                        <!--li></li-->      
                        <li><a href="http://wewillraakyou.com/author/gerrie/">Gerrie Smits</a></li>      
                        <!--li></li-->      
                        <li><a href="http://wewillraakyou.com/author/wessel/">Wessel van Rensburg</a></li>      
                    </ul>
                </div><!-- whitebox_secondary -->
            </div><!-- whitebox-secondary -->
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
