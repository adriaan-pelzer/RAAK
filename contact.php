<?php
/*
Template Name: Contact 
 */
?>
<?php get_header() ?>


	<div class="container rounded-corners contact">
		<div class="content">
<?php do_shortcode('[contactwb]'); ?>
            <div class="bluebox bluebox_primary box rounded-corners">
                <header>
                    <h3 class="box_nav_no_title bluebox_primary_nav box_nav smaller_arial_caps" id="bluebox_title">Where we are</h3><!--span id="bluebox_title_print"><a href="">Print</a></span><span class="blue"><a href="">&#9658;</a></span-->
                </header>
                <div id="bluebox_print">
                </div>
                <hr />
                <div id="bluebox_map">
                    <a target="_blank" href="http://maps.google.com/maps?hl=en&q=51.539,-0.0554&ie=UTF8&z=14"><!--img id="gimg" src="http://maps.google.com/maps/api/staticmap?center=51.539,-0.0554&zoom=14&size=315x315&sensor=false" /--><img alt="map to RAAK" id="gimg" src="http://wewillraakyou.com/wp-content/themes/RAAK/images/map.png" /></a>
                </div>
            </div><!-- bluebox -->
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
