var letters = {
    'R':[
        '2dcfb0448f8b53e4a913a16c8f3413f2.jpg',
        '4bd891a62ea023f66c37176c84d4a7fa.png',
        '241eca044d005504eabcaa5d3e6b9068.jpg',
        '5196b17d8503c6ad7a7accfefbdeda83.jpg',
        '7832f12fb6b6af543b029481f0b7baa4.png',
        '3326823e578cbe72c52ca50e5b338494.jpg',
        'a8b2a4f4c69564aa9f11381c0c260235.jpg',
        'a5605d2e128aaa3779904d517d211942.png'
    ],
    'A':[
        '3fe9de8c3f0b3d7286c6f7c97afd46ba.jpg',
        '7bf62183cb8f5c938b5a0da6bf959647.jpg',
        '45d36d1d36846e6a7210254b7c10b1e0.png',
        '51de71bfb5dfe9edc1c73f0ca5a4408a.jpg',
        '73e0fec8bb33c1cdc59c812d3954bbfb.jpg',
        '94f1befdbb9439a574a82458d1fffc06.jpg',
        '137f63eaec658cecd6305fa150be320d.jpg',
        '0387e51d17f01d524c0b07de1469eb6a.png',
        '811f9f13a4e7294ee86ff2288d3534a7.jpg',
        '27027cdc0a51f42ce66c576cb4916fa1.png',
        'de8042ed495729c023b480f5812b8df8.png',
        'eb9895b79c7e1cd240cb3960e16ad30b.jpg'
     ],
     'K':[
         '0c71b1cbe12da4fdbe88df63f21dbfce.jpg',
         '78ce302c784ece3f208eba8152c2bc58.jpg',
         '94f1cb321eb37b70e6f4a789514aee55.jpg',
         '1123dcb9de8cff45074fc0b8029b9751.jpg',
         '93455d62240dc78204038d89fcc4eaaa.png',
         'adc3d69153a68c25153f5e7cafdb924c.png',
         'ba0c3f6be22d07916abf6ca1f7d37d8a.jpg',
         'c6a513db33554763c49386bed4673bc3.jpg'
      ]
};
var images = Array();
var i = 0;

var preloadImages = function() {
    $.each(letters, function(index, value) {
        $.each(letters[index], function(index, value) {
            //$('.preloaded_images').append('<img src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + value + '&width=35&height=42" />')
            images[i] = new Image();
            images[i].src = 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + value + '&width=35&height=42';
            i++;
        });
    });
}

var load_next = function() {
    var letterNumber = (Math.floor(Math.random()*4));
    var letter = (letterNumber === 0)?'R':((letterNumber === 3)?'K':'A');
    var variant = Math.floor(Math.random()*(((letters[letter]).length)));

    $('#logo_letter_' + (letterNumber + 1) + ' img').animate({opacity: 0}, 1000, function() {
        $(this).attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + letters[letter][variant] + '&width=35&height=42');
        $(this).load(function() {
            $(this).animate({opacity: 1}, 1000);
        });
    });
}

preloadImages();

var latestPostsPagination = function() {
    $('.pagination .previous').click(function() {
        if (($('.whitebox_primary_post.current').next('div').length) !== 0) {
            $('.whitebox_primary_post.current').removeClass('current').next('div').addClass('current');
            if (($('.whitebox_primary_post.current').prev('div').length) !== 0) {
                $('.pagination .next').addClass('active');
            }
            if (($('.whitebox_primary_post.current').next('div').length) === 0) {
                $('.pagination .previous').removeClass('active');
            }
        }
    });
    $('.pagination .next').click(function() {
        if (($('.whitebox_primary_post.current').prev('div').length) !== 0) {
            $('.whitebox_primary_post.current').removeClass('current').prev('div').addClass('current');
            if (($('.whitebox_primary_post.current').next('div').length) !== 0) {
                $('.pagination .previous').addClass('active');
            }
            if (($('.whitebox_primary_post.current').prev('div').length) === 0) {
                $('.pagination .next').removeClass('active');
            }
        }
    });
}

var ourWorkPagination = function() {
    $('.our_work_nav h3 a').click(function() {
        if(!$(this).hasClass('active')) {
            $('.our_work_nav h3 a.active').removeClass('active');
            $('.our_work_bluebox_content.current').removeClass('current');
            var current_class = $(this).attr('class');
            $('.our_work_bluebox_content#' + current_class).addClass('current');
            $(this).addClass('active');
        } 
    });
}
    
