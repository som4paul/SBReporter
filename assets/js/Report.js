$(document).ready(function() {
    $('.ldr').css('display','none');
    $('#type').hide();
    $('#ct').prop('disabled',true);
    // $("#crtps").hide();
    // $('#PS').selectpicker().prop('disabled',true);
    // $("#PS").parent().closest('.btn').prop('disabled',true);
    $("#todate").prop('disabled',true);
    $(".a").prop('readonly',true);
    $("#firregtab").hide();
    $("#ivfsregtab").hide();
});

$('#search').click(function(){
	$("#firregtab").hide();
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();
	var ps = $('#PS').val();
	var status = $('#FIR_STATUS').val();
	var us = $('#UNDER_SECTION').val();
	var arragn = $('#ARRAGAINST').val();
	var type = $('#FR_UNOCCURED_TYPE').val();
	var method = getMethod();
	// alert(ps);return;
	$.ajax({
		url:base_url+module+'/getSearchResult',
		type:'POST',
		data:{
			fromdate:fromdate,
			todate:todate,
			ps:ps,
			status:status,
			us:us,
			arragnst:arragn,
			type:type,
			method:method
		},
		beforeSend:function(){
			$('.ldr').css('display','block');
        },
		success:function(data){
			$('.repTable').DataTable().clear().destroy();
			$('.dlist').html(data);
			$('.arrmsg').text('of '+arragn);
			TableManageButtons.init();
			$('.repTable').DataTable().draw();
			$('.note').show('slow');
			$('.ldr').css('display','none');
			$("#firregtab").show('slow');
		}
	});
});

$('#ifvpsearch').click(function(){
	$("#ivfsregtab").hide();
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();
	var ps = $('#PS').val();
	var arragnst = $('#arragnst').val();
	var method = getMethod();
	// alert(arragnst);return;
	$.ajax({
		url:base_url+module+'/getSearchResult',
		type:'POST',
		data:{
			fromdate:fromdate,
			todate:todate,
			ps:ps,
			status:arragnst,
			method:method
		},
		beforeSend:function(){
			$('.ldr').css('display','block');
        },
		success:function(data){
			$('.repTable').DataTable().clear().destroy();
			$('.dlist').html(data);
			TableManageButtons.init();
			$('.repTable').DataTable().draw();
			$('.note').show('slow');
			$('.ldr').css('display','none');
			$("#ivfsregtab").show('slow');
		}
	});
});


$('#pmsearch').click(function(){
	var year = $('#year').val();
	$.ajax({
		url:base_url+module+'/getPMResult',
		type:'POST',
		data:{year:year},
		beforeSend:function(){
			$('.ldr').css('display','block');
        },
		success:function(data){
			$('.repTable').DataTable().clear().destroy();
			$('.dlist').html(data);
			$('.yr').text(year);
			TableManageButtons.init();
			$('.repTable').DataTable().draw();
			$('.ldr').css('display','none');
		}
	});
});


$('#crimesearch').click(function(){
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();

	$.ajax({
		url:base_url+module+'/getCrimeResult',
		type:'POST',
		data:{
			fromdate:fromdate,
			todate:todate
		},
		beforeSend:function(){
			$('.ldr').css('display','block');
        },
		success:function(data){
			$('.crimeList').html(data);
			$('.ldr').css('display','none');
		}
	});
});

$('#division').change(function(){
 	$('#PS').html('<option>Loading.....</option>');
    var div = $('#division').val();
    $.ajax({
        url:base_url+module+'/getPsByDiv',
        type:'POST',
        data:{divcode:div},
        beforeSend:function(){
			$('.ldr').css('display','block');
        },
        success:function(data){
        	data = JSON.parse(atob(data));
            $('#PS').html(data);
            $('.ldr').css('display','none');
        },
    });
});

$(document).on('click','.uddet',function(){
	var details = $(this).val();
	details = atob(details);
	$('#udfileDet').val(btoa(details));
});

$('a').click(function(){
	var link = '.'+$(this).attr('class')+'-head';
	$('.divhd').hide();
	$(link).show();
});

$('#FIR_STATUS').change(function(){
	if($(this).val() == 'Unoccured'){
		$('#type').show();	
	}
	else{
		$('#type').hide();
		$('#FR_UNOCCURED_TYPE').val('');
	}
});

$(document).on('change','#wastat',function(){
	var statval = $(this).val();
	$('#wval').text("["+statval+"]");
	if(statval != 'Pending'){
		$('#dt').attr("hidden",false);
	}else{
		$('#dt').attr("hidden",true);
	}
});

