$(document).ready(function(){
	var vals = $('#param').val();
	// alert(vals);
	if(typeof(vals) !== 'undefined' && vals != ''){
		vals = vals.split("|");
		searchCase(vals[0],vals[1],vals[2],'data');
	}
});

$(".number").keypress(function(event) {
	numberFiledValidate(event);
});

function searchCase(ps,caseYear,FirNo,type) {
	if(typeof(type) === 'undefined'){
		var ps = $("select[name='PS']").val();
		var caseYear = $("input[name='CASEYEAR']").val();
		var FirNo = $("input[name='FIRNO']").val();	
	}
	var param = "ps="+ps+ "&" +"caseYear="+caseYear+ "&" +"firNo="+FirNo;
	var url = base_url+'CrimeIndex/search?'+param;

	if($.fn.dataTable.isDataTable($('#datatable'))){
		$("#datatable").DataTable().destroy();
		$('#datatable').DataTable({
			"ajax" : url
		});
	}
	else {
		$('#datatable').DataTable({
			"ajax" : url
		});
	}
}
$("#search-btn").click(function (){
	var formData = $("#searchPannel").serializeArray();
	var requiredFlag = {
	        flagVal: false
	    };
	
	formData.map(function (obj) {
		if(obj.name == 'PS' && obj.value == 'select')
		    requiredFlag = {
		        flagVal: true,
		        msg: 'Select a PS'
		    };
	    else if (obj.name == 'CASEYEAR' && obj.value == '')
	        requiredFlag = {
	            flagVal: true,
	            msg: 'Select a Year'
	        };
	});
	
	if(requiredFlag.flagVal) {
		alert(requiredFlag.msg);
    }
    else {
    	$(this).html("<i class='fa fa-spin fa-cog'></i><i class='fa fa-spin fa-cog'></i><i class='fa fa-spin fa-cog'></i>");
    	searchCase();
        $(this).html('<i class="glyphicon glyphicon-search"></i> Search');
    }
});

$(document).on('click', '.receive', function () {
	let val = $(this).attr('href');
	$("input[name='courtDetails']").val(val);
	$("input[name='rcv-btn-id']").val($(this).attr('id'));
});

$(".saveCourtData").click(function () {
	var formData = $("#crtReceive").serializeArray()
	var firObj = new Fir();
	var resp = firObj.receive(formData);
	resp = JSON.parse(resp);

	/**
	 * Render Updated Search result
	 */
	if(resp.status) {
		alert(resp.msg);
		searchCase();
	}
	else {
		alert(resp.msg);
	}
});

