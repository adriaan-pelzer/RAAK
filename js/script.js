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
    var activeBox = element.find('.active');
    var nextBox = (activeBox.next().length > 0) ? activeBox.next() : element.find('.bluebox_content:first');
    nextBox.css('z-index',2);
    activeBox.animate({opacity: 0}, 1500, 'swing', function() {
        activeBox.css('z-index',1).css('opacity', '1').removeClass('active');
        nextBox.css('z-index',3).addClass('active');
    });
}

preloadImages();

$(document).ready(function() {
    setInterval(load_next, 5000);
});
