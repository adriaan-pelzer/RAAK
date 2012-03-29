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
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" colourscheme="blue" ]'); ?>
<?php do_shortcode('[cat_box tab1="most-viewed" tab2="category" ]'); ?>
        </div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
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
