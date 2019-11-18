/*<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOoop2G2bCdEU3Kbomym9DhvhkYkk1QHo&callback=myMap" type="text/javascript"></script>*/
var merged_result,data_report ; 
$(document).ready(function(){
	var width = window.screen.width;
	if(width <= 768 ){
			$(".srch").show();
		}else{
			$(".srch").hide();
		}
		$('#resultDiv').hide();

		draw() ; 

});







$(document).on('click','.msg_id', function(){
	$.ajax({
		url:base_url+module+'/getCircularByID',
		type:'post',
		data:{id:$(this).find('.cir_id').val()},
		success:function(data){
			data = JSON.parse(data);

			$('#cd').html(data[0]['CIRCULAR_DATE']);
			$('#cn').html(data[0]['CIRCULAR_NO']);
			$('#ct').html(data[0]['CIRCULAR_TITLE']);
			$('#msg').html(data[0]['CIRCULAR_MESSAGE']);
			if(data[0]['FILE_URL']!==null){
				$('#file').attr("href",view_path+'circulars/'+data[0]['FILE_URL']);
				$('#file').attr("target","_blank");
				$('#f_img').attr('src',base_url+'assets/images/pdf.png');
			}else{
				$('#f_img').attr('src',base_url+'assets/images/pdf_d.png');
				$('#file').attr("href","javascrip:void(0);");
				$('#file').attr("target","");
			}
			if(data[0]['SITE_URL']!==null){
				$('#site').attr("href",data[0]['SITE_URL']);
				$('#site').attr("target","_blank");
				$('#s_img').attr('src',base_url+'assets/images/url.png');
			}else{
				$('#s_img').attr('src',base_url+'assets/images/url_d.png');
				$('#site').attr("href","javascrip:void(0);");
				$('#site').attr("target","");
			}
		}
	});
});

$('#div').change(function(){
	$.ajax({
		url:base_url+module+'/getPsByDiv',
		type:'post',
		data:{divcode:$(this).val()},
		success:function(data){
			data = JSON.parse(data);
			var html = "";
			for(d in data){
				var pscode = data[d]['PS'];
				var divcode = data[d]['DIV'];
				var psname = data[d]['PSNAME'];
				html += '<option value ="'+pscode+'|'+divcode+'">'+psname+'</option>';
			}
			$('#ps').html(html);
		}
	});
});

$('#search').click(function(){
	let param = $('#ps').val();
	getResult(param);
});

$('#checkbox2').change(function(){
	if($(this).is(':checked'))
		$(this).val('1');
	else
		$(this).val('0');
	var flag = $(this).val();
	var param = $('#ps').val();
	getResult(param,flag);
});

function getResult(param='',flag=''){
	$.ajax({
		url:base_url+module+'/getResByPs',
		type:'post',
		data:{
			param:param,
			flag:flag
		},
		success:function(data){
			$('#resultDiv').show('slow');
			$('.resTable').DataTable().clear().destroy();
			$('.dlist').html(data);
			TableManageButtons.init();
			$('.resTable').DataTable().draw();
		}
	});
}

$('#ac').change(function(){
	$.ajax({
		url:base_url+module+'/getACwiseSectors',
		type:'post',
		data:{acno:$(this).val()},
		success:function(data){
			$('#resultDiv').show('slow');
			$('.resTable').DataTable().clear().destroy();
			$('.dlist').html(data);
			TableManageButtons.init();
			$('.resTable').DataTable().draw();
		}
	});
});

$('.mapFloat').click(function(){
	$.ajax({
		url:base_url+module+'/getLatLongByPPNO',
		type:'post',
		data:{ppno:$('#ppno').val()},
		success:function(data){
			data = JSON.parse(data);
			console.log(data);
			$('#lat').val(data[0]['Y']);
			$('#long').val(data[0]['X']);
			$('#sensitivity').val(data[0]['SENSITIVITY']);
			var wpol =data[0]['WPOL'];
			var wp = "";
			if(wpol == 'Y'){
				wp = base_url+"assets/images/png/wp.png";
			}

			$('#ppnm').val('<span>'+data[0]['PPNAME']+'</span><br/><span>'+data[0]['ADDR']+'</span><br/><span>'+data[0]['PS']+'</span><br/><span>'+data[0]['PC']+'</span><br/><span>'+data[0]['AC']+'</span><br><span>'+data[0]['BOOTHS']+'</span><br><span>'+data[0]['ICNAME']+'</span><br><span>'+data[0]['ICMOBOLE']+'</span><img src='+wp+'>');
			initMap();
		}
	});
});

