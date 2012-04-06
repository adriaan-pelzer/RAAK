<?php
/*
Template Name: Contact 
 */
?>
<?php get_header() ?>


	<div class="container rounded-corners contact">
		<div class="content" id="content">
<?php do_shortcode('[basic_wb page="contact"]'); ?>
<?php do_shortcode('[contactbb]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
