var flag = '';
var kmlPath = '';

$(document).ready(function(){
    // SHOW GOOGLE MAP ON PREMISES PAGE
    if ($('#map').length > 0) {
        // GOOGLE MAP
        var details = $('#details').val();
        details = JSON.parse(details);

        var locations = [];
        var sens = [];
        var wp = "";

        for(d in details){
            if(details[d]['WPOL'] == 'Y'){
                wp = base_url+"assets/images/png/wp.png";
            }else{
                wp="";
            }
            var str = [];
            str[0] = "<span class='text-dark'>"
                        +details[d]['PPNAME']+"<br>"
                        +details[d]['ADDR']+"<br>PS: "
                        +details[d]['PS']+"<br>PC: "
                        +details[d]['PC']+"<br>AC: "
                        +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                        +details[d]['BOOTHS']+"</span><br>Premises IC: "
                        +details[d]['ICNAME']+"<br>Mobile No: "
                        +details[d]['ICMOBOLE']+"<br>"
                        +"<img src='"+wp+"'>"+
                    "</span>";
            str[1] = details[d]['Y'];
            str[2] = details[d]['X'];
            locations.push(str);

            sens[d] = details[d]['SENSITIVITY'];
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: new google.maps.LatLng(22.572214, 88.352025),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();
        var marker, i;

        for (i = 0; i < locations.length; i++) {
            var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

            if(sens[i] == 'Normal')
                imgSrc = base_url+"assets/images/png/n.png";
            else if(sens[i] == 'Hypercritical')
                imgSrc = base_url+"assets/images/png/hc.png";
            else if(sens[i] == 'Critical')
                imgSrc = base_url+"assets/images/png/c.png";

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: imgSrc
            });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
          map.setCenter(latLng);
        }
    }
    // SHOW GOOGLE MAP ON BOUNDARIES PAGE
    if ($('#myMap').length > 0) {
        var details = $('#details').val();
        details = JSON.parse(details);

        var locations = [];
        var sens = [];
        var wp = "";
        kmlPath = "https://uploads.kolkatapolice.org/ems/kml/PS_BOUNDARY.kml";

        for(d in details){
            if(details[d]['WPOL'] == 'Y'){
                wp = base_url+"assets/images/png/wp.png";
            }
            var str = [];
            str[0] = "<span class='text-dark'>"
                        +details[d]['PPNAME']+"<br>"
                        +details[d]['ADDR']+"<br>PS: "
                        +details[d]['PS']+"<br>PC: "
                        +details[d]['PC']+"<br>AC: "
                        +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                        +details[d]['BOOTHS']+"</span><br>Premises IC: "
                        +details[d]['ICNAME']+"<br>Mobile No: "
                        +details[d]['ICMOBOLE']+"<br>"
                        +"<img src='"+wp+"'>"+
                    "</span>";
            str[1] = details[d]['Y'];
            str[2] = details[d]['X'];
            locations.push(str);

            sens[d] = details[d]['SENSITIVITY'];
        }

        var map = new google.maps.Map(document.getElementById('myMap'), {
            zoom: 12,
            center: new google.maps.LatLng(22.572214, 88.352025),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var ctaLayer = new google.maps.KmlLayer({
            url: kmlPath,
            map: map
        });
        ctaLayer.setMap(map);

        var infowindow = new google.maps.InfoWindow();
        var marker, i;

        for (i = 0; i < locations.length; i++) {
            var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

            if(sens[i] == 'Normal')
                imgSrc = base_url+"assets/images/png/n.png";
            else if(sens[i] == 'Hypercritical')
                imgSrc = base_url+"assets/images/png/hc.png";
            else if(sens[i] == 'Critical')
                imgSrc = base_url+"assets/images/png/c.png";

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: imgSrc
            });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
          map.setCenter(latLng);
        }
    }    
});

// SHOW ONLY PC
$('#pcSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#divDiv,#sectDiv,#acDiv,#psDiv').hide('slow');
        $('#pcDiv').show('slow');
    }
});

