<?php
function logo_call_to_action() {
    $logo_container = '<aside id="logox_counter" class="rounded-corners din-schrift">
    <span class="point_left"></span>
    <span class="point_right"></span>
    <header>
        <h2># OF LOGO COMBINATIONS</h2>
    </header>
    <div id="logox_counter_number">7744</div>
    <a id="read_the_logo_story" href="http://wewillraakyou.com/2010/11/the-perpetually-changing-crowdsourced-raak-logo/">Read the story behind our logo</a>
    <hr>
    <a id="upload_a_letter" href="http://wewillraakyou.com/wp-content/themes/RAAK/logo-project/">Upload a letter</a>
    </aside>';
    return $logo_container;
}

add_shortcode('logo_call_to_action', 'logo_call_to_action');

?>
