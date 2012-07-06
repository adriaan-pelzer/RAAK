<?php
/*
Template Name: API
 */

$api = create_mc();

$lists = get_lists($api);

echo "Lists\n";
print_r($lists);
echo "API\n";
print_r($api);
?>
