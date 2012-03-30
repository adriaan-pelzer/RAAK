<?php
/*
Template Name: Our Products 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners our_products">
		<div class="content" id="content">
<?php do_shortcode('[bwb_prod]'); ?>
		</div><!-- content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
<script>
    $('.whitebox_big_category_entry_content').hover(function() {
        $(this).find('.whitebox_big_category_entry_content_picture').removeClass('current')
        $(this).find('.whitebox_big_category_entry_content_overview').addClass('current');
        //$(this).find('div').toggleClass('current');
    },
        function() {
        $(this).find('.whitebox_big_category_entry_content_overview').removeClass('current');
        $(this).find('.whitebox_big_category_entry_content_picture').addClass('current');
    });
</script>
