<?php
/*
Template Name:Home 
 */
?>
<?php get_header(); ?>

    <div class="container rounded-corners home">
        <div class="content" id="content">
<?php do_shortcode('[logo_cta]'); ?>
<?php do_shortcode('[our_work]'); ?>
<?php our_products(); ?>
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="2" num_pages="10" tab="1" ]'); ?>
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" colourscheme="white" ]'); ?>
        </div><!-- #content -->
<?php get_sidebar(); ?>
<script>
    $('.our_work_nav h3 a').click(function() {
        if(!$(this).hasClass('active')) {
            $('.our_work_nav h3 a.active').removeClass('active');
            $('.bluebox_cat_container.current').removeClass('current');
            var current_class = $(this).attr('class');
            $('#bluebox_cat_' + current_class).addClass('current');
            $(this).addClass('active');
        } 
    });
    $('.pagination .previous').click(function() {
        if (($('.whitebox_primary_post.current').next('div').length) !== 0) {
            $('.whitebox_primary_post.current').removeClass('current').next('div').addClass('current');
            if (($('.whitebox_primary_post.current').prev('div').length) !== 0) {
                $('.pagination .next').addClass('active');
            }
            if (($('.whitebox_primary_post.current').next('div').length) === 0) {
                $('.pagination .previous').removeClass('active');
            }
        }
    });
    $('.pagination .next').click(function() {
        if (($('.whitebox_primary_post.current').prev('div').length) !== 0) {
            $('.whitebox_primary_post.current').removeClass('current').prev('div').addClass('current');
            if (($('.whitebox_primary_post.current').next('div').length) !== 0) {
                $('.pagination .previous').addClass('active');
            }
            if (($('.whitebox_primary_post.current').prev('div').length) === 0) {
                $('.pagination .next').removeClass('active');
            }
        }
    });
</script>
<?php get_footer(); ?>
