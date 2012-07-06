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

/*if (empty($_GET['apikey'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp API key'));
} else {
    $apikey = $_GET['apikey'];
}

if (empty($_GET['title'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp title'));
} else {
    $title = $_GET['title'];
}

if (empty($_GET['subject'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp subject'));
} else {
    $subject = $_GET['subject'];
}*/

if (empty($_GET['pid'])) {
    return_json(array('code' => -1, 'error' => 'Please specify a mailchimp postid'));
} else {
    $postid = $_GET['pid'];
}

$post = get_post($pid);
print_r($post);
$content = $post->post_content;

require_once(dirname(__FILE__)."/MCAPI.class.php");
$apikey = "38544aba9766e74cc67a07fd3ad16f03-us1";
$api = new MCAPI($apikey);

$campaigns = $api->campaigns();

foreach($campaigns['data'] as $campaign) {
    if ($campaign['title'] == 'The RAAKonteur #92') {
        break;
    }
}

foreach (array('id', 'web_id', 'folder_id', 'create_time', 'send_time', 'status', 'archive_url', 'emails_sent', 'inline_css', 'analytics', 'analytics_tag') as $key) {
    unset($campaign[$key]);
}

preg_match("/(The RAAKonteur #\d+)/", $post->post_title, $matches);
print_r($matches);
die();
$campaign['title'] = $post->post_title;
$campaign['subject'] = $post->post_title;

$retval = $api->campaignCreate('regular', $campaign, array('html_main' => $content, 'html_header' => "Test Header", 'text' => ""));

if (!$retval) {
    return_json(array('code' => -1, 'error' => $api->errorMessage));
}

return_json(array('code' => 0, 'id' => $retval));
?>