// SHOW ONLY AC
$('#acSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#divDiv,#sectDiv,#pcDiv,#psDiv').hide('slow');
        $('#acDiv').show('slow');
    }
});

// SHOW ONLY DIVN.
$('#divSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#pcDiv,#sectDiv,#acDiv,#psDiv').hide('slow');
        $('#divDiv').show('slow');
    }
});

// SHOW ONLY PS
$('#psSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#pcDiv,#sectDiv,#acDiv,#divDiv').hide('slow');
        $('#psDiv').show('slow');
    }
});

// SHOW ONLY SECTOR
$('#sectSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#pcDiv,#divDiv,#acDiv,#psDiv').hide('slow');
        $('#sectDiv').show('slow');
    }
});

// SHOW ONLY WP
$('#wpSwitch').change(function(){
    if ($(this).is(':checked')) {
        $('#pcDiv,#divDiv,#sectDiv,#acDiv,#psDiv').hide('slow');
    }
});

// APPLY BUTTON OF PREMISES PAGE
$('#applyBtn').click(function(){
    var radioID = $('input[type=radio][name=filter]:checked').attr('id');
    // var flag = '';
    var value = '';

    if (radioID == 'pcSwitch') {
        flag = 'pc';
        value = $('#pcList').val();
    } else if (radioID == 'acSwitch') {
        flag = 'ac';
        value = $('#acList').val();
    } else if (radioID == 'divSwitch') {
        flag = 'div';
        value = $('#divList').val();
    } else if (radioID == 'psSwitch') {
        flag = 'ps';
        value = $('#psList').val();
    } else if (radioID == 'sectSwitch') {
        flag = 'sec';
        value = $('#sectList').val();
    } else if (radioID == 'wpSwitch') {
        flag = 'wps';
    }
    $.ajax({
        type: 'POST',
        url: base_url+'Dashboard/showLocationByFilter',
        data: {
            flag: flag,
            val: value
        },
        success: function(data) {
            var details = JSON.parse(data);
            
            var locations = [];
            var sens = [];
            var wp = "";
            var count = 0;
            for(d in details){
                if(details[d]['WPOL'] == 'Y'){
                    wp = base_url+"assets/images/png/wp.png";
                }
                var str = [];
                str[0] = "<span class='text-dark'>"
                            +details[d]['PPNAME']+"<br>"
                            +details[d]['ADDR']+"<br>PS: "
                            +details[d]['PS']+"<br>PC: "
                            +details[d]['PC']+"<br>AC: "
                            +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                            +details[d]['BOOTHS']+"</span><br>Premises IC: "
                            +details[d]['ICNAME']+"<br>Mobile No: "
                            +details[d]['ICMOBOLE']+"<br>"
                            +"<img src='"+wp+"'>"+
                        "</span>";
                str[1] = details[d]['Y'];
                str[2] = details[d]['X'];
                locations.push(str);

                sens[d] = details[d]['SENSITIVITY'];
                count++;
            }

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(22.572214, 88.352025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

            for (i = 0; i < locations.length; i++) {
                var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

                if(sens[i] == 'Normal')
                    imgSrc = base_url+"assets/images/png/n.png";
                else if(sens[i] == 'Hypercritical')
                    imgSrc = base_url+"assets/images/png/hc.png";
                else if(sens[i] == 'Critical')
                    imgSrc = base_url+"assets/images/png/c.png";

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: imgSrc
                });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
              map.setCenter(latLng);
            }
            $('.mdi-close-circle-outline').trigger('click');
            $('#count').text(count+' Locations Found.');
        }
    });
});

