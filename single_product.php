<?php
/*
Template Name Posts: Single Product
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners single_product">
		<div class="content">
<?php do_shortcode('[sp_wb]'); ?>
<?php do_shortcode('[sp_bb]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
