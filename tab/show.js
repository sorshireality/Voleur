$(function() {
    $('#show_button').click(function () {
        $('.additional').animate({right: '270px'});
        $('.additional').css('display','block');
    });

});
function showUuid(admincode,usercode) {
    let admincode_div = document.getElementById('admin_uuid');
    let usercode_div = document.getElementById('user_uuid');
    admincode_div.innerHTML += admincode;
    usercode_div.innerHTML += usercode;
    $('.uuid_code').animate({right: '95px'}).css('display','block');
}
