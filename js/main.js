(function ($, root, undefined) {

    $(function () {

        'use strict';

        // DOM ready, take it away

        if ($('[data-popup]').length) {
            $('[data-popup]').each(function () {
                if ($(this).data('popup') == true) {
                    $(this).click(function () {
                        var popupTarget = $(this),
                            popupHref = popupTarget.attr('href');
                        openModal(popupHref);
                        return false;
                    });
                }
            });
        }
        //		$('.valiant').Valiant360({
        //			clickAndDrag: true,
        //			fov: 8,
        //			lon: 0,
        //			lat: -90,
        //			muted: true,
        //			hideControls: true,
        //			loop: "loop",
        //			autoplay: true
        //		});
        //		$('video').on('timeupdate', updateSidebar);
        //		$('.slider-for').slick({
        //			slidesToShow: 1,
        //			slidesToScroll: 1,
        //			arrows: true,
        //			fade: true,
        //			dots: true
        //		});
        var figure2 = $(".video_wrapper").hover(hoverVideoF, hideVideoF);
        var figure = $(".media_wrapper").hover(hoverVideo, hideVideo);

        function hoverVideo(e) {
            $('video', this).get(0).play();
        }

        function hideVideo(e) {
            $('video', this).get(0).pause();
        }

        function hoverVideoF(e) {
            $('video', this).get(0).play();
        }

        function hideVideoF(e) {
            $('video', this).get(0).pause();
        }

          function hoverVideoFText(e) {
            $('.video', this).get(0).play();
        }

        function hideVideoFText(e) {
            $('.video', this).get(0).pause();
        }



        // Tracks time to fire events
        var state = true;
        var momentNow = moment().tz("Europe/London");
        var loadtime = momentNow.format('X');
        var interval = setInterval(function() {
            var momentNow = moment().tz("Europe/London");
            var now = momentNow.format('X');
            var startDate = new Date( localize.startDate );
            startDate = moment(startDate).tz("Europe/London").format("X");
            var endDate = new Date( localize.endDate );
            endDate = moment(endDate).tz("Europe/London").format("X");
//            console.log('The time NOW: ' + now);
//            console.log('The time of the event START: ' + startDate);
//            console.log('The time of the evnt END: ' + endDate);
            if(startDate < now && endDate > now && loadtime < startDate && state){
                $('.content').prepend('The Event has begun! Please reload the page');
                $('.notification').css('opacity','1');
                state = false;
            }
            else if( now > endDate && loadtime < endDate && state){
                $('.content').prepend('The Event has Ended. Thank you for taking part in this experience!');
                $('.notification').css('opacity','1');
                state = false;
            }

        }, 1000);
//
//        var momentNow = moment().tz("Europe/London");
//        var now = momentNow.format('X');
//        var startDatte =  new Date( localize.startDate );
//        var endDate = new Date( localize.endDate );
//

    });
})(jQuery, this);

// TODO:

// [ ] Be more efficient
// [ ] Scroll to top of container between chages
// [ ] Detect content changes better (Get array or time changes, run function between change... maybe?)

function updateSidebar(event) {
    var current_time = this.currentTime,
        $hidden_modules = $("#modules .module").filter(function () {
            return (parseInt($(this).attr("data-end")) < current_time) || (parseInt($(this).attr("data-start")) > current_time);
        }),
        $module = $("#modules .module").filter(function () {
            return (parseInt($(this).attr("data-start")) < current_time) && (parseInt($(this).attr("data-end")) > current_time);
        });
    $hidden_modules.hide();
    $module.show();
}

window.fbAsyncInit = function () {
    FB.init({

        xfbml: true,
        version: 'v2.5'
    });

    // Get Embedded Video Player API Instance
    var my_video_player;
    FB.Event.subscribe('xfbml.ready', function (msg) {
        if (msg.type === 'video') {
            my_video_player = msg.instance;
            my_video_player.unmute();
        }
    });
};

(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {
        return;
    }
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

