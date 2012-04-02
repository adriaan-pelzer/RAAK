<?php get_header() ?>
    <div class="container rounded-corners blog_archive">
        <div class="content" id="content">
<?php do_shortcode('[sb]'); ?>
<?php do_shortcode('[wb_404]'); ?>
<?php do_shortcode('[other_posts category1="Must Read" category2="Worth a look" category3="RAAKonteur" colourscheme="blue" ]'); ?>
<?php do_shortcode('[cat_box tab1="most-viewed" tab2="category" ]'); ?>
        </div><!-- #content -->
        <?php get_sidebar() ?>
<?php get_footer() ?>
