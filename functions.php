<?php
function logo_call_to_action() {
    $logo_story = get_page_by_title('The perpetually changing crowdsourced RAAK logo', 'OBJECT', 'post');
    $logo_project = get_page_by_title('Logo Project');
    $logo_container = '<aside id="logox_counter" class="rounded-corners din-schrift">
    <span class="point_left"></span>
    <span class="point_right"></span>
    <header>
        <h2># OF LOGO COMBINATIONS</h2>
    </header>
    <div id="logox_counter_number">7744</div>
    <a id="read_the_logo_story" href="' . get_permalink($logo_story->ID) . '">Read the story behind our logo</a>
    <hr>
    <a id="upload_a_letter" href="' . get_permalink($logo_project->ID) . '">Upload a letter</a>
    </aside>';
    return $logo_container;
}

add_shortcode('logo_cta', 'logo_call_to_action');

?>
