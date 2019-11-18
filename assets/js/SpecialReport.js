 $(".number").keypress(function(event) {
	numberFiledValidate(event);
});
 
 function checkCharSize(){
	var id = $('.idcat').val();

    if(id==='Aadhar Card'){
        $('.idno').prop('maxlength',12);
    }
    else if(id==='Driving Licence'){
        $('.idno').prop('maxlength',17);
    }
    else if(id==='Passport'){
        $('.idno').prop('maxlength',8);
    }
    else if(id==='Voter ID Card'){
        $('.idno').prop('maxlength',11);
    }
}

function getIOByUnit(){
    var unit = $('#unit').val();
    $.ajax({
		url: base_url+module+'/getIOByUnit',
		type:'POST',
		data:{unit:unit},
		success:function(data){
			data = JSON.parse(atob(data));
			var html = "";
			for(d in data){
				var io = data[d]['IONAME'];
				var iocode = data[d]['IOCODE'];
				html += '<option value ="'+iocode+'|'+io+'">'+io+'</option>';
			}
			$('#io').html(html);
		},
	});
}


$(document).ready(function(){
	/*** FIR SECTION **/
	$('#panel-modal').modal('show');
	var method = getMethod();
	if(method=='addFir'){
		getIOByUnit();
		checkCharSize();
		// textCount(id,len);
		$(".input-daterange-datepicker").val("");

		$('.input-daterange-datepicker').daterangepicker({
			autoUpdateInput: false,
			locale: {
			  cancelLabel: 'Clear'
			}
		});

		$('.input-daterange-datepicker').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
		});

		$('.input-daterange-datepicker').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
	}

	// $('#lat').val('22.');
	// $('#long').val('88.');

	$('#udstar').hide();
	$('.idstar').hide();
	$('.idno').prop('required',false);
	$('.vicStar').hide();
	$('.vicReq').prop('required',false);
	$('#f_h_name').prop('required',false);
	$('#f_h_star').hide();
	$('#accstar').hide();
	$('#fh_name').prop('required',false);

	$(".mapMarker").click(function () {
        var initlLat = $("#lat").val();
        var initlLong = $("#long").val();

        if(initlLat == "" && initlLong =="") {
            callMap();
        }
        else {
            myMap(parseFloat(initlLat), parseFloat(initlLong));
        }
    });
    var callMap = function() {
   var startPos;
   var geoOptions = {
     enableHighAccuracy: true
   }

   var geoSuccess = function(position) {
     startPos = position;
     // document.getElementById('startLat').innerHTML = startPos.coords.latitude;
     // document.getElementById('startLon').innerHTML = startPos.coords.longitude;
         var lat = startPos.coords.latitude;
         var long = startPos.coords.longitude;
         // console.log(lat+", "+long);
         myMap(lat, long);
         // document.getElementById('map').value = lat + ", " + long;
   };
   var geoError = function(error) {
     console.log('Error occurred. Error code: ' + error.code);
     // error.code can be:
     //   0: unknown error
     //   1: permission denied
     //   2: position unavailable (error response from location provider)
     //   3: timed out
   };

   navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
 };

 // Following two variable is for use of click event on map.
 var customLatLng;
 var customMarker;

 function myMap(lati, longi) {
 	var myLatLng = {lat: lati, lng: longi};
    var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 16,
        center: myLatLng
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map
    });
    customMarker = new google.maps.Marker({
        position: myLatLng,
        map: map
    });

 	google.maps.event.addListener(map, 'click', function(event) {
 	var latLong = event.latLng.lat() + ", " + event.latLng.lng();

// Placing a marker in map on click event. User will see a marker whereever they click in.
 	customLatLng = {lat: event.latLng.lat(), lng: event.latLng.lng()};
 	customMarker.setMap(null);
 	customMarker = new google.maps.Marker({
     	position: customLatLng,
     	map: map
 	});

 	$('#LAT_LONG').val(event.latLng.lat()+','+event.latLng.lng());
 	});

 	$('#mapModal').on('shown.bs.modal', function () {
     	google.maps.event.trigger(map, 'resize');
     	map.setCenter(new google.maps.LatLng(lati, longi));
 	});
 }
});


