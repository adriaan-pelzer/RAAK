var letters = new Array();
letters[0] = ['2dcfb0448f8b53e4a913a16c8f3413f2.jpg', '4bd891a62ea023f66c37176c84d4a7fa.png', '241eca044d005504eabcaa5d3e6b9068.jpg'];
letters[1] =['137f63eaec658cecd6305fa150be320d.jpg', '0387e51d17f01d524c0b07de1469eb6a.png', '27027cdc0a51f42ce66c576cb4916fa1.png'];
letters[2] =['137f63eaec658cecd6305fa150be320d.jpg', '0387e51d17f01d524c0b07de1469eb6a.png', '27027cdc0a51f42ce66c576cb4916fa1.png'];
letters[3] = ['0c71b1cbe12da4fdbe88df63f21dbfce.jpg', '78ce302c784ece3f208eba8152c2bc58.jpg', '94f1cb321eb37b70e6f4a789514aee55.jpg'];

var load_next = function() {
    var letter = (Math.round(Math.random()*3));
    console.log('letter:' + letter);
    switch (letter)
    {
        case 1:
            var variant = Math.ceil(Math.random()*((letters[letter]).length));
            console.log('variant:' + variant);
            $('#logo_letter_r1 img').attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/logo_letters/r/' + letters[letter][variant]);
            break;
        case 2:
            var variant = Math.ceil(Math.random()*((letters[letter]).length));
            $('#logo_letter_a2 img').attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/logo_letters/a/' + letters[letter][variant]);
            break;
        case 3:
            var variant = Math.ceil(Math.random()*((letters[letter]).length));
            $('#logo_letter_a3 img').attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/logo_letters/a/' + letters[letter][variant]);
            break;
        case 4:
            var variant = Math.ceil(Math.random()*((letters[letter]).length));
            $('#logo_letter_k4 img').attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/logo_letters/k/' + letters[letter][variant]);
            break;
    }
    setTimeout(load_next, 3000);
}
var load_letter = function() {
    load_letter();
}

$(document).ready(function() {
    load_next();
});
