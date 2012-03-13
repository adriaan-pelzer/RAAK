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
<?php do_shortcode('[cat_box tab1="mostviewed" tab2="category"]'); ?>
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
