var searchval = '';

$(document).ready(function(){
    if($("#sbynm").is(':checked')){
        callSearch('nmsearch','phsearch');
    } else if($("#sbyph").is(':checked')) {
        callSearch('phsearch','nmsearch');
    } else {
        $('#nmsearch').hide();
        $('#phsearch').hide();
        $('#caselist').hide();
        $('.ldr').css('display','none');
    }
    $('#reset1').hide();
    $('#reset2').hide();
    $('#filterpanel').hide();
});

$('#sbynm').click(function(){
    callSearch('nmsearch','phsearch');
});

$('#sbyph').click(function(){
    callSearch('phsearch','nmsearch');
});

function callSearch(show_id, hide_id){
    $('#'+hide_id).hide('slow');
    $('#'+show_id).show('slow');
    $('#caselist').hide();
    $('.ldr').hide();
    searchval = show_id;
}

$('#criminalname').keyup(function(){
  $('#search').prop('disabled',false);  
  // $('#phsrch').prop('readonly','');
});

function ajaxcriminalsearch(target){
  $('#search').prop('disabled',true);
  // $('#phsrch').prop('readonly','readonly');
  
  var name = $('#criminalname').val();
  var phsearch = $('#phsrch').val();
  if(phsearch == 'off')
    var url = base_url+module+'/criminalNameSearch';
  else 
    var url = 'https://api.kolkatapolice.org/crimebabuapp/Api/Indexing/';
  
  ajaxdatasearch(url,name,target);
}

$('#apply').click(function(){
  $('#apply').attr('disabled',true);
  var name = $('#criminalname').val();
  var filterattr = $('#filterattr').val();
  var url = base_url+module+'/criminalNameSearch';
  var target = '#home1';
  $('#caselist').hide();
  $('#reset2').show();
  ajaxdatasearch(url,name,target,filterattr);

});

function ajaxdatasearch(url,name,target,filter=""){
  $.ajax({
      url:url,
      type:'POST',
      data:{
        NAME:name,
        target:target,
        filter:filter
      },
      beforeSend:function(){
       $('.ldr').css('display','block');
      },
      success:function(data){
        data = JSON.parse(data);
        var html='';
        if(target == '#home1'){
          for (var i=0; i < data['result'].length; i++){
              html+="<tr>";
              html+="<td>"+parseInt(i+1)+"</td>";
              html+="<td>"+data['result'][i]['NAME']+"</td>";
              html+="<td>"+data['result'][i]['FATHER_HUSBAND_NAME']+"</td>";
              html+="<td>"+data['result'][i]['ADDRESS']+"</td>";
              html+="<td>"+data['result'][i]['age']+"</td>";
              html+="<td style = 'text-align:center'><img src='"+data['result'][i]['photopath']+"'width = 100 height = 120><br><button type ='button' value="+data['result'][i]['PROV_CRM_NO']+"|"+data['result'][i]['CRIMEYEAR']+"|"+data['result'][i]['CRIMENO']+" class='crimeimg btn btn-sm btn-group'><i class='glyphicon glyphicon-picture'></i>More Images</button></td>";
              // html+="<td style = 'text-align:center'><button type ='button' value="+data['result'][i]['PROV_CRM_NO']+"|"+data['result'][i]['CASE_YR']+" class='crimeimg btn btn-group'><i class='glyphicon glyphicon-picture'></i></button></td>";
              html+="<td style = 'text-align:center'><a target='_blank' href='"+base_url+"Search/criminaldet/"+myEncode_js(data['result'][i]['PROV_CRM_NO'])+"'><i class='glyphicon glyphicon-search'></i></a></td>";
              html+="</tr>";
          }
          $('#reset1').show();
          $('.criminalTable').DataTable().clear().destroy();
          $('.crimelist').html(html);
          $('.criminalTable').DataTable().draw();
          $('#filterpanel').show('slow');
          $('#apply').attr('disabled',false);
        }
        else if(target == '#profile1'){
          html='';
          for (var i=0; i < data['other_details'].length; i++){
              html+="<tr>";
              html+="<td>"+parseInt(i+1)+"</td>";
              html+="<td>"+data['other_details'][i]['NAME']+"</td>";
              html+="<td>"+data['other_details'][i]['SDW_NAME']+"</td>";
              html+="<td>"+data['other_details'][i]['RESI_ADDRESS']+"</td>";
              html+="<td>"+data['other_details'][i]['ALIASES']+"</td>";
              html+="<td>"+data['other_details'][i]['ASSOCIATES']+"</td>";
              html+="</tr>"; 
              
          }
          $('.criminalotherTable').DataTable().clear().destroy();
          $('.crimeotherlist').html(html);
          $('.criminalotherTable').DataTable().draw();
        }
      $('#caselist').show('slow');
      $('.ldr').css('display','none');
      },
  });
}