$(document).on('click','#warepsearch',function(){
		var panel = $(this).closest('.wr');
		var formObject = panel.find("form");
		var formData = [];
		formObject.map(function(obj) {
			formData.push($(formObject[obj]).serializeArray());
		});
		$.ajax({
			url: `${base_url}${module}/waReg/qwerty`,
			type: 'POST',
		    data: {formData},
		    beforeSend:function(){
				$('.ldr').css('display','block');
	        },
		    success: function(resp){
		    	data = JSON.parse(resp);
		    	$('.warepTable').DataTable().clear().destroy();
				$('.wareplist').html(data.html);
				TableManageButtons.init();
				$('.warepTable').DataTable().draw();
				var pshtml = "";
				if(data.hasOwnProperty('psname')){
					for (d in data.psname){
						$pshtml = `<option value=${d.PSCODE}>${d.PSNAME}</option>`;
					}
					$('#waps').html(pshtml);
				}
				$('.ldr').css('display','none');
			}
		});
});

$("#fromdate").change(function(){
	$("#todate").prop('disabled',false);
});

$("#todate").change(function(){
    $('#ct').prop('disabled',false);
});

$("#PS").change(function(){
	$(".a").prop('readonly',false);
});

$('#ct').change(function(){
    var ct = $('#ct').val();
    $.ajax({
        url:base_url+module+'/getPsByCrt',
        type:'POST',
        data:{crt:ct},
        success:function(data){
        	d = JSON.parse(data);
        	// $(".PS").html("");
        	$(".PS").html(d);
        	// console.log($(".PS").html());
        	// $(".PS").show();
        },
    });
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);





$('#btnget').click(function() {

alert($('#chkveg').val());

})



  $('#view_req').DataTable( {
        "dom": 'Bfrtip',
   
        "buttons": [
    { extend: 'copy', className: 'btn btn-primary glyphicon glyphicon-duplicate' },
    { extend: 'csv', className: 'btn btn-primary glyphicon glyphicon-save-file' },
    { extend: 'excel', className: 'btn btn-primary glyphicon glyphicon-list-alt' },
    { extend: 'pdf', className: 'btn btn-primary glyphicon glyphicon-file' },
    { extend: 'print', className: 'btn btn-primary glyphicon glyphicon-print' }
        ],
      
        "scrollX": true,
        "order": [[ 1, "asc" ]]
    } );

$(document).ready(function(){
  var reqid = 0 ; 


  $('.glyphicon-fire').click(function(){
    reqid = ($(this).parent().attr('id')) ;
    var html ='' ; 
    $('#RP_ID_SEL').html(html) ; 

    //firing ajax to get the modal data
     $.ajax({
                          type: 'POST',
                          url: base_url+'Report/get_reports',
                         
                        
                          success: function(data) {
                           console.log(JSON.parse(data)) ;   
                           var option_data = JSON.parse(data) ;
                           html = '<option selected="true" disabled="disabled" value="">Select Report ID</option>' ; 
                           for(var j=0;j<option_data.length;j++)
                                 {     
                                 	console.log(option_data[j]) ; 
                                 	html+="<option value='"+option_data[j]['RP_ID']+"'>"+option_data[j]['RP_LOG_ID']+"</option>" ; 
                                 	
                                 }//end of for() 
                                  console.log(html);
                                 $('#RP_ID_SEL').html(html) ; 
                           
                            
                           
                          },
                      });//end of ajax 
     //increasing the Dropdown width

     $('#RP_ID_SEL').select2({dropdownAutoWidth : true});

   	//OPEN THE MODAL 
   	$('#report_sel_modal').modal('toggle') ; 
    					
           


   }); //end of glyphicon fire click   

var selected_rpid = 'a9998811' ; 
//prepare the swal to fire update ajax
   $('#map_req2rep').on('click',function(){ 
					//selective swal
    
	selected_rpid = $('#RP_ID_SEL').val() ; 					

    if(selected_rpid!='a9998811'&&selected_rpid!=null)
    				//getting confirmation 
 {   console.log(selected_rpid) ; 			
   	 swal({
                title: "Are you sure?",
                text: "Do you want to Close This request from your end !  ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Close it!",
                cancelButtonText: "No, cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {

                  //triggering ajax to send notification
                        $.ajax({
                          type: 'POST',
                          url: base_url+'Request/close_request',
                          data: {
                                 REQID : reqid,
                                 RP_ID :  selected_rpid        
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
                          success: function() {
                          // console.log(data) ;    
                            location.reload() ; 
                          },
                      });//end of ajax 
                  swal("Sent!", "notification has closed at your end", "success");
                } else {
                  swal("Cancelled", "notification closing has been cancelled", "error");
                }
              });

              }//end of if

              		else
              		{
              			swal('Please Select a valid Report ID to close the Request!!!!') ; 
              		}	

    }); //end of $('#map_req2rep').on('


   $('.glyphicon-eye-open').click(function(){
    reqid = ($(this).parent().attr('id')) ;
    
    $('#files_to_download').html('') ;				
    console.log(reqid) ;
    		//ajax to get the files and their respective links 

    		 $.ajax({
                          type: 'POST',
                          url: base_url+'Filecontroller/get_download_contents',
                          data: {REQID: reqid},
                          success: function(data) {
                                  
                            console.log(JSON.parse(data)) ; 
                            data2 = JSON.parse(data) ; 
                            //open modal to show the contents
                            	var html = '' ;

                            	 for(var j=0;j<data2.length;j++)
                                 {     
                                 	console.log(data2[j]) ; 
                                 	html+="<a href='"
                                 	+base_url+"Filecontroller/get_file_contents/"+reqid+"/"+data2[j]+"'><i class='glyphicon2 glyphicon glyphicon-file' size>"+data2[j]+"</i></a><br><br><br>" ;

                                 }
                                 $('#files_to_download').html(html) ; 
                            	$('#downmodal').modal('toggle') ; 

                                  
                                }
                           
                                //update handover modal

                   });//end of ajax




   }); //end of eye open                 




     $('.glyphicon-download-alt').click(function(){
    repid = ($(this).parent().attr('id')) ;
    
    $('#files_to_download').html('') ;        
    console.log(repid) ;
        //ajax to get the files and their respective links 

         $.ajax({
                          type: 'POST',
                          url: base_url+'Filecontroller/get_download_contents_report',
                          data: {RP_ID: repid},
                          success: function(data) {
                                  
                            console.log(JSON.parse(data)) ; 
                            data2 = JSON.parse(data) ; 
                            //open modal to show the contents
                              var html = '' ;

                               for(var j=0;j<data2.length;j++)
                                 {     
                                  console.log(data2[j]) ; 
                                  html+="<a href='"
                                  +base_url+"Filecontroller/get_file_contents_report/"+repid+"/"+data2[j]+"'><i class='glyphicon2 glyphicon glyphicon-file' size>"+data2[j]+"</i></a><br><br><br>" ;

                                 }
                                 $('#files_to_download').html(html) ; 
                              $('#downmodal').modal('toggle') ; 

                                  
                                }
                           
                                //update handover modal

                   });//end of ajax




   }); //end of download alt                

    $('.glyphicon-check').click(function(){ 
      repid = ($(this).parent().attr('id')) ;
        swal({
                title: "Are you sure?",
                text: "Do you want to Close This Report from your end ?\nNote:-Reports once closed can't be Changed!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Close it!",
                cancelButtonText: "No, cancel !",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {

                  //triggering ajax to send notification
                        $.ajax({
                          type: 'POST',
                          url: base_url+'Report/close_report',
                          data: {
                                 
                                 RP_ID :  repid        
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
                          success: function() {
                          // console.log(data) ;    
                            location.reload() ; 
                          },
                      });//end of ajax 
                  swal("Sent!", "Report has closed at your end", "success");
                } else {
                  swal("Cancelled", "Report closing has been cancelled", "error");
                }
              });

             

     }); //end of glyphicon check



    


    $('.glyphicon-open-file').click(function(){ 
      repid = ($(this).parent().attr('id')) ;
        swal({
                title: "Are you sure?",
                text: "Do you want to Re-Open This Report from your end ?\nNote:-Reports once Opened will be in Concerned DO's Queue!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, Re-Open it!",
                cancelButtonText: "No, Don't Re-Open !",
                closeOnConfirm: false,
                closeOnCancel: false
              },
              function(isConfirm) {
                if (isConfirm) {

                  //triggering ajax to send notification
                        $.ajax({
                          type: 'POST',
                          url: base_url+'Report/reopen_report',
                          data: {
                                 
                                 RP_ID :  repid        
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
                          success: function() {
                          // console.log(data) ;    
                            location.reload() ; 
                          },
                      });//end of ajax 
                  swal("Sent!", "Report has Re-Opened by your end", "success");
                } else {
                  swal("Cancelled", "Report Re-Opening has been cancelled", "error");
                }
              });

             

     }); //end of glyphicon check


    //OTHER EVENT CHANGE 

   $('#EVID').change(function(){

      var element=document.getElementById('othev');

      var selectedval  = $('#EVID option:selected').val();   
      console.log(selectedval) ; 
      if(selectedval==14) {
        element.style.display='block';
       }//end of if

       else{
          element.style.display='none';
       }
      }) ; 
   

  		}) ; //end of document ready



