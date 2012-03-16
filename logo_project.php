<?php
/*
Template Name:Logo Project 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners logo_project">
		<div class="content">
<?php
do_shortcode('[wblp]');
do_shortcode('[lplu]');
do_shortcode('[tmplt_dl_b]');
do_shortcode('[upload]');
?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
