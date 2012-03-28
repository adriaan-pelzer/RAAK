<?php
/*
Template Name Posts: Single Project
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
<script>
    $('.bluebox_bigpic').html('<img width="315" height="203" title="' + $('.ngg-gallery-thumbnail a img').first().attr('title') + '" alt="' + $('.ngg-gallery-thumbnail a img').first().attr('alt') + '" src="' + $('.ngg-gallery-thumbnail a').first().attr('href') + '">');
    $('.ngg-gallery-thumbnail a').click(function(event){
        event.preventDefault();
    });
    $('.ngg-gallery-thumbnail a').mouseover(function() {
        $('.bluebox_bigpic').html('<img width="315" height="203" title="' + $(this).find('img').attr('title') + '" alt="' + $(this).find('img').attr('alt') + '" src="' + $(this).attr('href') + '">');
    });
</script>
