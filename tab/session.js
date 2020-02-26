$(function() {
    var field = document.getElementById("input_field");
    $('#button_token').click(function () {
        localStorage.setItem('token', field.value);
        var ses = localStorage.getItem("token");
        console.log("naem");
    if(ses.length > 0){
        document.location.href = "../table/table.html";
        console.log("naebalovo");
    }
    });
});
