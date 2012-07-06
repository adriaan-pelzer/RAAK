<?php
/*
Template Name: API
 */

$api = create_mc();

$lists = get_lists($api);

for ($i = 0; $i < $lists['total']; $i++) {
    echo $lists['data'][$i]['id']." - ".$lists['data'][$i]['name']."<br />\n";
}
?>
