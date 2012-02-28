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
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="1" num_pages="10" ]'); ?>
<?php do_shortcode('[other_posts]'); ?>
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
