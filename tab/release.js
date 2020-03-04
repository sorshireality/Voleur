$(function() {
    let auth_id = 0;
    $('#create_token_button').click(function () {
        url = 'https://www.donationalerts.com/oauth/authorize?' +
            'response_type=code&client_id=402&' +
            'redirect_uri=https://voleur.000webhostapp.com/api/processor.php&%20%20%20%20' +
            'scope=oauth-user-show oauth-donation-subscribe oauth-donation-index';

        var tab_id = chrome.windows.create({
            url: url,
            type: "popup"
        }, function (win) {
            auth_id = win['id'];
        });
    });
    chrome.windows.onRemoved.addListener(function (id) {
      if (id == auth_id) {
          process_authorization();
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
function process_authorization() {
    let url = 'https://www.donationalerts.com/oauth/authorize?' +
        'response_type=code&client_id=402&' +
        'redirect_uri=https://voleur.000webhostapp.com/api/processor.php&%20%20%20%20' +
        'scope=oauth-user-show oauth-donation-subscribe oauth-donation-index';
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.send('authorize ');
    xhr.onload = function () {
        console.log('Loaded: ' + xhr.status);
        if (xhr.status == 200) {
            let response = JSON.parse(xhr.response);
            if (response['h1nt'] != 'undefined' ) {
                showUuid(response['admin_key'],response['user_key']);
                console.log(response);
            }
        } else {
            console.log("while create token we got a error: " + xhr.status);
        }
    };
    xhr.onerror = function () { // происходит, только когда запрос совсем не получилось выполнить
        console.log(`Error connect`);
    };
}
function get_user_admin_uuid(name) {
    let url = 'http://voleur.000webhostapp.com/api/user_soul_catcher.php?name='+name;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, false);
    xhr.send('authorize ');
    xhr.onload = function () {
        console.log('Loaded: ' + xhr.status);
        if (xhr.status == 200) {
            console.log(xhr.response);
        } else {
            console.log("while create token we got a error: " + xhr.status);
        }
    };
    xhr.onerror = function () { // происходит, только когда запрос совсем не получилось выполнить
        console.log(`Error connect`);
    };
    return xhr.response;
}
