jQuery(document).ready(function ($) {
    $("#clickme").on("click",function ()
        {
            console.log("Trying to send request ....");
    $.ajax({
        url: 'https://www.donationalerts.com/api/v1/alerts/donations',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer JpXlwd0NGIBWeUGuJr1x");
        }, success: function(data){
           alert(data);
            console.log("ok");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Ошибка: ' + textStatus + ' | ' + errorThrown);
        }
    })
});
});