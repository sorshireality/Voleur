$(function() {
    var field = document.getElementById("input_field");
    $('#button_token').click(function () {

        localStorage.setItem('token', field.value);



    });
    function redirect(){
        var ses = localStorage.getItem("token");
        if(ses.length > 0){
            document.location.href = "../table/table.html";

        }
    }
    let timerId = setInterval(() => redirect());
});
