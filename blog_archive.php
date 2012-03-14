<?php
/*
Template Name: Blog Archive 
 */
?>
<?php get_header() ?>

    <div class="container rounded-corners blog_archive">
        <div class="content">
<?php do_shortcode('[title]'); ?>
<?php do_shortcode('[archive_list]'); ?>
<?php do_shortcode('[tags]'); ?>
<?php do_shortcode('[authors]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