// APPLY BUTTON OF BOUNDARIES PAGE
$('#boundaryApplyBtn').click(function(){
    var radioID = $('input[type=radio][name=filter]:checked').attr('id');
    var value = '';

    if (radioID == 'pcSwitch') {
        flag = 'pc';
        value = $('#pcList').val();
        kmlPath = "https://uploads.kolkatapolice.org/ems/kml/PC_BOUNDARY.kml";
    } else if (radioID == 'acSwitch') {
        flag = 'ac';
        value = $('#acList').val();
        kmlPath = "https://uploads.kolkatapolice.org/ems/kml/AC_BOUNDARY.kml";
    } else if (radioID == 'divSwitch') {
        flag = 'div';
        value = $('#divList').val();
        kmlPath = "PATH TO DIV KML";
    } else if (radioID == 'psSwitch') {
        flag = 'ps';
        value = $('#psList').val();
        kmlPath = "https://uploads.kolkatapolice.org/ems/kml/PS_BOUNDARY.kml";
    } else if (radioID == 'sectSwitch') {
        flag = 'sec';
        value = $('#sectList').val();
        kmlPath = "PATH TO SECTOR KML";
    } else if (radioID == 'wpSwitch') {
        flag = 'wps';
        kmlPath = "PATH TO WP KML";
    }
    $.ajax({
        type: 'POST',
        url: base_url+'Dashboard/showLocationByFilter',
        data: {
            flag: flag,
            val: value
        },
        success: function(data) {
            var details = JSON.parse(data);
            
            var locations = [];
            var sens = [];
            var wp = "";
            var count = 0;
            for(d in details){
                if(details[d]['WPOL'] == 'Y'){
                    wp = base_url+"assets/images/png/wp.png";
                }
                var str = [];
                str[0] = "<span class='text-dark'>"
                            +details[d]['PPNAME']+"<br>"
                            +details[d]['ADDR']+"<br>PS: "
                            +details[d]['PS']+"<br>PC: "
                            +details[d]['PC']+"<br>AC: "
                            +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                            +details[d]['BOOTHS']+"</span><br>Premises IC: "
                            +details[d]['ICNAME']+"<br>Mobile No: "
                            +details[d]['ICMOBOLE']+"<br>"
                            +"<img src='"+wp+"'>"+
                        "</span>";
                str[1] = details[d]['Y'];
                str[2] = details[d]['X'];
                locations.push(str);

                sens[d] = details[d]['SENSITIVITY'];
                count++;
            }

            var map = new google.maps.Map(document.getElementById('myMap'), {
                zoom: 12,
                center: new google.maps.LatLng(22.572214, 88.352025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var ctaLayer = new google.maps.KmlLayer({
                url: kmlPath,
                map: map
            });
            ctaLayer.setMap(map);

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

            for (i = 0; i < locations.length; i++) {
                var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

                if(sens[i] == 'Normal')
                    imgSrc = base_url+"assets/images/png/n.png";
                else if(sens[i] == 'Hypercritical')
                    imgSrc = base_url+"assets/images/png/hc.png";
                else if(sens[i] == 'Critical')
                    imgSrc = base_url+"assets/images/png/c.png";

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: imgSrc
                });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
              map.setCenter(latLng);
            }
            $('.mdi-close-circle-outline').trigger('click');
            $('#count').text(count+' Locations Found.');
        }
    });
});

// RESET BUTTON OF BOUNDARIES PAGE
$('#resetBtn').click(function(){
    $('#pcSwitch,#acSwitch,#divSwitch,#psSwitch,#sectSwitch,#wpSwitch').prop('checked',false);
    $('#pcDiv,#divDiv,#sectDiv,#acDiv,#psDiv').hide('slow');
    $('.bs-deselect-all').trigger('click');
    $('#sectList').val('');

    $.ajax({
        type: 'POST',
        url: base_url+'Dashboard/showLocationByFilter',
        data: {
            flag: 'reset',
            val: ''
        },
        success: function(data) {
            var details = JSON.parse(data);
            
            var locations = [];
            var sens = [];
            var wp = "";
            var count = 0;
            
            for(d in details){
                if(details[d]['WPOL'] == 'Y'){
                    wp = base_url+"assets/images/png/wp.png";
                }
                var str = [];
                str[0] = "<span class='text-dark'>"
                            +details[d]['PPNAME']+"<br>"
                            +details[d]['ADDR']+"<br>PS: "
                            +details[d]['PS']+"<br>PC: "
                            +details[d]['PC']+"<br>AC: "
                            +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                            +details[d]['BOOTHS']+"</span><br>Premises IC: "
                            +details[d]['ICNAME']+"<br>Mobile No: "
                            +details[d]['ICMOBOLE']+"<br>"
                            +"<img src='"+wp+"'>"+
                        "</span>";
                str[1] = details[d]['Y'];
                str[2] = details[d]['X'];
                locations.push(str);

                sens[d] = details[d]['SENSITIVITY'];
                count++;
            }

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: new google.maps.LatLng(22.572214, 88.352025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

            for (i = 0; i < locations.length; i++) {
                var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

                if(sens[i] == 'Normal')
                    imgSrc = base_url+"assets/images/png/n.png";
                else if(sens[i] == 'Hypercritical')
                    imgSrc = base_url+"assets/images/png/hc.png";
                else if(sens[i] == 'Critical')
                    imgSrc = base_url+"assets/images/png/c.png";

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: imgSrc
                });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
              map.setCenter(latLng);
            }
            $('#count').text(count+' Locations Found.');
        }
    });
});

