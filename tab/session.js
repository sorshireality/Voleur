$(function() {
    // var field = document.getElementById("input_field");
    // $('#button_token').click(function () {
    //     localStorage.setItem('token', field.value);
    //
    //     let timerId = setTimeout(redirect);
    //
    //
    // });
    // function redirect(){
    //         document.location.href = "../table/table.html";
    // }
    //
    // if(localStorage.length > 0){
    // let timerId = setTimeout(redirect);
    // }





    if(localStorage.length > 0){
        let timerId = setTimeout(redirect);
    }
    function redirect() {
        var tab_id = chrome.windows.create({
            url: "tab/table/table.html",
            type: "popup"
        }, function (win) {
            auth_id = win['id'];
        });
    }

});
