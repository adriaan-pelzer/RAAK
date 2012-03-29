<?php
/*
Template Name:Single Blog 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners blog_single">
		<div class="content" id="content">
<?php do_shortcode('[sb]'); ?>
<?php do_shortcode('[single_post]'); ?>
<?php do_shortcode('[rel_posts]'); ?>
<?php do_shortcode('[cat_box tab1="most-viewed" tab2="category" ]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>

