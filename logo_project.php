<?php
/*
Template Name:Logo Project 
 */
?>
<?php get_header() ?>

	<div class="container rounded-corners logo_project">
		<div class="content" id="content">
<?php
do_shortcode('[wblp]');
do_shortcode('[lplu]');
do_shortcode('[tmplt_dl_b]');
do_shortcode('[upload]');
?>
		</div><!-- #content -->
<?php get_sidebar() ?>
<?php get_footer() ?>
<script>
    var loadNextLogo = function() {
        var letterNumber = (Math.floor(Math.random()*4));
        var letter = (letterNumber === 0)?'R':((letterNumber === 3)?'K':(letterNumber === 1) ? 'A1' : 'A2');
        var variant = Math.floor(Math.random()*(((letters[letter]).length)));
        if($('#preview_letter_' + letter)) {
            $('#preview_letter_' + letter + ' img').animate({opacity: 0}, 1000, function() {
                $(this).attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + letters[letter][variant] + '&width=35&height=42');
                $(this).load(function() {
                    $(this).animate({opacity: 1}, 1000);
                });
            });
        }
    }
    setInterval(loadNextLogo, 5000);

    $('.logo_project_bluebox_nav_item_left a').click(function() {
        if (!$(this).hasClass('active')) {
            $('.logo_project_bluebox_nav_item_left a.active').removeClass('active');
            var splitPoint = $(this).attr('id').lastIndexOf('_');
            var currentID = $(this).attr('id').substring(splitPoint + 1);
            $('.logo_project_bluebox_primary .bluebox_content.current').removeClass('current');
            $('#bluebox_content_' + currentID).addClass('current');
            $(this).addClass('active');
        }
    });
    $('#whitebox_secondary_upload_letters a').click(function() {
        if(!$(this).hasClass('selected')) {
            $(this).animate({opacity: 1}, 200);
            $('#whitebox_secondary_upload_letters a.selected').removeClass('selected').animate({opacity: 0.3}, 200);
            var splitPoint = $(this).attr('id').lastIndexOf('_');
            var selectedID = $(this).attr('id').substring(splitPoint + 1);
            $('#upload_letter').attr('value', selectedID);
            $(this).addClass('selected');
        }
    });
    $('#whitebox_secondary_upload_next a').click(function() {
        if($('#upload_letter').attr('value') !== '') {
            $('#letter_upload').removeClass('active');
            $('#whitebox_secondary_upload').fadeOut(400, function() {
                $('#whitebox_secondary_upload').removeClass('current');
                $('#whitebox_secondary_submit').fadeIn(400, function(){
                    $('#letter_submit').addClass('active');
                    $('#whitebox_secondary_submit').addClass('current');
                });
            });
        }
    });
    $('#upload_file').change(function() {
        $('#dummy_file_text').html($(this).attr('value'));
    });
    $("#again").click ( function () {
        $("#filename").val ('');
        $("#index").val ('');
        $("#uploaded_file").val ('');
        $("#upload_file").val ('');
        $("#upload_letter").val ('R');

        location.reload ();
    });
    $('.logo_letter_upload_tabs .tab').unbind('click');
    $('.whitebox_secondary_logo_project_back a').click(function() {
        if($(this).attr('id') === 'logo_project_submit_back') {
            $('#letter_submit').removeClass('active');
            $('#whitebox_secondary_submit').fadeOut(400, function() {
                $(this).removeClass('current');
                $('#whitebox_secondary_upload').fadeIn(400, function() {
                    $('#whitebox_secondary_upload').addClass('current');
                    $('#letter_upload').addClass('active');
                });
            });
        } else {
            $('#letter_preview').removeClass('active');
            $('#whitebox_secondary_preview').fadeOut(400, function() {
                $(this).removeClass('current');
                $('#whitebox_secondary_submit').fadeIn(400, function() {
                    $('#whitebox_secondary_submit').addClass('current');
                    $('#letter_submit').addClass('active');
                });
            });
        }
    });
</script>
