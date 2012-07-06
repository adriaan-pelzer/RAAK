<?php
/*
Template Name: API
 */

$api = create_mc();

$lists = get_lists($api);

print_r($lists);

for ($i = 0; $i < $lists['total']; $i++) {
    print_r($lists['data'][$i]);
}
?>
