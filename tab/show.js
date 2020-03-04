$(function() {
    $('#show_button').click(function () {
        $('.additional').animate({right: '270px'});
        $('.additional').css('display','block');
    });
    function showUuid(admincode,usercode) {
        $('.uuid_code').animate({right: '95px'});
        $('.uuid_code').css('display','block');


    });
});