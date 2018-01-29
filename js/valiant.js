(function ($, root, undefined) {

	$(function () {

		'use strict';

		$('.valiant').Valiant360({
			clickAndDrag: true,
			fov: 8,
			lon: 0,
			lat: -90,
			muted: true,
			hideControls: true,
			loop: "loop",
			autoplay: true
		});
		$('video').on('timeupdate', updateSidebar);
		$('.slider-for').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: true,
			fade: true,
			dots: true
		});
    });
})(jQuery, this);

// TODO:

// [ ] Be more efficient
// [ ] Scroll to top of container between chages
// [ ] Detect content changes better (Get array or time changes, run function between change... maybe?)

function updateSidebar( event ) {
	var current_time = this.currentTime,
		$hidden_modules = $("#modules .module").filter(function() {
			return ( parseInt( $(this).attr("data-end") ) < current_time ) || ( parseInt( $(this).attr("data-start") ) > current_time );
		}),
		$module = $("#modules .module").filter(function() {
			return ( parseInt( $(this).attr("data-start") ) < current_time ) && ( parseInt( $(this).attr("data-end") ) > current_time );
		});
	$hidden_modules.hide();
	$module.show();
}

 window.fbAsyncInit = function() {
      FB.init({

        xfbml      : true,
        version    : 'v2.5'
      });

      // Get Embedded Video Player API Instance
      var my_video_player;
      FB.Event.subscribe('xfbml.ready', function(msg) {
        if (msg.type === 'video') {
          my_video_player = msg.instance;
          my_video_player.unmute();
        }
      });
    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) {return;}
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_US/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
