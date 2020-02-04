jQuery(document).ready(function ($) {
    //Create WebSocket connection

    let socket = new WebSocket("wss://centrifugo.donationalerts.com/connection/websocket");
    socket.onopen = function(e) {
        socket.send(JSON.stringify({
            "params": {
                "token": "2H4SLFLKPE5TUjZuyHc3"
            },
            "id": 1
        }));
    };
    socket.onmessage = function(event) {
        alert(`[message] Data received from server: ${event.data}`);
    };
    console.log(socket);


    $("#auth").on("click",function () {
        $.ajax({
            url: 'https://www.donationalerts.com/api/v1/user/oauth',
            method: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer 2H4SLFLKPE5TUjZuyHc3");
            }, success: function(data){
                alert(data);
                console.log("ok");
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Fatal Error Creating The Request : ' + textStatus + ' | ' + errorThrown);
            }
        })
    });
    $("#clickme").on("click",function ()
        {
            console.log("Trying to send request ....");
    $.ajax({
        url: 'https://www.donationalerts.com/api/v1/alerts/donations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer 2H4SLFLKPE5TUjZuyHc3");
        }, success: function(data){
           alert(data);
            console.log("ok");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
        }
    })
});
});