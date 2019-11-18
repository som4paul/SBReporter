$(document).ready(function(){
    $('.pwdoff, .rpwdoff, #message').hide();
    $('#reset').prop('disabled',true);
});

// Reload CAPTCHA
$('#reloadBtn').click(function(){
    $.ajax({
        url: base_url+'Login/newCaptcha',
        type: 'post',
        data: {},
        success: function(data){
            $('#captchaImg').html(data);
        }
    });
});

$('.toggle').click(function(){
    if($('#pwd').attr('type') == 'password'){
        $('#pwd').attr('type', 'text');
        $('.pwdshow').hide();
        $('.pwdoff').show();
    } else {
        $('#pwd').attr('type', 'password');
        $('.pwdoff').hide();
        $('.pwdshow').show();
    }
});

// Toggle Current Password Field
$('.toggleCP').click(function(){
    if($('#cp').attr('type') == 'password'){
        $('#cp').attr('type', 'text');
        $('.pwdshow').hide();
        $('.pwdoff').show();
    } else {
        $('#cp').attr('type', 'password');
        $('.pwdoff').hide();
        $('.pwdshow').show();
    }
});

// Toggle New Password Field
$('.toggleP').click(function(){
    if($('#p').attr('type') == 'password'){
        $('#p').attr('type', 'text');
        $('.pwdshow').hide();
        $('.pwdoff').show();
    } else {
        $('#p').attr('type', 'password');
        $('.pwdoff').hide();
        $('.pwdshow').show();
    }
});

// Toggle Confirm Password Field
$('.toggleRP').click(function(){
    if($('#rp').attr('type') == 'password'){
        $('#rp').attr('type', 'text');
        $('.rpwdshow').hide();
        $('.rpwdoff').show();
    } else {
        $('#rp').attr('type', 'password');
        $('.rpwdoff').hide();
        $('.rpwdshow').show();
    }
});

// Change Password
$('#nxt').click(function(){
    var pass = $('#curpass').find("input").val();

    $.ajax({
        url: base_url+'Login/chkPass',
        type:'post',
        data:{p:pass},
        success:function(data){
            if(data == 1){
                $('#curpass').hide('slow');
                $('#nxt').hide();
                $('#npwd, #rpwd, #message').show('slow');
                $('#updt').show();
                $('#updt').prop('disabled','true');
            }
            else{
                swal("ERROR", "Wrong Credentials! Please try again.", "error");
                $('#curpass').find("input").css('border-bottom', '2px solid red');
                $('#curpass').find("label").css('color', 'red');
            }
        },
    });
});

