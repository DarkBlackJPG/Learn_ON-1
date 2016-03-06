<script src="//js.pusher.com/3.0/pusher.min.js"></script>
<script>
    var pusher = new Pusher("{{env("PUSHER_KEY")}}")
    var channel = pusher.subscribe('first-custom-channel');
    channel.bind('first-custom-event', function(data) {
        swal(data.text);
    });
</script>