$("a").click(function () {
	var elementClass = $(this).attr("class").split(' ');
	if(elementClass.includes('cancel')){
		location.reload();
	}
	else if(elementClass.includes('edit')){
		var flag = true;
		if(!elementClass.includes('PS') && !elementClass.includes('CRS,') && !elementClass.includes('CRT')){
			var ps = elementClass[0];
			var caseNo = $(".firNo").html().split(" ")[1];
			var caseYear = $(".firYear").html().trim();			
			var myData = {
				"PS" : ps,
				"CASENO" : caseNo,
				"CASE_YR" : caseYear
			};
			firObj = new Fir();
			var resp = firObj.permissionCheck(myData);
			resp = JSON.parse(resp);
			// alert(resp.status);return;
			if(resp.status == 'true' && elementClass.includes(resp.data.TO_UNIT) && elementClass.includes(resp.data.TO_PS))
				flag = true;
			else
				flag = false;
		}
		if(flag == false) {
			alert("Permission Denied");
			return;
		}
		$(this).removeClass("edit");
		$(this).addClass("update");
		$(this).html('<i class="glyphicon glyphicon-check "></i> Update');
		var mother = $(this).parent().parent();
		mother.children("div:eq(0 )").children(".cancel").show();
		mother.children("div:eq(0)").children("i").removeClass("fa fa-circle m-l-5 text-pink");
		mother.children("div:eq(0)").children("i").addClass("fa fa-circle m-l-5 text-success");
		mother.children("div:eq(1)").removeClass("readonly");
	}
	else if(elementClass.includes('update')){
		var mother = $(this).parent().parent();
		var ps = elementClass[0];
		var caseNo = $(".firNo").html().split(" ")[1];
		var caseYear = $(".firYear").html().trim();
		var formObject = mother.find("form");
		var formData = [];
		formObject.map(function(obj) {
			formData.push($(formObject[obj]).serializeArray());
		});
		formData.push({
			"PS" : ps,
			"CASENO" : caseNo,
			"CASEDATE" : caseYear
		});
		switch(elementClass[elementClass.length-2]) {
			case "firDetails":
				var requiredFlag = {
			        flagVal: false
			    };
				formData[0].map(function (obj) {
					if(obj.name == 'IO' && (obj.value == 'select' || obj.value == 'Not Assigned'))
					    requiredFlag = {
					        flagVal: true,
					        msg: 'Select a IO'
					    };
				});
				if(requiredFlag.flagVal) {
					alert(requiredFlag.msg);
					return;
			    }
				else {
					var firObj = new Fir();
					var resp = firObj.save(formData);
					resp = JSON.parse(resp);
				} 
				break;
			case "complainantDetails":
				var complainantObj = new Complainant();
				var resp = complainantObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "incidentDetails":
				var incidentObj = new Incident();
				var resp = incidentObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "underSection":
				var underSectionObj = new UnderSection();
				var resp = underSectionObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "chargesheetDetails":
				var chargeSheetObj = new ChargeSheet();
				var resp = chargeSheetObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "courtDetails":
				var courtObj = new Court();
				var resp = courtObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "firNamedVictims":
				var victimObj = new Victims();
				var resp = victimObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "firAccused":
				formData[formData.length-1].FIRCAT = "FIR";
				var firAccusedObj = new Accuseds();
				var resp = firAccusedObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "otherAccused":
				formData[formData.length-1].FIRCAT = "OTHER";
				var firAccusedObj = new Accuseds();
				var resp = firAccusedObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "personArrested":
				var arresteObj = new PersonArrested();
				var resp = arresteObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "seizureDetails":
				var seizureObj = new Seizure();
				var resp = seizureObj.save(formData);
				resp = JSON.parse(resp);
				break;
			case "recoveryDetails":
				var recoveryObj = new Recovery();
				var resp = recoveryObj.save(formData);
				resp = JSON.parse(resp);
				break;
		}
		if(resp.status) {
			alert(resp.msg);
		}
		else {
			alert(resp.msg);						
		}
		$(this).removeClass("update");
		$(this).addClass("edit");
		$(this).html('<i class="glyphicon glyphicon-edit"></i> Edit');
		mother.children("div:eq(0)").children(".cancel").hide();
		mother.children("div:eq(0)").children("i").removeClass("fa fa-circle m-l-5 text-success");
		mother.children("div:eq(0)").children("i").addClass("fa fa-circle m-l-5 text-pink");
		mother.children("div:eq(1)").addClass("readonly");
		if(resp.insertFlag) {
			location.reload();
		}
	}
});

$("select[name='OTHER_UNIT']").change(function () {
	var unit = $(this).val();
	var myData = {
		"unit" : unit	
	};
	var firObj = new Fir();
	var resp = firObj.getIO(myData);
	resp = JSON.parse(resp);
	var html = "<option>select</option>";
	for (d in resp) {
		html += `<option value='${resp[d].IOCODE}|${resp[d].IONAME}'>${resp[d].IONAME}</option>`;
		// html += "<option value='"+resp[d].IOCODE+"'>"+resp[d].IONAME+"</option>";
	}
	$("select[name='IO']").html(html);
});

$(".mapMarker").click(function () {
	var initlLat = $("#lat").val();
	var initlLong = $("#long").val();

	if(initlLat == "0" || initlLat == "0" || initlLat == "" || initlLong =="") {
		callMap();
	}
	else {
		myMap(parseFloat(initlLat), parseFloat(initlLong));
	}
});

