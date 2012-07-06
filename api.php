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

require_once(dirname(__FILE__)."/MCAPI.class.php");
$apikey = "38544aba9766e74cc67a07fd3ad16f03-us1";
$api = new MCAPI($apikey);

$campaigns = $api->campaigns();

foreach($campaigns['data'] as $campaign) {
    if ($campaign['title'] == 'The RAAKonteur #92') {
        break;
    }
}

print_r($campaign);

foreach (array('id', 'web_id', 'folder_id', 'create_time', 'send_time', 'status', 'archive_url', 'emails_sent', 'inline_css', 'analytics', 'analytics_tag') as $key) {
    unset($campaign[$key]);
}

$campaign['title'] = "Test title";
$campaign['subject'] = "Test subject";

$retval = $api->campaignCreate('regular', $campaign, array('html' => "<h2 class=\"subTitle\">test Title</h2>"));

if (!$retval) {
    print_r($api);
}

echo "Return value: ".$retval;
?>