function ajaxcriminalphsearch(target){
  var phno = $('#photono').val();
  var url = 'https://api.kolkatapolice.org/crimebabuapp/Api/photomatch/';

  $.ajax({
        url:url,
        type:'POST',
        data:{PHOTONO:phno,target:target},
        beforeSend:function(){
         $('.ldr').css('display','block');
        },
        success:function(data){
          data = JSON.parse(data);
          var html = '';
          if(target == '#home1'){
            for (var i=0; i < data['result'].length; i++){
                html+="<tr>";
                html+="<td>"+i+"</td>";
                html+="<td>"+data['result'][i]['NAME']+"</td>";
                html+="<td>"+data['result'][i]['FATHER_HUSBAND_NAME']+"</td>";
                html+="<td>"+data['result'][i]['ADDRESS']+"</td>";
                html+="<td style = 'text-align:center'><button type ='button' value="+data['result'][i]['PROV_CRM_NO']+"|"+data['result'][i]['CASE_YR']+" class='crimeimg btn btn-group'><i class='glyphicon glyphicon-picture'></i></button></td>";
                html+="<td style = 'text-align:center'><a target='_blank' href='"+base_url+"Search/criminaldet/"+myEncode_js(data['result'][i]['PROV_CRM_NO'])+"'><i class='glyphicon glyphicon-search'></i></a></td>";
                html+="</tr>";
            }
            $('.criminalTable').DataTable().clear().destroy();
            $('.crimelist').html(html);
            $('.criminalTable').DataTable().draw();
          }
          // else{
          //   $('.criminalotherTable').DataTable().clear().destroy();
          //   $('.crimeotherlist').html(data);
          //   $('.criminalotherTable').DataTable().draw();
          // }
        $('#caselist').show('slow');
        $('.ldr').css('display','none');
        },
    });
}

$('#division').change(function(){
  $('#PS').html('<option>Loading.....</option>');
    var div = $('#division').val();
    $.ajax({
        url:base_url+'Report/getPsByDiv',
        type:'POST',
        data:{divcode:div},
        success:function(data){
          data = JSON.parse(atob(data));
            $('#PS').html(data);   
        },
    });
});

$('#PS').change(function(){
  $('#IOCODE2').html('<option>Loading.....</option>');
    var pscode = $('#PS').val();
    $.ajax({
        url:base_url+module+'/getIoByPs',
        type:'POST',
        data:{pscode:pscode},
        success:function(data){
          data = JSON.parse(atob(data));
          var html = '';
          html += '<option value ="">Select</option>';
          for(d in data){
            var io = data[d]['IONAME'];
            var iocode = data[d]['IOCODE'];
            html += '<option value ="'+iocode+'">'+io+'</option>';
          }
            $('#IOCODE2').html(html);   
        },
    });
});

$('#phsrch').change(function(){
  var val = $(this).val();
  if(val == 'off'){
    $(this).val('on');
  }
  else{
    $(this).val('off');
  }
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  $('#caselist').hide('slow');
  var target = $(e.target).attr("href");
  if(searchval == 'nmsearch')
    ajaxcriminalsearch(target);
  else
    ajaxcriminalphsearch(target);
});

$('#search').click(function(){
  $('#caselist').hide('slow');
  $('#filterpanel').hide();
  var target = '#home1';
  ajaxcriminalsearch(target);
  
});

$('#searchbyph').click(function(){
  $('#caselist').hide('slow');
  var target = '#home1';
  ajaxcriminalphsearch(target);
  
});

$('.reset').click(function(){
  document.getElementById("searchForm").reset();
});

$(document).on('click','.crimeimg',function(){
  var prvcrmno = $(this).val().split("|")[0];
  var year = $(this).val().split("|")[1];
  var no = $(this).val().split("|")[2];

  let data = {
    "provCrmNo" : prvcrmno,
    "year" : year,
    "no" : no
  };
  var html1 = '';
  $.ajax({
      url:base_url+module+'/getCrimnalImg',
      type:'POST',
      data:data,
      success:function(data){
        data = JSON.parse(data);
        for (var i = 0; i < data.length; i++){
          html1+= `<center><img width='200' height='250' src='${data[i]}'></center>`;
        }
        $("#getCode").html(html1);
      },
  });
  $("#getCodeModal").modal('show');
});


$(document).on('click','.search',function(){

  var formData = $("form").serializeArray();
  formData = {
    "data" : formData
  };
  var query = btoa(JSON.stringify(formData)).replace(/\=/g, '~');
  window.location.href = base_url+module+"/caseSearch/"+query;
});

$('#reset1').click(function(){
  $('#search').attr('disabled',false);
  $('#criminalname').val('');
  $('.criminalTable').DataTable().clear().destroy();
  $('#caselist').hide();
  $('#filterpanel').hide();
  $('#filterattr').val('');
  $('#reset2').hide();
  $(this).hide();
});

$('#reset2').click(function(){
  $('#filterattr').val('');
  $(this).hide();
});