$('.repDate').click(function(){
	var val = $(this).val();
	$.ajax({
		url: base_url+module+'/setRepDate',
		type:'POST',
		data:{vrepdate:val},
		success:function(data){
			window.location.href = base_url+module+'/index';
		},
	});
});

window.setTimeout(function() {
    $(".alert").fadeTo(400, 0).slideUp(400, function(){
        $(this).remove(); 
    });
},3000);

$(document).on('keyup','.upprCase',function(){
	var up = $(this).val();
	var res = up.toUpperCase();
	$(this).val(res);
});

$(document).on('blur','.VIC_VICTIM',function(){
	var val = $(this).val();
	var res = val.match('NOT');
	
	if(res == null){
		$('.vicStar').show();
		$('.vicReq').prop('required',true);
	}
	else{
		$('.vicStar').hide();
		$('.vicReq').prop('required',false);	
	}
});

$(document).on('keyup','.spclChar',function(){
	var char = $(this).val();
	var pattern = /(-|~|`|!|@|#|\$|%|\^|&|\*|\(|\)|\+|=|_|\.|,)/;
    if(pattern.test(char)){
        alert("Do not use any special Characters");        
        var len = char.length;
        var v = char.substr(0,len-1);
        $(this).val(v);
    }	
});

$('.firpagedate').datepicker({
	format: "dd/mm/yyyy",
	autoclose:true,
	endDate:"today",
	maxDate:moment()
});

$('#division').change(function(){
 	$('#PS').html('<option>Loading.....</option>');
    var div = $('#division').val();
    $.ajax({
        url:base_url+module+'/getPsByDiv',
        type:'POST',
        data:{divcode:div},
        success:function(data){
        	data = JSON.parse(atob(data));
            $('#PS').html(data);   
        },
    });
});

$(document).on('change','#father_husband',function(){
	$('#f_h_name').prop('required',true);
	$('#f_h_star').show();
});

$(document).on('change','#f_h',function(){
	$('#fh_name').prop('required',true);
	$('#accstar').show();
});

$(document).on('change','.idcat',function(){
	var val = $(this).val();
	if(val == 'NA'){
		$('.idno').prop('required',false);
		$('.idstar').hide();
	}
	else{
		$('.idno').prop('required',true);
		$('.idstar').show();
	}
});

$('#firno').blur(function(){
	var firno = $(this).val();
	$.ajax({
		url: base_url+module+'/checkDupFir',
		type:'POST',
		data:{firno:firno},
		success:function(data){
			data = JSON.parse(atob(data));
			if(data != null){
				alert('FIR No. already exists.');
				$('#firno').val('');
			}
		},
	});
});

$('#unit').change(function(){
	getIOByUnit();
	var unit = $(this).val();
	if(unit == 'Other'){
		$('#ioDiv').show();
		$('#iodiv').hide();
		$('#io').prop('required',false);
		$('#IO').prop('required',true);
	}
	else{
		$('#iodiv').show();
		$('#ioDiv').hide();
		$('#io').prop('required',true);
		$('#IO').prop('required',false);
	}
});

$('.idcat').change(function(){
    checkCharSize();
});

$('#brieffact1').keyup(function() {
	var id = $(this).attr('id');
	var len = $(this).val();
	textCount(id,len);
});

$('#brieffact2').keyup(function() {
	var id = $(this).attr('id');
	var len = $(this).val();
	textCount(id,len);
});

$('#brieffact3').keyup(function() {
	var id = $(this).attr('id');
	var len = $(this).val();
	textCount(id,len);
});

$('#law').change(function(){
    var law = $(this).val();
    $.ajax({
		url: base_url+module+'/getCategoryCrime',
		type:'POST',
		data:{law:law},
		success:function(data){
			data = JSON.parse(atob(data));
			var html = "";
			for(d in data){
				var cat = data[d]['CATEGORY'];
				html += `<option value = '${cat}'>${cat}</option>`;
			}
			$('#cat').html(html);
		},
	});
});

$('#cat').change(function(){
    var cat = $(this).val();
    $.ajax({
		url: base_url+module+'/getAct',
		type:'POST',
		data:{cat:cat},
		success:function(data){
			data = JSON.parse(atob(data));
			$('#UNDER_SECTION').val(data);
		},
	});
});

$('.info').hover(function(){
	var $this = $(this);
	$.ajax({
		url:base_url+module+'/getMaxFir',
		type:'POST',
		data:{},
		success:function(data){
			data = JSON.parse(atob(data));
			$this.attr('title', data);
			$this.css('cursor','pointer');
		}
	});
});

$('input[type=radio]').change(function(){
	var val = $(this).val();
	if(val === 'Unknown'){
		$('#NAME_ACCUSED').val('UNKNOWN');
		$('#appending').hide();
		$('.accper').hide();
	}
	if(val === 'Known'){
		$('#NAME_ACCUSED').val('');
		$('#appending').show();
		$('.accper').show();
	}
});

$('#gdedt').change(function(){
	var firdt = $('#firdt').val();
	var gdedt = $('#gdedt').val();
	if(gdedt > firdt){
		alert('GDE Date cannot be greater than FIR Date');
		$('#gdedt').val('');
	}
});

$(document).on('change','.ptow',function(){
	var val = $(this).val();
	val = atob(val);

	$.ajax({
		url:base_url+module+'/publishToWeb',
		type:'POST',
		data:{val:val},
		success:function(data){
			if(data == 1){
				alert('Data Updated Successfully');
			}
		}
	});
});

$(document).on('change','.avail',function(){
	var val = $(this).val();
	val = atob(val);

	$.ajax({
		url:base_url+module+'/checkAvail',
		type:'POST',
		data:{val:val},
		success:function(data){
			if(data == 1){
				alert('Data Updated Successfully');
			}
		}
	});
});

$(document).on('click','.det',function(){
	var details = $(this).val();
	details = atob(details);
	$('#fileDet').val(btoa(details));
});

$('.delfir').click(function(){
	var val = $(this).val();
	$.ajax({
		url:base_url+module+'/deleteFir',
		type:'post',
		data:{val:val},
		beforeSend:function(){
			return confirm('Are you sure to delete?');
		},
		success:function(data){
			if(data == 1){
				alert('FIR Delete Successfully');
				location.reload();
			}
		}
	});
});

$('.viewDate').change(function(){
	var date = $(this).val();
	var ps = $(this).parent().parent().find('#PS').val();
	var access = $(this).parent().find('#access').val();
	$.ajax({
		url:base_url+module+'/checkDate',
		type:'post',
		data:{date:date,
			ps : ps
		},
		success:function(data){
			if(data == '0'){
				if(access == 'DIV' || access == 'DD'){
					alert("No data is available for this date.");
					window.location.href = base_url+module+'/calender';
				}else{
					window.location.href = base_url+module+'/getTopBarHtml';	
				}
			} else{
				var ps = $('#PS').val();
				$('.reportDate').val(date);
				$('#date').val(date);
				$('#ps').val(ps);
				$('#event-modal').modal('show');
			}
		},
	});
});

/** UNNATURAL DEATH SECTION **/
$('#udcaseno').blur(function(){
	var val = $(this).val();
	if(val != ''){
		$('#udcasedt').prop('required',true);
		$('#udstar').show();
	}
	else{
		$('#udcasedt').prop('required',false);
		$('#udstar').hide();	
	}
});

$(document).on('click','.uddet',function(){
	var details = $(this).val();
	details = atob(details);
	$('#udfileDet').val(btoa(details));
});

$('#UDCASENO').blur(function(){
	var udcaseno = $(this).val();
	$.ajax({
		url: base_url+module+'/checkDupUDcaseno',
		type:'POST',
		data:{udcsno:udcaseno},
		success:function(data){
			data = JSON.parse(atob(data));
			if(data != null){
				alert('UD No. already exists.');
				$('#UDCASENO').val('');
			}
		},
	});
});


/** ARREST SECTION **/
// $('.arrStar').hide();
$('.arrReq').prop('required',false);
// $('.gdeStar').hide();
$('.gdeReq').prop('required',false);
// $('.gdeDiv').hide();
$('.arrName').hide();
$('.caseno').addClass('readonly-input');
$('.firdate').addClass('readonly-input');
$('.CASE_YR').addClass('readonly-input');
$('.msg').hide();
$('.f_h_name').hide();
$('.WA_NO').hide();

$(document).on('change', '.arrestagainst', function(){
	var val = $(this).val();
	var mother = $(this).closest(".child");
	if(val == 'FIR' || val == 'SPECIFIC'){
		$('.crimehead').addClass('readonly-input');
		$('.caseno').removeClass('readonly-input');
		$('.firdate').removeClass('readonly-input');
		// mother.find('.gdeDiv').hide();
		mother.find('.gdeStar').show();
		mother.find(".gdeReq").prop('required',true);
		// mother.find(".gdeReq").prop('disabled',true);
		mother.find(".arrStar").show();
		mother.find(".arrReq").prop('required',true);
		mother.find(".arrReq").prop('disabled',false);
		mother.find('.firDiv').show();
		mother.find('.arrDrop').show();
		mother.find('.arrDrop').prop('disabled',false);
		mother.find('.arrName').hide();
		mother.find('.arrName').prop('disabled',true);
		mother.find('.msg').show();
		mother.find('.WA_NO').hide();
		$('.CASE_YR').addClass('readonly-input');
		$('.CASE_YR').show();
	}
	else if(val == 'WARRANT'){
		mother.find('.arrStar').hide();
		mother.find('.firDiv').hide();
		mother.find(".arrReq").prop('required',false);
		mother.find(".arrReq").prop('disabled',false);
		mother.find('.gdeStar').show();
		mother.find(".gdeReq").prop('required',true);
		mother.find(".gdeReq").prop('disabled',false);
		mother.find('.gdeDiv').show();
		mother.find('.arrDrop').hide();
		mother.find('.msg').show();
		mother.find('.arrDrop').show();
		mother.find('.WA_NO').show();
		$('.crimehead').removeClass('readonly-input');
		$('.CASE_YR').removeClass('readonly-input');
		$('.CASE_YR').hide();
	}
	else if(val == 'PETTY' || val == 'PART-II'){
		$('.crimehead').removeClass('readonly-input');
		$('.crimehead').val('');
		$('.ipcsllact').val('');
		mother.find('.arrStar').show();
		mother.find('.firDiv').hide();
		mother.find(".arrReq").prop('required',true);
		mother.find(".arrReq").prop('disabled',false);
		mother.find('.gdeStar').show();
		mother.find(".gdeReq").prop('required',true);
		mother.find(".gdeReq").prop('disabled',false);
		mother.find('.gdeDiv').show();
		mother.find('.arrDrop').hide();
		mother.find('.arrName').show();
		mother.find('.arrName').prop('disabled',false);
		mother.find('.arrDrop').prop('disabled',true);
		mother.find('.msg').hide();
		mother.find('.WA_NO').hide();
		// $('.CASE_YR').removeClass('readonly-input');
		$('.CASE_YR').hide();
	}
});

$(document).on('change', '.date', function(){
	var mother = $(this).parent().parent().parent().parent();
	var firno = mother.find('.caseno').val();
	var firdate = mother.find('.date').val();
	var fdt = firdate.split("/");
	fdt = fdt[2];
	var firyr = mother.find('#CASE_YR').val(fdt);
	$.ajax({
		url:base_url+module+'/getAccUSDet',
		type:'POST',
		data:{
			fno:firno,
			fyr:fdt
		},
		success:function(data){
			data = JSON.parse(atob(data));
			mother.find('.crimehead').val(data[0]['CATEGORY']);
			mother.find('.ipcsllact').val(data[0]['UNDER_SECTION']);
			var html = "";
			for(d in data){
				var name = data[d]['NAME_ACCUSED'];
				var provcrmno = data[d]['PROV_CRM_NO'];
				html += `<option value ='${provcrmno}|${name}'>${name}</option>`;
			}
			mother.find('.PROV_CRM_NO').html(html);
		}
	});
});

$(document).on('blur','#WA_NO',function(){
	var mother = $(this).parent().parent().parent().parent();
	var wano = $(this).val();
	$.ajax({
		url:base_url+module+'/getWaName',
		type:'POST',
		data:{wano:wano},
		success:function(data){
			data = JSON.parse(atob(data));
			console.log(data);
			var html = "";
			for(d in data){
				var name = data[d]['NAME'];
				html += `<option value ='|${name}'>${name}</option>`;
			}
			mother.find('.PROV_CRM_NO').html(html);
		}
	});
});

$(document).on('click','.arrSave',function(){
	var panel = $(this).closest('.panel');		
	var formObject = panel.find(".1st-data");
	var formObject2 = panel.find(".2nd-data");
	var formData = [];

	formObject.map(function(obj) {
		var temp = {
			'1stData' : $(formObject[obj]).serializeArray(),
			'2ndData' : $(formObject2[obj]).serializeArray()
		}
		formData.push(temp);
	});
	
	var requiredStat = {
		'status' : true,
		'msg' : ''
	}
	for(i in formData) {
		for(d in formData[i]['1stData']) {
			if(formData[i]['1stData'][d]['name']=='ARREST_DATE' && formData[i]['1stData'][d]['value']=='') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Arrest Date";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='HALF' && formData[i]['1stData'][d]['value']=='Select') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Arrest Half";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='ARRAGAINST' && formData[i]['1stData'][d]['value']=='Select') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Arrest Against";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='PROV_CRM_NO' && formData[i]['1stData'][d]['value']=='Select' || formData[i]['1stData'][d]['name']=='ARRESTEE' && formData[i]['1stData'][d]['value']=='') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Arrestee Name";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='SEX' && formData[i]['1stData'][d]['value']=='Select') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Arrest Sex";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='AGE' && formData[i]['1stData'][d]['value']=='') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Age";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='PLACE_ARREST' && formData[i]['1stData'][d]['value']=='') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Place of Arrest";
				break;
			}
			if(formData[i]['1stData'][d]['name']=='ADDRESS' && formData[i]['1stData'][d]['value']=='') {
				requiredStat.status = false;
				requiredStat.msg = "Please fillup the Address";
				break;
			}
		}
		// console.log(formData[i]);
	}

	if(!requiredStat.status) {
		alert(requiredStat.msg);
		return;
	}

	// return;
	$.ajax({
        url: base_url+module+'/insertArrest',
        type: 'POST',
        data: {formData},
         beforeSend: function() { 
       		$(".arrSave").prop('disabled', true); // disable button
    	},
        success: function(resp){
            // server gives responce in format of {'response':'success'}
            respose = JSON.parse(resp);
            if(respose.msg)
            	window.location.href=base_url+module+'/allArrest';
            else
        		alert(respose.msg);
        }
    });
});


/*** APPENDING SECTION ***/
$(document).on('click', '.my-add', function () {
	let mother = $(this).closest('.mother');
	let child = $(this).closest('.child').clone();
	
	/**
	 * *********************************************$(this).attr('class').split(" ")[1];*******************************
	 * Below two lines are rquired only because of Other Accused portion and the *
	 * "else" part as well. These parts are not required in general.			 *
	 * ***************************************************************************
	 */
	let classes = $(this).attr('class').split(' ');
	let slno = $(mother.children()[0]).find(".slno").val();
	
	child.find("input, textarea, select").val("");
	child.find("#fircat").val("FIR");
	child.find(".upload, .view, .event-log").hide();
	mother.append(child);
	mother.children().map(function (obj){
		if(!classes.includes('other-accused')) {
			$(mother.children()[obj]).find(".slno").val(obj+1);
		}
		else {
			$(mother.children()[obj]).find(".slno").val(parseInt(slno)+parseInt(obj));
		}
	});
	
	/**
	 * ************************************************************
	 * This is to initializing the class properties and bind with *
	 * un-rendered(not rendered) objects 						  *
	 * ************************************************************
	 */
	$(".number").keypress(function(event) {
		numberFiledValidate(event);
	});
	jQuery('.datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "dd/mm/yyyy"
    });
    jQuery('.year').datepicker({
        minViewMode: 'years',
        autoclose: true,
        format: 'yyyy'
    });
});

$(document).on('click', '.my-del', function () {
	let mother = $(this).closest('.mother');
	
	/**
	 * ****************************************************************************
	 * Below two lines are rquired only because of Other Accused portion and the *
	 * "else" part as well. These parts are not required in general.			 *
	 * ***************************************************************************
	 */
	let classes = $(this).attr('class').split(' ');
	let slno = $(mother.children()[0]).find(".slno").val();
	
	if(mother.children().size() == 1) {
		alert("Sorry you cannot remove the last one");
		return;
	}
	let child = $(this).closest('.child').remove();
	mother.children().map(function (obj){
		if(!classes.includes('other-accused')) {
			$(mother.children()[obj]).find(".slno").val(obj+1);
		}
		else {
			$(mother.children()[obj]).find(".slno").val(parseInt(slno)+parseInt(obj));
		}
	});
});