<?php
    add_action('wp_footer', 'aston_web_script');
    function aston_web_script() {
        $room =  preg_replace("/^https?:\\/\\//", "", get_permalink());
        $home = preg_replace("/^https?:\\/\\//", "", get_bloginfo('url'));
        $ajax_nonce = wp_create_nonce("chat");
       // $ajax_nonce_img = wp_create_nonce("img");
?>
    <script id='chat_script'>
        $(function() {
            var globalPostId = <?php echo get_the_ID(); ?>;
            var globalRoom = '<?php echo $room; ?>';
            var socket = io('local.wordpress.dev:3004');
            socket.emit('join-room', '<?php echo $room; ?>');
            //submitting a question..
            console.log(globalRoom);
            $('.submit_question').submit(function(e) {
                e.preventDefault()
                //console.log('button click detected!');
                socket.emit('question', $('#m').val());
                console.log('fired the questions event...');
                var questions = $('#m').val();
                if ($('#m').length !== 0) {
                    $('#m').val('');
                    jQuery.post(
                        ajaxurl, {
                            'action': 'add_question',
                            'data': questions,
                            'security': '<?php echo esc_attr( $ajax_nonce ); ?>',
                            'room': '<?php echo get_the_ID(); ?>'
                        },
                    );
                    $('#messages li:last').after('<li>Thanks for submitting the question, the speaker will reply shortly!</li>');
                };
            });
            function encode_utf8(s) {
			  return unescape(encodeURIComponent(s));
			}
			function decode_utf8(s) {
			  return decodeURIComponent(escape(s));
			}

            socket.on('answers', function(data){
                var post = data.post;
                console.log('firing the sending back function');
//                console.log('This is the data: ' + data.ques);
//                console.log(globalPostId + 'sfhgs');
                console.log(post + 'ksejfhw');
                if(post == globalPostId){
                    console.log('Answer made on room' + globalPostId);
                    //console.log(post);
                    $.post('/emit/answers', $('#messages li:first').before('<li class="question_post"><b>Question: </b>' + data.ques + '</li>'));
                    $.post('/emit/answers', $('#messages li:nth-child(2)').before('<li class="question_post"><b>Answer: </b>' + data.ans + '</li>'));
                }
            });



            socket.on('captions', function(data){
                console.log(globalPostId);
                console.log('captions have been recieved');
                var image = data.img;
                var tweet = data.tweet;
                var link = data.link;
                var post = data.post;
                console.log('Post ID' + post);
                var stringCatch = 'twitter';
               // $.post('/emit/captions',$('#messages li:first').after(data));
                console.log('Twitter content' + tweet);
                if(post == globalPostId && tweet.indexOf(stringCatch) != -1){
                    console.log('TWEET TWEET');
                    $.post('/emit/captions', $('#messages li:first').before('<li class="question_post twitter">' + tweet + '</li>'));
                }
                else if(post == globalPostId){
                    console.log('imageeeee');
                    $.post('/emit/captions', $('#messages li:first').before( '<li class="question_post"><a href="' + link +'"><img src="' + image + '"></li>'));
                }
                var images = data['images'];
                var postID = data['post'];

                if ($('[data-post=' + postID + ']').length ) {
                    $('<li>').prependTo($('ul#messages').text(data));
                    };
            });

        });
            // Sending the answer back



    </script>
    <?php
};
//Sending the Question to CPT...
add_action('wp_ajax_nopirv_add_question', 'sentToCpt');
add_action('wp_ajax_add_question', 'sentToCpt');
function sentToCpt(){
    check_ajax_referer("chat", 'security');
    $post = array(
        'post_title' => $_REQUEST['data'],
        'post_type' => 'answers',
        'post_status' => 'draft',
    );
    $sent_post = wp_insert_post( $post );
    update_field('event_room',$_REQUEST['room'], $sent_post);

};

//
//add_action('wp_ajax_nopirv_add_question', 'sentToCptCaption');
//add_action('wp_ajax_add_question', 'sentToCptCaption');
//function sentToCptCaption(){
//    check_ajax_referer("chat", 'security');
//    $post = array(
//        'post_title' => $_REQUEST['data'],
//        'post_type' => 'captions',
//        'post_status' => 'publish',
//    );
//    $sent_post = wp_insert_post( $post );
//    update_field('event_room',$_REQUEST['room'], $sent_post);
//    die;
//};


