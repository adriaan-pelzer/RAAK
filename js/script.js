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
            images[i].src = "http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + value + '&width=35&height=42";
            i++;
        });
    });
}

var load_next = function() {
    var letterNumber = (Math.floor(Math.random()*4));
    var letter = (letterNumber === 0)?'R':((letterNumber === 3)?'K':'A');
    var variant = Math.floor(Math.random()*(((letters[letter]).length)));

    $('#logo_letter_' + (letterNumber + 1) + ' img').fadeOut('slow',function() {
        $(this).attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/resize.php?filename=logo_uploads/' + letters[letter][variant] + '&width=35&height=42');
        $(this).fadeIn('slow');
    });

    setTimeout(load_next, (Math.floor(Math.random()*4000) + 1000));
}

$(document).ready(function() {
    preloadImages();
    load_next();
});
