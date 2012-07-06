<?php
/*
Template Name: API
 */
get_header();

$api = create_mc();

$lists = get_lists($api);

echo "Lists\n";
//print_r($lists);
echo "API\n";
//print_r($api);
get_footer();
?>
