$(function() {
    $('#button_token').click(function () {
        var code = $('#input_field').val();
        var url = 'https://voleur.000webhostapp.com/tab/token.php?code='+code;
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