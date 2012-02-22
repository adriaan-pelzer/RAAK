var letters = new Array();
letters[0] = ['2dcfb0448f8b53e4a913a16c8f3413f2.jpg', '4bd891a62ea023f66c37176c84d4a7fa.png', '241eca044d005504eabcaa5d3e6b9068.jpg'];
letters[1] =['137f63eaec658cecd6305fa150be320d.jpg', '0387e51d17f01d524c0b07de1469eb6a.png', '27027cdc0a51f42ce66c576cb4916fa1.png'];
letters[2] =['137f63eaec658cecd6305fa150be320d.jpg', '0387e51d17f01d524c0b07de1469eb6a.png', '27027cdc0a51f42ce66c576cb4916fa1.png'];
letters[3] = ['0c71b1cbe12da4fdbe88df63f21dbfce.jpg', '78ce302c784ece3f208eba8152c2bc58.jpg', '94f1cb321eb37b70e6f4a789514aee55.jpg'];

var load_next = function() {
    var letter;
    var letterNumber = (Math.floor(Math.random()*4));
    console.log('letter:' + letterNumber);
    var variant = Math.floor(Math.random()*(((letters[letterNumber]).length)+1));
    console.log('variant:' + variant);
    if (variant === 0) {
        letter = 'r';
    } else if (variant === 3) {
        letter = 'k';
    } else {
        letter = 'a';
    }
    $('#logo_letter_' + (letterNumber + 1) + ' img').attr('src', 'http://stage.wewillraakyou.com/wp-content/themes/RAAK/logo_letters/' + letter  + '/' + letters[letterNumber][variant]);
    setTimeout(load_next, 3000);
}
$(document).ready(function() {
    load_next();
});