add_action('add_post',function( $post_id ){
    $post = get_post( $post_id );
    $fields = [
        'post' => $post->ID,
        'questions' => $post_title,
    ];
    echo $fields['post'];
});


add_action('save_post', 'aston_send_answer', 99);

function aston_send_answer($postID){
    $room =  preg_replace("/^https?:\\/\\//", "", get_permalink());
    $post = get_post($postID);

    if ($post->post_type === 'answers' && $post->post_status === 'publish' ):
        $fields = [
            'postid'       => $post->ID,
            'question'     => $post->post_title,
            'answeredBy'   => get_field('answered_by'),
            'answer'       => apply_filters('the_content', $post->post_content),
            'url'          => get_post_permalink(get_field('rel_event')->ID),
            'cpt'          => 'chat',
            'post'         => get_field('event_room')
            //'images'       => get_sub_field('images')


        ];
        $data_string = json_encode($fields);
        $s = curl_init();
        curl_setopt($s, CURLOPT_URL, 'http://[::1]:3004/emit/answers');
        curl_setopt($s, CURLOPT_POST, true);
        curl_setopt($s, CURLOPT_PORT, 3004);
        curl_setopt($s, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($s, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
            ));
//        curl_setopt($ch, CURLOPT_PROXY, "http://[::1]:8080/emit/answers"); //your proxy url
//        curl_setopt($ch, CURLOPT_PROXYPORT, "80");
        $content = curl_exec($s);
        $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
        if($errno = curl_errno($s)) {
            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
            };
// echo $data_string;
//        var_dump($status);
//        var_dump($s);
//        die;
		curl_close($s);
    endif;
};

//add_action('transition_post_status', 'aston_send_caption',99);
add_action('save_post', 'aston_send_caption',99);

function aston_send_caption($postID){
    $post = get_post($postID);
    // Autosave, do nothing
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
            return;
    // AJAX? Not used here
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
            return;
    // Return if it's a post revision
    if ( false !== wp_is_post_revision( $post ) )
            return;
    $room =  preg_replace("/^https?:\\/\\//", "", get_permalink());
    //$post = get_post($postID);
    $test = get_post_meta( get_the_ID(), 'event_room');
    //var_dump($test);

    //var_dump(get_the_ID());
    //die();
        if($post->post_type === 'captions' &&  $post->post_status === 'publish' ):

            $fields_captions = [
                'postid'       => $post->ID,
                'tweet'        => apply_filters('the_content', $post->post_content),
                'link'         => $post->post_title,
                'image'        => wp_get_attachment_url( get_post_thumbnail_id($post_id) ),
                'room'         => $test,
                'post'         => get_the_ID()
            ];

            $data_string_captions = json_encode($fields_captions);
            $s = curl_init();
            curl_setopt($s, CURLOPT_URL, 'http://[::1]:3004/emit/captions');
            curl_setopt($s, CURLOPT_POST, true);
            curl_setopt($s, CURLOPT_PORT, 3004);
            curl_setopt($s, CURLOPT_POSTFIELDS, $data_string_captions);
            curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($s, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string_captions)
                ));
    //        curl_setopt($ch, CURLOPT_PROXY, "http://[::1]:8080/emit/answers"); //your proxy url
    //        curl_setopt($ch, CURLOPT_PROXYPORT, "80");
            $content = curl_exec($s);
            $status = curl_getinfo($s, CURLINFO_HTTP_CODE);
            if($errno = curl_errno($s)){
                $error_message = curl_strerror($errno);
                echo "cURL error ({$errno}):\n {$error_message}";
                };
    // echo $data_string;
    //        var_dump($status);
    //        var_dump($s);
    //        die;
            curl_close($s);
        endif;
};




add_action('admin_enqueue_scripts', function () {
	global $post_type;
	if ($post_type === 'chat'):
		wp_enqueue_script('socket-io', '//cdn.socket.io/socket.io-1.3.5.js', '1.3.5', false, true);
		wp_enqueue_script('socket-io-notifcations', get_stylesheet_directory_uri() . '/js/notification.js', '1.0.0', false, true);
	endif;
}, 99);
?>
