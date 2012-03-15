<?php
/*
Template Name:Logo Project 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners logo_project">
		<div class="content">
<?php
do_shortcode('[wblp]');
do_shortcode('[lplu]');
do_shortcode('[tmplt_dl_b]');
?>
            <div class="whitebox-secondary tab_container">
                <div class="multiple_tabs">
                    <header>
                        <div id="letter_upload" class="tab rounded-corners tab112">
                            <h2>Upload a letter</h2>
                        </div>
                        <div id="letter_submit" class="tab rounded-corners tab75">
                            <h2>Submit</h2>
                        </div>
                        <div id="letter_preview" class="tab rounded-corners tab75">
                            <h2>Preview</h2>
                        </div>
                        <div id="letter_finsh" class="tab rounded-corners tab74 active">
                            <h2>Finish</h2>
                        </div>
                    </header>
                </div><!-- multiple_tabs -->
                <div class="whitebox_secondary whitebox box rounded-corners">
                    <form method="post" enctype="multipart/form-data">
                        <section id="whitebox_secondary_upload" style="display: none;">
                            <p>Choose the letter you've designed</p>
                            <div id="whitebox_secondary_upload_letters">
                                <input id="upload_letter" type="hidden" name="upload_letter" value="R" />
                                <span class="letter" id="letter_R"><a><img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/images/ar.jpg" /></a></span>
                                <span class="letter" id="letter_A"><a><img alt="logo a" src="http://wewillraakyou.com/wp-content/themes/RAAK/images/ay1.jpg" /></a></span>
                                <span class="letter" id="letter_K"><a><img alt="logo k" src="http://wewillraakyou.com/wp-content/themes/RAAK/images/kay.jpg" /></a></span>
                            </div>
                            <div id="whitebox_secondary_upload_next">
                                <a class="smaller_arial_caps" >Next &#9658;</a>
                            </div>
                        </section><!-- whitebox_secondary_upload -->
                        <section id="whitebox_secondary_submit" style="display: none;"> 
                            <ul class="smaller_arial_caps">
                                <li id="whitebox_secondary_submit_name">
                                    <label for="upload_name">Your Name</label>
                                    <input id="upload_name" name="upload_name" type="text" maxlength="40" />
                                </li>
                                <li id="whitebox_secondary_submit_email">
                                    <label for="upload_email">Email</label>
                                    <input id="upload_email" name="upload_email" type="text" maxlength="255" />
                                </li>
                                <li id="whitebox_secondary_submit_url">
                                    <label for="upload_url">URL</label>
                                    <input id="upload_url" name="upload_url" type="text" maxlength="255" />
                                </li>
                                <li id="whitebox_secondary_submit_file">
                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                    <label for="upload_file">Browse for file</label>
                                    <div id="file_replace"><input id="upload_file" name="upload_file" type="file" /><p id="dummy_file_text"></p></div>
                                </li>
                                <li id="whitebox_secondary_submit_agree">
                                <label for="upload_agree">I agree to the <a href="http://wewillraakyou.com/logo-project/terms-and-conditions/">terms & conditions</a></label>
                                    <input id="upload_agree" name="upload_agree" type="checkbox" />
                                    <input name="upload_submit" type="submit" value="Submit &#9658;" />
                                </li>
                                <li class="whitebox_secondary_back" id="whitebox_secondary_submit_back">
                                    <a>&#9668; Go back</a>
                                </li>
                            </ul>
                        </section><!-- #whitebox_secondary_submit -->
                        <section id="whitebox_secondary_preview" class="smaller_arial_caps" style="display: none;">
                            <div id="whitebox_secondary_preview_letters">
                                <span id="preview_letter_R"><img alt="logo r" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/a5605d2e128aaa3779904d517d211942.png&amp;width=70&amp;height=82" /></span>
                                <span id="preview_letter_A1"><img alt="logo a" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/45d36d1d36846e6a7210254b7c10b1e0.png&amp;width=70&amp;height=82" /></span>
                                <span id="preview_letter_A2"><img alt="logo a" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/27027cdc0a51f42ce66c576cb4916fa1.png&amp;width=70&amp;height=82" /></span>
                                <span id="preview_letter_K"><img alt="logo k" src="http://wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/94f1cb321eb37b70e6f4a789514aee55.jpg&amp;width=70&amp;height=82" /></span>
                            </div>
                            <div id="whitebox_secondary_preview_submit">
                                <input name="preview_submit" type="submit" value="HAPPY? Then SUBMIT your letter &#9658;" />
                            </div>
                            <div class="whitebox_secondary_back" id="whitebox_secondary_preview_back">
                                <a>&#9668; Go back</a>
                            </div>
                        </section><!-- #whitebox_secondary_preview -->
                        <section id="whitebox_secondary_finish">
                            <p class="big_and_bold">THANKS for taking part!</p>
                            <p>Your letter is now part of the loop.</p>
                            <button id="again">Upload another letter</button>
                        </section><!-- #whitebox_secondary_finish -->
                    </form>
                </div><!-- whitebox_secondary -->
            </div><!-- whitebox_secondary -->
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
