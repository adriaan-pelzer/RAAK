<?php
/*
Template Name:Logo Archive 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners logo_archive">
		<div class="content" id="content">
<?php do_shortcode('[logo_archive]'); ?>
		</div><!-- content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
<script>
    $('#bluebox_big_nav a').click(function() {
        if((!$(this).hasClass('active')) && ($(this).attr('id') !== 'bluebox_big_nav_back')) {
            $('#bluebox_big_nav a.active').removeClass('active');
            var splitPoint = $(this).attr('id').lastIndexOf('_');
            var selectedID = $(this).attr('id').substring(splitPoint + 1);
            $('.bluebox_big_content.current').removeClass('current');
            $('#bluebox_big_content_' + selectedID).addClass('current');
            $(this).addClass('active');
        }
    });
</script>
