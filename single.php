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
<script>
    $('.whitebox-secondary .multiple_tabs .tab').click(function() {
        if (!$(this).hasClass('active')) {
            $('.whitebox-secondary .multiple_tabs .tab.active').removeClass('active');
            var currentID = $(this).attr('id');
            $('.whitebox_secondary_item.current').removeClass('current');
            $('#whitebox_secondary_item_' + currentID).addClass('current');
            $(this).addClass('active');
        }
    });
</script>
<?php get_footer() ?>
