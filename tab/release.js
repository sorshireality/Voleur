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
      $('#enter_uuid_field').on('input', function(){  //обрабатываем нажатие на кнопку
          var user_key = $('#enter_uuid_field').val();
          if (user_key!=""){
              document.getElementById('loader').style.display = "block";
          document.getElementById('enter_uuid_field').style.border = "3px solid black"; //

        var url = 'https://voleur.000webhostapp.com/api/catch.php?code='+user_key;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url,true);
        xhr.send();
        xhr.onload = function() {//получаем ответ от сервера
            document.getElementById('loader').style.display = "none";
            console.log(`Loaded: ${xhr.status}`); //статус
            response = JSON.parse(xhr.response); //тело ответа
            console.log(response);
            if (response["result"] == 'error') {document.getElementById('enter_uuid_field').style.border = "3px solid red";} else
                 {document.getElementById('enter_uuid_field').style.border = "3px solid lightgreen"; setTimeout(function () {
                    console.log('redirect there'); //redirect
                },1500);}
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
          }
    });
      });

