<?php
/*
Template Name: Contact 
 */
?>
<?php get_header() ?>


	<div class="container rounded-corners contact">
		<div class="content">
<?php do_shortcode('[contactwb]'); ?>
<?php do_shortcode('[contactbb]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
