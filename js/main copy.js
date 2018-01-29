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
        if ($('.chat_wrapper').length !== 0) {
            var socket = io();
            $('form').submit(function () {
                socket.emit('chat message', $('#m').val());
                $('#m').val('');
                return false;
            });
            //socket.emit('adduser',prompt('Please enter a username...'));

            socket.emit('question', function (data) {
                console.log('fired the questions event...')
                var questions = $('#m').val();
                if ($('#m').length !== 0) {
                    $.ajax({
                        type: 'post',
                        url: ajaxurl,
                        data: {
                            question_asked: questions,
                        }
                    });
                };
            });



            socket.on('chat message', function (msg) {
                $('#messages').append($('<li>').text(msg));
                window.scrollTo(0, document.body.scrollHeight);
            });
            socket.on('message', function (data) {
                $('#messages').append($('<li>').text(data));
            });
            // Quit event (still needs completing)
            socket.emit('quit', function (data) {
                $('#messages').append($('<li>').text(data.text));
            });
            socket.on('broadcast', function (data) {
                console.log('testing123')
                $('#messages').append($('<li>').text(data.description));
            });
            socket.on('test', function (data) {
                $('#messages').append($('<li>').text(data));
            });
        }
    });


})(jQuery, this);
