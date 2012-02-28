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
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="20" num_pages="1" ]'); ?>
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" ]'); ?>
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
