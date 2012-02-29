<?php
/*
Template Name: About
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners about">
		<div class="content">
<?php do_shortcode(['who_what']); ?>
            <aside class="bluebox bluebox_primary box rounded-corners">
                <header>
                    <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps">What we do</h3>
                </header>
                <hr class="blue_hr" />
                <div id="bluebox_content_what-we-do" class="bluebox_content_item">
                    If advertising is a tax on mediocrity, you've come to a tax free zone.
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_adriaan" class="bluebox_content_item" style="display: none;">
                    I dream code.<br />I write machine poetry, that makes electrons dance.<br />
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_wessel" class="bluebox_content_item" style="display: none;">
                    I breathe media.<br />I inhale news and exhale content.<br />Marked up, tagged and loaded.
                </div><!-- bluebox_content_item -->
                <div id="bluebox_content_gerrie" class="bluebox_content_item" style="display: none;">
                    I'm intrigued by innovation.<br />Not very interested in the status quo.<br />
                </div><!-- bluebox_content_item -->
            </aside><!-- #bluebox -->
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
