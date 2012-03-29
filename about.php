<?php
/*
Template Name: About
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners about">
		<div class="content" id="content">
<?php do_shortcode('[who_what]'); ?>
<?php do_shortcode('[quotes]'); ?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
<script>
    $('.about_nav a').click(function() {
        if(!$(this).hasClass('active')) {
            $('.about_nav a.active').removeClass('active');
            $('.about_content.current').removeClass('current');
            $('.bluebox_container.current').removeClass('current');
            var current_id = $(this).html().toLowerCase();
            $('.about_bluebox h3').html(current_id);
            current_id = current_id.replace(/ /g , '-');
            $('#' + current_id).addClass('current');
            $('#bluebox_content_' + current_id).addClass('current');
            if (current_id === 'what-we-do') {
                if (!($('#twitter_raakonteurs').hasClass('current'))) {
                    $('#twitter_raakonteurs').addClass('current');
                }
            }
            $(this).addClass('active');
        }
    });
    $('#who-we-are nav a').click(function() {
        if(!$(this).hasClass('active')) {
            $('#who-we-are nav a.active').removeClass('active');
            $('.whitebox_primary_content_founder.current').removeClass('current');
            $('.founder_quotes .bluebox_content_item.current').removeClass('current');
            var current_id = $(this).html().toLowerCase();
            current_id = current_id.replace(/ /g , '-');
            $('#whitebox_primary_content_' + current_id).addClass('current');
            $('#bluebox_content_' + current_id).addClass('current');
            console.log(current_id);
            if($('#twitter_' + current_id).length) {
                $('.twitter.current').removeClass('current');
                $('#twitter_' + current_id).addClass('current');
            } else if (!($('#twitter_raakonteurs').hasClass('current'))) {
                $('#twitter_raakonteurs').addClass('current');
            }
            $(this).addClass('active');
        }
    });
</script>
