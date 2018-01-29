function openModal( popupObject )
{
	if ( $('.popup').length < 1 ) {
		$("body").append("<div class='popup hide'><div class='popup-inner'></div></div>");
		$('.popup').append("<button class='popup-close' aria-label='Close'>x</button>");
		$('.popup-close').click( function(e){
			$('.popup').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
				$('.popup').remove();
			});
			$('.popup').addClass('hide');
			$('html').css('overflow','initial');
			$('body').unbind('keydown');
		});
		$('.popup').click( function(e) {
			if (e.target !== this)
				return;

			$('.popup').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
				$('.popup').remove();
			});
			$('.popup').addClass('hide');
			$('html').css('overflow','initial');
			$('body').unbind('keydown');

			e.preventDefault();
		});
		$(document).keydown(function(e) {
			e = e || window.event;
			var isEscape = false;
			if ("key" in e && e['key']) {
				isEscape = (e.key == "Escape" || e.key == "Esc");
			} else {
				isEscape = (e.keyCode == 27);
			}
			if (isEscape) {
				$('.popup').bind("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
					$('.popup').remove();
				});
				$('.popup').addClass('hide');
				$('html').css('overflow','initial');
				$('body').unbind('keydown');

				e.preventDefault();
			}
		});
	}
	var timer = 0;
	if ( validYouTubeUrl( popupObject ) ) {
		var videoId = validYouTubeUrl( popupObject );
		var timer = 200;
		$(".popup-inner").html('<iframe width="100%" height="500" src="//www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>');
	} else if ( validImageUrl( popupObject ) ) {
		$(".popup-inner").html('<img src="' + popupObject + '" />');
	} else if ( $( popupObject ).length ) {
		$(".popup-inner").html( '<div class="mixed_content user_content">' + $( popupObject ).html() + '</div>' );
		if ( $('.popup .popup-slider').length ) {
			$('.mixed_content.user_content').removeClass('mixed_content user_content');
			$(".popup .popup-slider").slick({
				arrows: true,
				easing: 'swing',
				nextArrow: '<button type="button" class="slick-next"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>',
				prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>',
			});
		}
	}
	$('html').css('overflow','hidden');
	setTimeout( function(){
		$('.popup').removeClass('hide');
	}, timer);
}

var scroll = window.requestAnimationFrame ||
             window.webkitRequestAnimationFrame ||
             window.mozRequestAnimationFrame ||
             window.msRequestAnimationFrame ||
             window.oRequestAnimationFrame ||
             // IE Fallback, you can even fallback to onscroll
             function(callback){ window.setTimeout(callback, 1000/60) };
var lastPosition = -1;
function loop(){

    var top = window.pageYOffset;

    if (lastPosition == top) {
        scroll( loop );
        return false;
    } else {
		lastPosition = top;
	}

	// Run scroll event JS in here.

    // Recall the loop
    scroll( loop );
}
loop();

var iceResize = (function() {

    var callbacks = [],
        running = false;

    // fired on resize event
    function resize() {

        if (!running) {
            running = true;

            if (window.requestAnimationFrame) {
                window.requestAnimationFrame(runCallbacks);
            } else {
                setTimeout(runCallbacks, 66);
            }
        }

    }

    // run the actual callbacks
    function runCallbacks() {

        callbacks.forEach(function(callback) {
            callback();
        });

        running = false;
    }

    // adds callback to loop
    function addCallback(callback) {

        if (callback) {
            callbacks.push(callback);
        }

    }

    return {
        // public method to add additional callback
        add: function(callback) {
            if (!callbacks.length) {
                window.addEventListener('resize', resize);
            }
            addCallback(callback);
        }
    }
}());

iceResize.add(function() {
	matchHeight();
    // Only peform resize based JS in this function.
});



function percentageSeen ( el ) {
    var elementsSeen = [];
    $(el).each( function(){
        var elementObject = new Object();
        elementObject.element = this;
        elementObject.percentage = calculateVisibilityForDiv($(this));
        elementsSeen.push(elementObject);
    });
    elementsSeen.sort(compare);
    return elementsSeen;
}
function calculateVisibilityForDiv(div$) {
    var windowHeight = $(window).height(),
        docScroll = $(document).scrollTop(),
        divPosition = div$.offset().top,
        divHeight = div$.height(),
        hiddenBefore = docScroll - divPosition,
        hiddenAfter = (divPosition + divHeight) - (docScroll + windowHeight);

    if ((docScroll > divPosition + divHeight) || (divPosition > docScroll + windowHeight)) {
        return 0;
    } else {
        var result = 100;

        if (hiddenBefore > 0) {
            result -= (hiddenBefore * 100) / divHeight;
        }

        if (hiddenAfter > 0) {
            result -= (hiddenAfter * 100) / divHeight;
        }

        return result;
    }
}

function compare(a,b) {
	if ( a.percentage > b.percentage )
		return -1;

	if ( a.percentage < b.percentage )
		return 1;

	return 0;
}

function cssPropertyValueSupported(prop, value) {
  var d = document.createElement('div');
  d.style[prop] = value;
  return d.style[prop] === value;
}

function matchHeight() { // Convert to basic JS
    if ( $('[data-match-height]').length ) {
		$('[data-match-height]').each( function(){
			var $this = jQuery(this),
				$parent = $this.parent(),
				match_type = $this.attr('data-match-height');
			$parent.attr('data-match-height-parent', match_type);
		});
		$('[data-match-height-parent]').each( function(){
			var $parent = $(this),
				match_type = $parent.attr('data-match-height-parent'),
				smallest = 999999,
				smallestElem = null,
				tallest = 0,
				tallestElem = null;
			$parent.find('[data-match-height]').each( function(){
				var $this = $(this);
				$this.css('height', '');
				var height = $this.outerHeight();
				if ( height < smallest ) {
					smallest = height;
					smallestElem = $this;
				}
				if ( height > tallest ) {
					tallest = height;
					tallestElem = $this;
				}
			});
			var match_height = tallest;
			if ( 'small' === match_type ) {
				match_height = smallest;
			}
			$parent.find('[data-match-height]').css('height', match_height + 'px');
		});
    }
}

var forEach = function (array, callback, scope) {
	for (var i = 0; i < array.length; i++) {
		callback.call(scope, i, array[i]); // passes back stuff we need
	}
};

function validYouTubeUrl( url ) {
	if (url != undefined || url != '') {
		var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
		var match = url.match(regExp);
		if (match && match[2].length == 11) {
			return match[2];
		}
		else {
			return false;
		}
	}
}
function validImageUrl( url )
{
	return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}
function validJson( str )
{
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
