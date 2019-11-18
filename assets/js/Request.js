$(document).ready(function() {

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

}); //end of $(document).ready(function() {
