<?php
/*
Template Name: Our Work 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners our_work">
		<div class="content" id="content">
<?php do_shortcode('[bwb_proj]'); ?>
		</div><!-- content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
<script>
    $('a.whitebox_big_nav_item').click(function() {
        if(!$(this).hasClass('active')) {
            $('a.whitebox_big_nav_item.active').removeClass('active');
            $(this).addClass('active');
            var splitPoint = $(this).attr('id').lastIndexOf('_');
            var currentID = $(this).attr('id').substring(splitPoint + 1);
            $('.whitebox_big_category.current').removeClass('current');
            $('#whitebox_big_' + currentID).addClass('current');
        }
    });
    $('.whitebox_big_category_entry_content').hover(function() {
        $(this).find('div').toggleClass('current');
    });
</script>
