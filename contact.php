<?php
/*
Template Name: Contact 
 */
?>
<?php get_header() ?>


	<div class="container rounded-corners about">
		<div class="content">
            <section class="whitebox whitebox_primary whitebox-primary box rounded-corners">
                <header>
                    <h2 class="din-schrift blue_20">Contact</h2>
                </header>
                <hr />
                <div class="whitebox_primary_content">
                    <address>
                        RAAK LTD<br />
                        45a Tudor Road<br />
                        Unit 2<br />
                        London E9 7SN<br />
                        <span class="blue">t</span> +44 20 8986 5115<br />
                        <span class="blue">e</span> <a href="mailto:hello@wewillraakyou.com">hello@wewillraakyou.com</a>
                    </address>
                    <hr class="solid" />
                    <p>Alternatively just complete this form</p>
                    <div class="wpcf7" id="wpcf7-f1-p341-o1">
                        <form action="/contact/#wpcf7-f1-p341-o1" method="post" class="wpcf7-form">
                            <div style="display: none;">
                                <input type="hidden" name="_wpcf7" value="1" />
                                <input type="hidden" name="_wpcf7_version" value="2.3.1" />
                                <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f1-p341-o1" />
                            </div>
                        <p>
                            Your Name (required)<br /><span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" class="wpcf7-text wpcf7-validates-as-required" size="40" /></span> </p>
                        <p>Your Email (required)<br />
                            <span class="wpcf7-form-control-wrap your-email"><input type="text" name="your-email" value="" class="wpcf7-text wpcf7-validates-as-email wpcf7-validates-as-required" size="40" /></span> </p>
                        <p>Subject<br />
                            <span class="wpcf7-form-control-wrap your-subject"><input type="text" name="your-subject" value="" class="wpcf7-text" size="40" /></span> </p>
                        <p>Your Message<br />
                            <span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10"></textarea></span> </p>
                        <p id="contact_submit"><input type="submit" value="Send" class="wpcf7-submit" /><img class="ajax-loader" style="visibility: hidden;" alt="Sending ..." src="http://wewillraakyou.com/wp-content/plugins/contact-form-7/images/ajax-loader.gif" /></p>
                        <div class="wpcf7-response-output wpcf7-display-none"></div></form></div>
                </div><!-- .whitebox_primary_content -->
            </section><!-- whitebox_primary -->
            <section class="bluebox bluebox_primary box rounded-corners">
                <header>
                    <h3 class="box_nav_no_title bluebox_primary_body_nav box_nav smaller_arial_caps" id="bluebox_title">Where we are</h3><!--span id="bluebox_title_print"><a href="">Print</a></span><span class="blue"><a href="">&#9658;</a></span-->
                </header>
                <div id="bluebox_print">
                </div>
                <hr />
                <div id="bluebox_map">
                    <a target="_blank" href="http://maps.google.com/maps?hl=en&q=51.539,-0.0554&ie=UTF8&z=14"><!--img id="gimg" src="http://maps.google.com/maps/api/staticmap?center=51.539,-0.0554&zoom=14&size=315x315&sensor=false" /--><img alt="map to RAAK" id="gimg" src="http://wewillraakyou.com/wp-content/themes/RAAK/images/map.png" /></a>
                </div>
            </section><!-- bluebox -->
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
