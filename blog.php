<?php
/*
Template Name: Blog 
 */
?>
<?php get_header() ?>

    <div class="container rounded-corners blog">
        <div class="content" id="content">
<?php do_shortcode('[sb]'); ?>
<?php do_shortcode('[latest_posts category="Blog" posts_per_page="2" num_pages="10" tab="0" ]'); ?>
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" colourscheme="blue" qty1=5 qty2=3 ]'); ?>
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
<?php get_footer() ?>