$("select[name='US_CLASS']").change(function () {
	let cat = $(this).val();
	let html = "<option>select</option>";
	for(d in underSections[cat]) {
		html += `<option value='${underSections[cat][d].CATEGORY}'>${underSections[cat][d].CATEGORY}</option>`;
	}
	$("select[name='CATEGORY']").html(html);
});

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
	let slno = $(mother.children()[0]).find("input[name='SLNO']").val();
	child.find("input, textarea").val("");
	child.find("select").val("select");
	child.find(".upload, .view, .event-log").hide();
	mother.append(child);
	mother.children().map(function (obj){
		if(!classes.includes('other-accused')) {
			$(mother.children()[obj]).find("input[name='SLNO']").val(slno);
			slno++;
		}
		else {
			$(mother.children()[obj]).find("input[name='SLNO']").val(parseInt(slno)+parseInt(obj));
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
	let slno = $(mother.children()[0]).find("input[name='SLNO']").val();
	
	if(mother.children().size() == 1) {
		alert("Sorry you cannot remove the last one");
		return;
	}
	let child = $(this).closest('.child').remove();
	mother.children().map(function (obj){
		if(!classes.includes('other-accused')) {
			$(mother.children()[obj]).find("input[name='SLNO']").val(obj+1);
		}
		else {
			$(mother.children()[obj]).find("input[name='SLNO']").val(parseInt(slno)+parseInt(obj));
		}
	});
});

$(".upload").click(function() {
	let provCrmNo = $(this).attr('class').split(" ")[0];
	let year = $(".firYear").html().trim();
	$("#criminal-photo").attr('name', provCrmNo+"|"+year);
	$("#criminal-voice").attr('name', provCrmNo+"|"+year);
	
	$("#criminal-iris-left").attr('name', provCrmNo+"-L|"+year);
	$("#criminal-iris-right").attr('name', provCrmNo+"-R|"+year);
	
	$("#criminal-finger-left").attr('name', provCrmNo+"-L|"+year);
	$("#criminal-finger-right").attr('name', provCrmNo+"-R|"+year);
	$("#criminal-finger-thumb").attr('name', provCrmNo+"-T|"+year);
	$('video').get(0).currentTime = 0;
});

$(".upload-photo").click(function() {
	$(this).prop('disabled', true);
	let imgObj = $("#criminal-photo");
	let progressObj = $("#photo-prog");
	let accusedObj = new Accuseds();
	accusedObj.uploadImage(imgObj, progressObj);
	$(this).prop('disabled', false);
});

$(".upload-voice").click(function() {
	$(this).prop('disabled', true);
	let voiceObj = $("#criminal-voice");
	let progressObj = $("#voice-prog");
	let accusedObj = new Accuseds();
	accusedObj.uploadVoice(voiceObj, progressObj);
	$(this).prop('disabled', false);
});

$(".upload-iris").click(function() {
	$(this).prop('disabled', true);
	let irisLeft = $("#criminal-iris-left");
	let irisRight = $("#criminal-iris-right");
	let progressObj = $("#iris-prog");
	let accusedObj = new Accuseds();
	accusedObj.uploadIris(irisLeft, irisRight, progressObj);
	$(this).prop('disabled', false);
});

$(".upload-finger").click(function() {
	$(this).prop('disabled', true);
	let fingerLeft = $("#criminal-finger-left");
	let fingerRight = $("#criminal-finger-right");
	let fingerThumb = $("#criminal-finger-thumb");
	let progressObj = $("#finger-prog");
	let accusedObj = new Accuseds();
	accusedObj.uploadFingers(fingerLeft, fingerRight, fingerThumb, progressObj);
	$(this).prop('disabled', false);
});

$(".view").click(function() {
	let provCrmNo = $(this).attr('class').split(" ")[0];
	let year = $(".firYear").html().trim();
	let data = {
		"provCrmNo" : provCrmNo,
		"year" : year
	};
	
	$(".viewPhoto").html();
	$(".viewVoice").html();
	$(".viewIris").html();
	$(".viewFingers").html();
	$("#biometric").find("select").val("select");
	$("#biometric").find("input").val("");
	$("#biometric").find("input[name='PROV_CRM_NO']").val(provCrmNo);
	
	var firAccusedObj = new Accuseds();
	var resp = firAccusedObj.getBio(data);
	
	resp = JSON.parse(resp);
	let html = "";
	if(Array.isArray(resp.crsPhoto)) {
		for(var d in resp.crsPhoto) {
			html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/criminal_pic/"+resp.crsPhoto[d].picYear+"/"+resp.crsPhoto[d].PHOTONO+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/criminal_pic/"+resp.crsPhoto[d].picYear+"/"+resp.crsPhoto[d].PHOTONO+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html += "</div>";
		}
	}
	if(Array.isArray(resp.photo)) {
		for(var d in resp.photo) {
			html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/criminal_temp_pic/"+resp.year+"/"+resp.photo[d].PHOTO_NO+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/criminal_temp_pic/"+resp.year+"/"+resp.photo[d].PHOTO_NO+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html += "</div>";
		}
	}
	if(!resp.hasOwnProperty('crsPhoto') && !Array.isArray(resp.photo)) {
		html += "<div class='col-sm-4'>";
		html +=		resp.photo;
        html += "</div>";
	}
	$(".viewPhoto").html(html);
	
	html = "";
	if(Array.isArray(resp.voice)) {
		for(var d in resp.voice) {
			html += "<div class='col-sm-4'>";
			html +=		"<audio controls>";	
	        html +=    		"<source src='https://uploads.kolkatapolice.org/crsapp/criminal_audio/"+resp.year+"/"+resp.voice[d].AUDIO_LOCATION+"' type='audio/ogg'>";
	        html +=		"</audio>";
	        html += "</div>";
		}
	}
	else {
		html += "<div class='col-sm-4'>";
		html +=		resp.voice;
        html += "</div>";
	}
	$(".viewVoice").html(html);
	
	html = "";
	if(Array.isArray(resp.iris)) {
		for(var d in resp.iris) {
			html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/biometric/iris/left/"+resp.year+"/"+resp.iris[d].LEFT_IRIS+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/biometric/iris/left/"+resp.year+"/"+resp.iris[d].LEFT_IRIS+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html +=    	"<p class='m-t-15 m-b-0'>";
	        html +=        "<code>Left Iris</code>";
	        html +=    	"</p>";
	        html += "</div>";
	        html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/biometric/iris/right/"+resp.year+"/"+resp.iris[d].RIGHT_IRIS+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/biometric/iris/right/"+resp.year+"/"+resp.iris[d].RIGHT_IRIS+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html +=    	"<p class='m-t-15 m-b-0'>";
	        html +=        "<code>Right Iris</code>";
	        html +=    	"</p>";
	        html += "</div>";
		}
	}
	else {
		html += "<div class='col-sm-4'>";
		html +=		resp.iris;
        html += "</div>";
	}
	$(".viewIris").html(html);
	
	html = "";
	if(Array.isArray(resp.fingers)) {
		for(var d in resp.fingers) {
			html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/left/"+resp.year+"/"+resp.fingers[d].LEFT_HAND+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/left/"+resp.year+"/"+resp.fingers[d].LEFT_HAND+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html +=    	"<p class='m-t-15 m-b-0'>";
	        html +=        "<code>Left Four Fingers</code>";
	        html +=    	"</p>";
	        html += "</div>";
	        html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/right/"+resp.year+"/"+resp.fingers[d].RIGHT_HAND+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/right/"+resp.year+"/"+resp.fingers[d].RIGHT_HAND+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html +=    	"<p class='m-t-15 m-b-0'>";
	        html +=        "<code>Right Four Fingers</code>";
	        html +=    	"</p>";
	        html += "</div>";
	        html += "<div class='col-sm-4'>";
			html +=		"<a href='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/thumb/"+resp.year+"/"+resp.fingers[d].THUMBS+"' target='_blank'>";	
	        html +=    		"<img src='https://uploads.kolkatapolice.org/crsapp/biometric/fingers/thumb/"+resp.year+"/"+resp.fingers[d].THUMBS+"' alt='image' class='img-responsive img-thumbnail' width='200'>";
	        html +=		"</a>";
	        html +=    	"<p class='m-t-15 m-b-0'>";
	        html +=        "<code>Thumbs</code>";
	        html +=    	"</p>";
	        html += "</div>";
		}
	}
	else {
		html += "<div class='col-sm-4'>";
		html +=		resp.fingers;
        html += "</div>";
	}
	$(".viewFingers").html(html);
	
	for(var d in resp.biometric[0]) {
		if(resp.biometric[0][d]!=null)
			$("#biometric").find("input[name='"+d+"'], select[name='"+d+"']").val(resp.biometric[0][d]);
	}
});

$(".saveBiometric").click(function () {
	var formData = $("#biometric").serializeArray();
	var firAccusedObj = new Accuseds();
	var resp = firAccusedObj.saveBio(formData);
	resp = JSON.parse(resp);
	if(resp.status) {
		alert(resp.msg);
	}
	else {
		alert(resp.msg);						
	}
});

$(".addAccused").click(function () {
	var classes = $(this).attr('class').split(" ");
	var form = $(this).closest('form');
	var caseNo = $(".firNo").html().split(" ")[1];
	var caseYear = $(".firYear").html().trim();		
	var formData = {
			'PS' : classes[0],
			'PROV_CRM_NO' : classes[4],
			'CASENO' : caseNo,
			'CASE_YR' : caseYear,
			'NAME_ACCUSED' : form.find("input[name='ARRESTEE']").val(),
			'ALIAS1' : form.find("input[name='ALIASNAME']").val(),
			'ADDR_ACCUSED' : form.find("textarea[name='ADDRESS']").val(),
			'SEX_ACCUSED' : form.find("select[name='SEX']").val(),
			'AGE_ACCUSED' : form.find("input[name='AGE']").val(),
			'FATHER_ACCUSED' : form.find("input[name='FATHER_HUSBAND']").val()
	};
	if(confirm("Do you want to save the person as Other Accused")) {
		var obj = new PersonArrested();
		var resp = obj.saveArresteeToAccused(formData);
		resp = JSON.parse(resp);
		if(resp.status) {
			alert(resp.msg);
			location.reload();
		}
		else {
			alert(resp.msg);
		}
	}
});