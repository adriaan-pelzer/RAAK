<?php
/*
Template Name: About
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners about">
		<div class="content">
<?php do_shortcode('[who_what]'); ?>
<?php do_shortcode('[quotes]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
