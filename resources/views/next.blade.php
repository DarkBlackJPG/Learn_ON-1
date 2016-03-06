

<!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
<script src="https://cdn.rawgit.com/samsonjs/strftime/master/strftime-min.js"></script>
<script src="//js.pusher.com/3.0/pusher.min.js"></script>

<script>
    // Ensure CSRF token is sent with AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Added Pusher logging
    Pusher.log = function(msg) {
        console.log(msg);
    };
</script>
</head>
<body>
<div id="gornjalinija">

    <div id="learn"><a href="{{ url('main') }}">LEARN_ON</a></div>
    <div id="hamburger_menu" style="right: 150px;">
        <div id="nav-icon3">
            <span></span>
            <span></span>
            <span></span>
            <span></span>

            <div id="menimeni">
                MENU
            </div>
        </div>
    </div>
    <div id="chat"><a href="{{URL('chat')}}">{!! Html::image('img/chat.svg','alt',['style'=>'width:30px']) !!}</a></div>


</div>
@include('partials._levi_meni')
<div id="content_wrapper">
    <div>
        <div class="container" >
            <div class="row light-grey-blue-background chat-app" style="background: #ffffff;">
                <span style="">{{ $current_friend->username }}</span>
                <div id="messages" style="background: #ffffff;" burek="{{ $current_friend->id }}">
                    <div class="time-divide">
                    </div>
                    @foreach($messages as $message)
                        <?php
                        $sender=\App\User::getSender($message);
                        ?>
                        <div class="message">
                            <div class="avatar">
                                <img src="img/users/{{ $sender->profile }}">
                            </div>
                            <div class="text-display">
                                <div class="message-data">
                                    <span class="author">{{ $sender->username }}</span>
                                    <span class="timestamp">{{ $message->created_at }}</span>
                                    <span class="seen"></span>
                                </div>
                                <p class="message-body">{{ $message->message }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="action-bar">
                    <textarea class="input-message col-xs-10" placeholder="Your message"></textarea>
                    <div class="option col-xs-1 green-background send-message" style="background: rgb(254,64,66);width: 100px">
                        <span class="white light fa fa-paper-plane-o"></span>
                    </div>
                </div>

            </div>
        </div>

        @foreach($friends as $friend)
            <div style="height:70px;margin-top: 20px;   width: auto;">
                <img src="img/users/{{ $friend->profile }}" style="border-radius:50%; width:50px;"/>
                <span style=" "><b><a href="" id="{{ $friend->id }}">{{ $friend->username }}</a></b></span>
            </div>
            <script>
                $("#{{ $friend->id }}").click(function(event) {
                    event.preventDefault();
                    var friend = event.target.id;
                    var data = {friend_id: friend};
                    $.post('/chat/next', data).done(function(markup){
                        $('#zinziling').html(markup)});
                });

            </script>
        @endforeach
    </div>
</div>
</body>


<script id="chat_message_template" type="text/template">
    <div class="message">
        <div class="avatar">
            <img src="">
        </div>
        <div class="text-display">
            <div class="message-data">
                <span class="author"></span>
                <span class="timestamp"></span>
                <span class="seen"></span>
            </div>
            <p class="message-body"></p>
        </div>
    </div>
</script>

<script>
    function init() {

        var currentBox = $(document).find('#messages');
        currentBox.scrollTop(999999999);

        // send button click handling
        $('.send-message').click(sendMessage);
        $('.input-message').keypress(checkSend);
    }

    // Send on enter/return key
    function checkSend(e) {
        if (e.keyCode === 13) {
            return sendMessage();
        }
    }

    // Handle the send button being clicked
    function sendMessage() {
        var messageText = $('.input-message').val();
        var to = $(document).find('#messages').attr('burek');

        // Build POST data and make AJAX request
        var data = {chat_text: messageText, to: to};
        $.post('/chat/message', data).success(sendMessageSuccess);

        // Ensure the normal browser event doesn't take place
        return false;
    }

    // Handle the success callback
    function sendMessageSuccess() {
        $('.input-message').val('')
        console.log('message sent successfully');
    }

    // Build the UI for a new message and add to the DOM
    function addMessage(data) {
        // Create element from template and set values
        var el = createMessageEl();
        el.find('.message-body').html(data.text);
        el.find('.author').text(data.username);
        el.find('.avatar img').attr('src', "img/users/"+ data.avatar);

        // Utility to build nicely formatted time

        var messages = $('#messages');
        messages.append(el);

        // Make sure the incoming message is shown
        messages.scrollTop(messages[0].scrollHeight);
    }

    // Creates an activity element from the template
    function createMessageEl() {
        var text = $('#chat_message_template').text();
        var el = $(text);
        return el;
    }

    $(init);

    /***********************************************/

    var pusher = new Pusher('{{env("PUSHER_KEY")}}', {
        authEndpoint: '/chat/auth',
        auth: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    });
</script>