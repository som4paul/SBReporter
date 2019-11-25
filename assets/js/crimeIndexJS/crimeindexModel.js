/**
 * ========================================================
 *                                                        *
 *                 JavaScript Objects                     *
 *                                                        *
 * ========================================================
 */

var Fir = function() {};
var Complainant = function() {};
var Incident = function() {};
var UnderSection = function() {};
var ChargeSheet = function() {};
var Court = function() {};
var Victims = function() {};
var Accuseds = function() {};
var OtherAccuseds = function() {};
var PersonArrested = function() {};
var Seizure = function() {};
var Recovery = function() {};


/**
 * ========================================================
 *                                                        *
 *               JavaScript Object Properties             *
 *                                                        *
 * ========================================================
 */

Fir.prototype.permissionCheck = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/prermissionCheck', myData);
	return resp;
}

Fir.prototype.getIO = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/getIO', myData);
	return resp;
}

Fir.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveFirDetails', myData);
	return resp;
}

Fir.prototype.receive = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/receiveFIR', myData);
	return resp;
}

Complainant.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveComplainantDetails', myData);
	return resp;
}

Incident.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveIncidentDetails', myData);
	return resp;
}

UnderSection.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveUnderSection', myData);
	return resp;
}

ChargeSheet.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveChargeSheet', myData);
	return resp;
}

Court.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveCourtDetails', myData);
	return resp;
}

Victims.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveVictimDetails', myData);
	return resp;
}

Accuseds.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveAccusedDetails', myData);
	return resp;
}

Accuseds.prototype.uploadImage = function(dataObj, progressObj) {
	dataObj.upload(base_url+'CrimeIndex/uploadPhoto', function(resp) {
		if(resp.status) {
			alert(resp.msg);
	    }
	    else if(Object.keys(resp)[0]=='status'){
	    	let parser = new DOMParser();
	    	let xmlDoc = parser.parseFromString(resp.msg, "text/xml");
	    	resp.msg = xmlDoc.getElementsByTagName("p")[0].childNodes[0].nodeValue;
	    	alert(resp.msg);
	    }
	    else {
	    	alert($(resp).find('p').text());
	    }
	},
	function(prog, value) {
		$(progressObj).val(value);
	});
}

Accuseds.prototype.uploadVoice = function(dataObj, progressObj) {
	dataObj.upload(base_url+'CrimeIndex/uploadVoice', function(resp) {
		if(resp.status) {
			alert(resp.msg);
	    }
	    else if(Object.keys(resp)[0]=='status'){
	    	let parser = new DOMParser();
	    	let xmlDoc = parser.parseFromString(resp.msg, "text/xml");
	    	resp.msg = xmlDoc.getElementsByTagName("p")[0].childNodes[0].nodeValue;
	    	alert(resp.msg);
	    }
	    else {
	    	alert($(resp).find('p').text());
	    }
	},
	function(prog, value) {
		$(progressObj).val(value);
	});
}

Accuseds.prototype.uploadIris = function(leftIris, rightIris, progressObj) {
	leftIris.add(rightIris).upload(base_url+'CrimeIndex/uploadIris', function(resp) {
		if(resp.status) {
			alert(resp.msg);
	    }
	    else if(Object.keys(resp)[0]=='status'){
	    	let parser = new DOMParser();
	    	let xmlDoc = parser.parseFromString(resp.msg, "text/xml");
	    	resp.msg = xmlDoc.getElementsByTagName("p")[0].childNodes[0].nodeValue;
	    	alert(resp.msg);
	    }
	    else {
	    	alert($(resp).find('p').text());
	    }
	},
	function(prog, value) {
		$(progressObj).val(value);
	});
}

Accuseds.prototype.uploadFingers = function(leftFingers, rightFingers, thumbs, progressObj) {
	leftFingers.add(rightFingers).add(thumbs).upload(base_url+'CrimeIndex/uploadFingers', function(resp) {
		if(resp.status) {
			alert(resp.msg);
	    }
	    else if(Object.keys(resp)[0]=='status'){
	    	let parser = new DOMParser();
	    	let xmlDoc = parser.parseFromString(resp.msg, "text/xml");
	    	resp.msg = xmlDoc.getElementsByTagName("p")[0].childNodes[0].nodeValue;
	    	alert(resp.msg);
	    }
	    else {
	    	alert($(resp).find('p').text());
	    }
	},
	function(prog, value) {
		$(progressObj).val(value);
	});
}

Accuseds.prototype.getBio = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/getAccusedBiometric', myData);
	return resp;
}
Accuseds.prototype.saveBio = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveAccusedBiometric', myData);
	return resp;
}

PersonArrested.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveArresteDetails', myData);
	return resp;
}

PersonArrested.prototype.saveArresteeToAccused = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveArresteeToAccused', myData);
	return resp;
}


Seizure.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveSeizureDetails', myData);
	return resp;
}

Recovery.prototype.save = function(myData) {
	var httpObject = new Request();
	myData = JSON.stringify(myData);
	var resp = httpObject.post(base_url+'CrimeIndex/saveRecoveryDetails', myData);
	return resp;
}