// RESET BUTTON OF BOUNDARIES PAGE
$('#boundaryResetBtn').click(function(){
    $('#pcSwitch,#acSwitch,#divSwitch,#psSwitch,#sectSwitch,#wpSwitch').prop('checked',false);
    $('#pcDiv,#divDiv,#sectDiv,#acDiv,#psDiv').hide('slow');
    $('.bs-deselect-all').trigger('click');
    $('#sectList').val('');
    kmlPath = "https://uploads.kolkatapolice.org/ems/kml/PS_BOUNDARY.kml";

    $.ajax({
        type: 'POST',
        url: base_url+'Dashboard/showLocationByFilter',
        data: {
            flag: 'reset',
            val: ''
        },
        success: function(data) {
            var details = JSON.parse(data);
            
            var locations = [];
            var sens = [];
            var wp = "";
            var count = 0;
            
            for(d in details){
                if(details[d]['WPOL'] == 'Y'){
                    wp = base_url+"assets/images/png/wp.png";
                }
                var str = [];
                str[0] = "<span class='text-dark'>"
                            +details[d]['PPNAME']+"<br>"
                            +details[d]['ADDR']+"<br>PS: "
                            +details[d]['PS']+"<br>PC: "
                            +details[d]['PC']+"<br>AC: "
                            +details[d]['AC']+"<br>Booths: <span class='badge badge-teal'>"
                            +details[d]['BOOTHS']+"</span><br>Premises IC: "
                            +details[d]['ICNAME']+"<br>Mobile No: "
                            +details[d]['ICMOBOLE']+"<br>"
                            +"<img src='"+wp+"'>"+
                        "</span>";
                str[1] = details[d]['Y'];
                str[2] = details[d]['X'];
                locations.push(str);

                sens[d] = details[d]['SENSITIVITY'];
                count++;
            }

            var map = new google.maps.Map(document.getElementById('myMap'), {
                zoom: 12,
                center: new google.maps.LatLng(22.572214, 88.352025),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            var ctaLayer = new google.maps.KmlLayer({
                url: kmlPath,
                map: map
            });
            ctaLayer.setMap(map);

            var infowindow = new google.maps.InfoWindow();
            var marker, i;

            for (i = 0; i < locations.length; i++) {
                var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);

                if(sens[i] == 'Normal')
                    imgSrc = base_url+"assets/images/png/n.png";
                else if(sens[i] == 'Hypercritical')
                    imgSrc = base_url+"assets/images/png/hc.png";
                else if(sens[i] == 'Critical')
                    imgSrc = base_url+"assets/images/png/c.png";

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: imgSrc
                });

              google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                  infowindow.setContent(locations[i][0]);
                  infowindow.open(map, marker);
                }
              })(marker, i));
              map.setCenter(latLng);
            }
            $('#count').text(count+' Locations Found.');
        }
    });
});