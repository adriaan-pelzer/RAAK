<?php
/*
Template Name: theraakonteur
*/
?>
<?php get_header() ?>
	<div class="container rounded-corners">
		<div class="content" id="content">
<?php do_shortcode('[title page_type="theraakonteur"]'); ?>
<?php do_shortcode('[raak_wb]'); ?>
<?php do_shortcode('[raak_bb]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
