$(document).ready(function(){
	var i = 0;
  
  $('#checkbox2').change(function(){
    if($(this).is(':checked'))
      $(this).val('1');
    else
      $(this).val('0');
  });
});

$('#source').click(function(){
	var data = $('#val').val();
	$('#srcnm').html(data);
	$('#myModal').show();
	i = 0;
});

$(document).on('click','.data',function(){
  	$('.tick').hide();
  	var text = $(this).text();
  	var id = '#'+text.replace(/[ ,.\/()&]/g,""); 
  	id = id.toLowerCase();
  	$(id).show();
  	$('#rcvFrm').val(text);
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);


$('.glyphicon-share').click(function(){
    var complaint_id= ($(this).attr('id')) ;
    console.log(complaint_id) ;

           //getting confirmation 
              swal({
                title: "Are you sure?",
                text: "Do you want to send notification to the concerned  ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, send it!",
                cancelButtonText: "No, cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {

                  //triggering ajax to send notification
                        $.ajax({
                          type: 'POST',
                          url: base_url+'Master/send_mcc_notification',
                          data: {
                                 cid : complaint_id          
                                },
                         /* success: function(data) {
                            var stat = JSON.parse(data) ; 
                            console.log(stat['success']) ;
                            if(stat['success']!=0){
                              swal("notification sent  Successfully") ; 
                              //location.reload() ; 
                            } else {
                                swal("Notification sent  Failed !") ; 
                            }                         
                          },*/
                          success: function(data) {
                          // console.log(data) ;    
                            var stat = JSON.parse(data); 
                            console.log(stat['success']);
                            if(stat['success']!=0){
                             swal("notification sent  Successfully") ; 
                             //location.reload() ; 
                            } else {
                             swal("Notification sent  Failed !") ; 
                            }                        
                          },
                      });//end of ajax 
                  swal("Sent!", "notification has been sent to the concerned", "success");
                } else {
                  swal("Cancelled", "notification sending has been cancelled", "error");
                }
              });

    
});

$(document).on('click','#enq',function(){
  var val = $(this).val();
  var vals = val.split("|");
  $('#AUTO_ID').val(vals[0]);
  $('#REP_RECVD_ON').val(vals[1]);
  $('#ACTION_TAKEN').val(vals[2]);
  $('#REP_MEMO_NO').val(vals[3]);
  $('#REP_MEMO_DT').val(vals[1]);
}); 


$('.glyphicon-envelope').click(function(){
    var complaint_id= ($(this).attr('id'));


    //getting confirmation 
                    swal({
                title: "Are you sure?",
                text: "Do you want to send e-mail to the concerned  ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, send it!",
                cancelButtonText: "No, cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {

                  //triggering ajax to send EMAIL
                        $.ajax({
                          type: 'POST',
                          url: base_url+'Master/send_mcc_email',
                          data: {
                                 cid : complaint_id
                                
                                },
                            
                          success: function(data) {
                                  console.log(data) ; 
                                  
                                                
                                                if(data!=0){
                                                  swal("e-mail sent  Successfully") ; 
                                                  //location.reload() ; 
                                                }
                                  else
                                  {
                                    swal("e-Mail sent  Failed !") ; 
                                  }            
                                         
                              },
                          
                      
                      });//end of ajax 
                  swal("Sent!", "e-mail has been sent to the concerned", "success");
                } else {
                  swal("Cancelled", "e-mail sending has been cancelled", "error");
                }
              });


}) ;//end of envelope click

$(document).on("click",".viewdetails",function() {
  $.ajax({
      url: base_url+'MCC/getfiles',
      type: 'POST',
      data: {USERID: $(this).val()},        
      success: function(d) {
        $("#docdetails").html(d);
      }
  });
});

$(document).on("click",".uploaddetails",function() {
  $("#userfile").val("");
  $("#userid").val($(this).val());
  $("#onsuccess").html("");
});


$(document).on("click",".btndelete",function() {
    var input = $(this).val();
    var iddoc = input.split("/");
    $.ajax({
      url: base_url+'MCC/deletefile',
      type: 'POST',
      data: {DOCID: iddoc[1],
             USERID: iddoc[0],
             DOCNAME: iddoc[2]},        
      success: function(d) {
        $("#docdetails").html(d);
      }
  });
});


$(document).on("click","#pdf_save_button",function() {
  var title = $("#title").val();
  title = title.replace(/[^a-z0-9\s]/gi, ' ').replace(/[_\s]/g, ' ');
  if(title != ''){
    var authFilObj = $("input[name='userfile']");
    var userid = $("#userid").val();
    authFilObj.upload(base_url+'MCC/filesave/'+userid+"/"+encodeURI(title),function(resp){
      $("#view"+userid).show();
      var index = resp.indexOf("/");
      var len = 0, filename = '';
      len = resp.substring(0, index);
      filename = resp.substring(index+1, resp.length);
        if(resp.length < 300){
            if(len == '1'){
               $("#href"+userid).attr("href", view_path+"mcc/"+filename);
               $("#view"+userid).hide();
               $("#href"+userid).show();
                $("#onsuccess").html('<h4 class="text-success"+>Upload successful</h4>');
            }else if(len == '0'){
            $("#onsuccess").html(filename);
            }else{
               $("#view"+userid).show();
               $("#href"+userid).hide();
            $("#onsuccess").html('<p class="text-success"+>Upload successful</h4>');
            }
        }else{
            $("#onsuccess").html('<h3 class="text-danger"+>File size should be less than 10 MB. Upload Again!</hh3>');
        }
    },function(prog,loaded){
      $("#pgb").width(loaded);
      $("#pgbtxt").html(loaded+"% compleated");
     }
    );
    $("#title").val("");
    $("#userfile").val("");
    $("#pgb").width('0%');
    $("#pgbtxt").html("0% compleated");
  }else{
    alert("Please fillup all the fields")
  }         
});



$(document).on('click','.repTo',function(){
  $.ajax({
      url: base_url+module+'/getReports',
      type: 'POST',
      data: {cid: $(this).val()},        
      success: function(resp) {
        data = JSON.parse(resp);
        $('#repTable').DataTable().clear().destroy();
        $('.dlist1').html(data.html);
        $('#repTable').DataTable().draw();
        $('#reptable1').DataTable().clear().destroy();
        $('.dlist2').html(data.html1);
        $('#reptable1').DataTable().draw();
      }
  });
});

$(document).on('change','#STAT',function(){
  $.ajax({
      url: base_url+module+'/filterStatus',
      type: 'POST',
      data: {stat: $(this).val()},        
      success: function(resp) {
        $('.respTable').DataTable().clear().destroy();
        $('#loadhtml').html(resp);
        $('.respTable').DataTable().draw();
      }
  });
});

$('#CID').blur(function(){
  $.ajax({
      url: base_url+module+'/isDuplicateID',
      type: 'POST',
      data: {cid: $(this).val()},        
      success: function(resp) {
        if(resp != '0'){
          $('#CID').val('');
          alert('Serial No. already exists.');  
        }
      }
    });
});




