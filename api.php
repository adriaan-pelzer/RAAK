<?php
/*
Template Name: API
 */

function return_json ($arr) {
    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');
    echo json_encode ($arr);
    die ();
}

/*if (!empty($_GET['apikey'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp API key'));
} else {
    $apikey = $_GET['apikey'];
}

if (!empty($_GET['listid'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp list id'));
} else {
    $listid = $_GET['listid'];
}

if (!empty($_GET['subject'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp subject'));
} else {
    $apikey = $_GET['subject'];
}*/

$api = create_mc();

$lists = get_lists($api);

for ($i = 0; $i < $lists['total']; $i++) {
    echo $lists['data'][$i]['id']." - ".$lists['data'][$i]['name']."<br />\n";
}

$retval = create_mc_campaign($api, '9b809ef490', 'Test letter', 'Test letter title', '<h2 class="subTitle">Hallo hallo</h2>');

echo "Return value: ".$retval;
?>
