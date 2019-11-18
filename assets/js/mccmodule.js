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
$("#mydiv").html('<object data="https://maps.app.goo.gl/hAB6C6FEcTyAqhzk9"/>');
