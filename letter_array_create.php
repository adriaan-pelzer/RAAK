<script>
    var is_logo_page = '<?php echo (is_page_template('logo_project.php') ? 'yes' : 'no'); ?>';
    var letters = [];
    </script>
<?php
$different_letters = array('r', 'a', 'k');
$save_post = $post;
?>
    <div style="display:none;"><?php print_r ($post); ?></div>
<?php
foreach($different_letters as $different_letter) {
    $array_name = strtoupper($different_letter);
?>
    <script>
    letters['<?php echo $array_name; ?>'] =[];
    </script>
<?php
    $each_letter = new WP_Query(array('post_type' => 'raak_logo_letter', 'posts_per_page' => -1, 'meta_value' => $different_letter));
    $i = 0;
    while($each_letter->have_posts()) {
        $each_letter->the_post();
?>
        <script>
        //letters['<?php echo $array_name; ?>'][<?php echo $i; ?>] = '<?php echo get_post_meta(get_the_ID(), 'file', TRUE); ?>';
        letters['<?php echo $array_name; ?>'].push('<?php echo get_the_post_thumbnail(get_the_ID()); ?>');
        </script>
<?php
        $i++;
    }
}
$post = $save_post;
?>
    <div style="display:none;"><?php print_r ($post); ?></div>
<?php
?>
