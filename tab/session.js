$(function() {

    var field = document.getElementById("input_field");
    $('#button_token').click(function () {
        localStorage.setItem('token', field.value);
    if(localStorage.length > 0){
        document.location.href = "table/table.html";
    }
    });
});