var aboutPagination = function() {
    $('.about_nav a').click(function() {
        if(!$(this).hasClass('active')) {
            $('.about_nav a.active').removeClass('active');
            $('.about_content.current').removeClass('current');
            $('.bluebox_container.current').removeClass('current');
            var current_id = $(this).html().toLowerCase();
            $('.about_bluebox h3').html(current_id);
            current_id = current_id.replace(/ /g , '-');
            $('#' + current_id).addClass('current');
            $('#bluebox_content_' + current_id).addClass('current');
            if (current_id === 'what-we-do') {
                if (!($('#twitter_raakonteurs').hasClass('current'))) {
                    $('#twitter_raakonteurs').addClass('current');
                }
            }
            $(this).addClass('active');
        }
    });
    $('#who-we-are nav a').click(function() {
        if(!$(this).hasClass('active')) {
            $('#who-we-are nav a.active').removeClass('active');
            $('.whitebox_primary_content_founder.current').removeClass('current');
            $('.founder_quotes .bluebox_content_item.current').removeClass('current');
            var current_id = $(this).html().toLowerCase();
            current_id = current_id.replace(/ /g , '-');
            $('#whitebox_primary_content_' + current_id).addClass('current');
            $('#bluebox_content_' + current_id).addClass('current');
            console.log(current_id);
            if($('#twitter_' + current_id).length) {
                console.log('#twitter_' + current_id);
                $('.twitter.current').removeClass('current');
                $('#twitter_' + current_id).addClass('current');
            } else if (!($('#twitter_raakonteurs').hasClass('current'))) {
                $('#twitter_raakonteurs').addClass('current');
            }
            $(this).addClass('active');
        }
    });
}

var projectHover = function() {
    $('.whitebox_big_category_entry_content').hover(function() {
        $(this).find('div').toggleClass('current');
    });
}

var galleryShowImg = function() {
    $('.bluebox_bigpic').html('<img width="315" height="203" title="' + $('.ngg-gallery-thumbnail a img').first().attr('title') + '" alt="' + $('.ngg-gallery-thumbnail a img').first().attr('alt') + '" src="' + $('.ngg-gallery-thumbnail a').first().attr('href') + '">');
    $('.ngg-gallery-thumbnail a').click(function(event){
        event.preventDefault();
    });
    $('.ngg-gallery-thumbnail a').mouseover(function() {
        $('.bluebox_bigpic').html('<img width="315" height="203" title="' + $(this).find('img').attr('title') + '" alt="' + $(this).find('img').attr('alt') + '" src="' + $(this).attr('href') + '">');
    });
}

var ourWorkCatDisplay = function() {
    $('a.whitebox_big_nav_item').click(function() {
        if(!$(this).hasClass('active')) {
            $('a.whitebox_big_nav_item.active').removeClass('active');
            $(this).addClass('active');
            var splitPoint = $(this).attr('id').lastIndexOf('_');
            var currentID = $(this).attr('id').substring(splitPoint + 1);
            $('.whitebox_big_category.current').removeClass('current');
            $('#whitebox_big_' + currentID).addClass('current');
        }
    });
}

var blogHomeCatBoxPagination = function() {
    $('.whitebox-secondary .multiple_tabs .tab').click(function() {
        if (!$(this).hasClass('active')) {
            $('.whitebox-secondary .multiple_tabs .tab.active').removeClass('active');
            var currentID = $(this).attr('id');
            $('.whitebox_secondary_item.current').removeClass('current');
            $('#whitebox_secondary_item_' + currentID).addClass('current');
            $(this).addClass('active');
        }
    });
}

var viewLettersPagination = function() {
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
}

var uploadLetter = function() {
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
            $('#whitebox_secondary_upload').removeClass('current');
            $('#letter_upload, #whitebox_secondary_upload').animate({opacity: 0}, 1000, function() {
                $('#letter_upload').removeClass('active');
                $('#whitebox_secondary_upload').removeClass('current');
                $('#letter_submit').addClass('active');
                $('#whitebox_secondary_submit').addClass('current');
                $('#letter_submit, #letter_upload, #whitebox_secodary_submit').animate({opacity: 1}, 1000);
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
    
}


            
            


$(document).ready(function() {
    setInterval(load_next, 5000);
    latestPostsPagination();
    ourWorkPagination();
    blogHomeCatBoxPagination();
    aboutPagination();
    projectHover();
    galleryShowImg();
    ourWorkCatDisplay();
    viewLettersPagination();
    uploadLetter();
});
