table = $('#don_gandon');
//вывод донатов в таблицу
function displayDonations(item,index){
    console.log(item,index);
    table.append("<tr>" +
        "<td>"+item['username']+"</p>" +"</td>" +
        "<td>"+item['amount']+ "</p>"+"</td>" +
        "<td>"+item['currency']+ "</p>"+"</td>" +
        "<td>"+"<textarea rows='8' cols='90' disabled readonly >"+item['message']+"</textarea>"+"</td>" +
        "<td>"+item['created_at']+"</td>" +
        "</tr>")
}
user_key = localStorage.id;
document.getElementById('loader').style.display = "block";
    var url = 'https://voleur.000webhostapp.com/api/catch.php?code=' + user_key;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.send();
    xhr.onload = function () {//получаем ответ от сервера
        document.getElementById('loader').style.display = "none";
        console.log(`Loaded: ${xhr.status}`); //статус
        donations = JSON.parse(xhr.response);
        donations['data'].forEach(displayDonations);
    };

    xhr.onerror = function () { // происходит, только когда запрос совсем не получилось выполнить
        console.log(`Error connect`);
    };

    xhr.onprogress = function (event) { // запускается периодически
        // event.loaded - количество загруженных байт
        // event.lengthComputable = равно true, если сервер присылает заголовок Content-Length
        // event.total - количество байт всего (только если lengthComputable равно true)
        console.log(`Loaded ${event.loaded} from ${event.total}`);
    };

    //функция, которая при нажатии на кнопку закрывает окно таблицы и очищает localStorage
$(function() {
    $('#new_button_token').click(function () {
        localStorage.clear();
        window.close();
    });
});