function getdetbrdmsg(msgid){
	$.ajax({
		url:base_url+module+'/getBMsgByID',
		type:'post',
		data:{msgid:msgid},
		success:function(data){
			data = JSON.parse(data);
			$('#bmd').html(data[0]['MESSAGE_DATE']);
			$('#bmt').html(data[0]['MESSAGE_TITLE']);
			$('#bmsg').html(data[0]['MESSAGE_TEXT']);
			if(data[0]['FILE_URL']!==null){
				$('#bfile').attr("href",view_path+'broadcasts/'+data[0]['FILE_URL']);
				$('#bf_img').attr('src',base_url+'assets/images/pdf.png');
			}else{
				$('#bf_img').attr('src',base_url+'assets/images/pdf_d.png');
				$('#bfile').attr("href","javascrip:void(0);");
				$('#bfile').attr("target","");
			}
			if(data[0]['SITE_URL']!==null){
				$('#bsite').attr("href",data[0]['SITE_URL']);
				$('#bs_img').attr('src',base_url+'assets/images/url.png');
			}else{
				$('#bs_img').attr('src',base_url+'assets/images/url_d.png');
				$('#bsite').attr("href","javascrip:void(0);");
				$('#bsite').attr("target","");
			}
		}
	});
	$('#msgModal').show();
}

	/*var map = new google.maps.Map(document.getElementById('myMap'), {
	    zoom: 10,
	    center: new google.maps.LatLng(22.606191, 88.403119),
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  });*/
	
	/*var position = new google.maps.LatLng(22.606191, 88.403119);

    var myOptions = {
      zoom: 20,
      center: position,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
        document.getElementById("myMap"),
        myOptions);*/

	// for(var i = 0; i<obj.length; i++)
	// {
	// 	// alert(obj[i].X);
	// }

function showDetails(id){
	window.location.href = base_url+module+"/showDetails/"+id;
}

function initMap(){
	var lat = $('#lat').val();
	var long = $('#long').val();
	var ppnm = $('#ppnm').val();
	var sensitivity = $('#sensitivity').val();
	var imgSrc = "";
	
	if(sensitivity == 'Normal')
		imgSrc = base_url+"assets/images/png/n.png";
	else if(sensitivity == 'Hypercritical')
		imgSrc = base_url+"assets/images/png/hc.png";
	else if(sensitivity == 'Critical')
   		imgSrc = base_url+"assets/images/png/c.png";

   // var position = new google.maps.LatLng(22.606191, 88.403119);
   var position = new google.maps.LatLng(lat,long);
    var myOptions = {
      zoom: 20,
      center: position,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
        document.getElementById("map"),
        myOptions);
	//var image = 'images/marker.png';
    var marker = new google.maps.Marker({
		
        position: position,
        map: map,
		icon: imgSrc
    });  

    var contentString = '<strong>'+ppnm+'</strong>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });   
}

function draw(){

	  
      
      

      	$.ajax({
                          type: 'POST',
                          url: base_url+'Dashboard/get_rep_dets',
                           beforeSend: function(){
						     $(".rotator").show();
						   },
						   complete: function(){
						     $(".rotator").hide();
						   },
                          /*data: {RP_ID: repid},*/
                          success: function(data) {
                                  
                            
                            data_report = (JSON.parse(data)) ; 
                                                          
                            console.log(data) ;
                            console.log(data_report) ; 
                             

								google.charts.load("current", {packages:["corechart"]});
							      google.charts.setOnLoadCallback(drawChart);

							      function drawChart() {

							      
							      	//ajax to get ongoing and closed reports
							      		
							      console.log(data_report.ONGOING_COUNT) ; 
							      console.log(data_report.COMPLETE_COUNT) ; 

							        var data = google.visualization.arrayToDataTable([
							          ['Task', 'Reports Breakdown'],
							          ['Ongoing',   parseInt(data_report.ONGOING_COUNT)	],
							          ['Closed',    parseInt(data_report.COMPLETE_COUNT)  ],
							          
							        ]);

							        var options = {
							          title: 'Reports',
							          is3D: true,
							        };

							        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
							        chart.draw(data, options);

							        // Every time the table fires the "select" event, it should call your
							// selectHandler() function.
							google.visualization.events.addListener(chart, 'select', selectHandler);

							function selectHandler(e) {
							 //alert(data.getValue(chart.getSelection()[0].row, 0));

							var event  = data.getValue(chart.getSelection()[0].row, 0) ; 

							if(event=='Closed')
								window.location.href = base_url+'Report/complete_report_fetch';
								else if(event=='Ongoing')
									window.location.href = base_url+'Report/Ongoing_report_fetch';
								else
								{
									location.reload() ; 
								}

							}
							      }
							 

                                }//end of ajax success
                           		
                                //update handover modal

                   });//end of ajax

      	console.log(merged_result) ; 

}//end of draw()