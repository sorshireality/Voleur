$(function() {
    $('#show_button').click(function () {
        $('.additional').animate({right: '270px'});
        $('.additional').css('display','block');
    });
    $('#create_uuid_button').on('click', function() {

        $('.uuid_code').animate({right: '95px'});
        $('.uuid_code').css('display','block');


    });
});