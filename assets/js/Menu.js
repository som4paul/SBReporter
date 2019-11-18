// Get All Username Against Department

var userlist;
userlist = '';

$('#search').click(function(){
    var dept = $('#dept').val();
    var menu_list = $('#menu_list').val();

    $.ajax({
        url:base_url+module+'/getUsr',
        type:'POST',
        data:{
            dept:dept,
            menu_list:menu_list
        },
        success:function(data){
            $('.hid').show('slow');
            $('.dlist').html(data);
        }
    });
});

// Save Menu Permission
$('#saveBtn').click(function(){
    var uname = $('.uname').val();
    var menu_list = $('#menu_list').val();

    alert(uname+"as"+menu_list);return;

    $.ajax({
        url:base_url+module+'/saveMenuPermission',
        type:'POST',
        data:{
            dept:dept,
            menu_list:menu_list
        },
        success:function(data){
            $('.hid').show('slow');
            $('.dlist').html(data);
        }
    });
});

// Checkbox Value
$(document).on('click','input[type="hidden"]',function(){
    // var uid = this.id;
    alert($(this).val());
    // if(uid.is(":checked")){
    //     uid.prop('checked', true);
    //     if (userlist == '') {
    //         userlist = uid.val();
    //     } else {
    //         userlist = userlist+'|'+uid.val();
    //     }
    // }
    // // alert('hi');
    // else if($('.chkbx').is(":not(:checked)")){
    //     $('.chkbx').prop('checked', false);
    // }
    // alert(userlist);
});

// Select All User
$('#selectAll').click(function(){
    if($('#selectAll').is(":checked")){
        $('.chkbx').prop('checked', true);
    }
    else if($('#selectAll').is(":not(:checked)")){
        $('.chkbx').prop('checked', false);
    }
});
