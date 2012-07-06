<?php
/*
Template Name: API
 */

$api = create_mc();

$lists = get_lists($api);

print_r($lists);
print_r($api);
?>
