var images = Array();
var i = 0;

var preloadImages = function() {
    $.each(letters, function(index, value) {
        $.each(letters[index], function(index, value) {
            images[i] = new Image();
            images[i] = value;
            i++;
        });
    });
}

var load_next = function() {
    var letterNumber = (Math.floor(Math.random()*4));
    var letter = (letterNumber === 0)?'R':((letterNumber === 3)?'K':'A');
    var variant = Math.floor(Math.random()*(((letters[letter]).length)));
    $('#logo_letter_' + (letterNumber + 1) + ' span').animate({opacity: 0}, 1000, function() {
        $(this).html(letters[letter][variant]);
        $('#logo_letter_' + (letterNumber + 1) + ' span img').load(function() {
            $('#logo_letter_' + (letterNumber + 1) + ' span').animate({opacity: 1}, 1000);
        });
    });
}

function bindElementAnimation(element) {
    var containers = element.find('.bluebox_content');
    containers.each(function(index) {
        if($(this).hasClass('current')) {
            $(this).animate({opacity: 0}, 2000, function() {
                $(this).removeClass('current');
            });
        } else {
            $(this).animate({opacity: 1}, 2000, function() {
                $(this).addClass('current');
            });
        }
    });
}

preloadImages();

$(document).ready(function() {
    setInterval(load_next, 5000);
});
