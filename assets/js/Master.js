
$(document).ready(function() {


//add complaint mode
$('#addmode_save').click(function(){ 
          if($('#comp_mode').val()=='')
            swal('Please Enter a valid Complaint Mode !!') ; 

           else
           {
           		var comp_mode = $('#comp_mode').val() ; 
           	 $.ajax({
                    type: 'POST',
                    url: base_url+'Master/addmode_save',
                    data: {
                           p_mode : comp_mode
                          
                          },
                  /* beforeSend: function(){
                              $('#image').prop("hidden",false);
                          },
                    complete: function(){
                              $('#image').prop("hidden",true);
                          },*/      
                    success: function(data) {
                            console.log(data) ; 

                            if(data==1){
                            	swal("Complaint Mode Added Successfully") ; 
                            	location.reload() ; 
                            }

                            else
                            {
                            	swal("Complaint Mode :-  "+comp_mode+" Addition Failed !") ; 
                            }

                          //location.reload() ;

                          //console.log(html3) ;  
                           // showIt() ;

                                           
                         // table3.destroy(); 
                                                                   
                          
                          
                                   
                        },
                    });


           }//end of else to process the ajax
}) ; //end of $('#addmode_save').click(function()

//add complaint nature


$('#addnature_save').click(function(){ 
          if($('#comp_nature').val()=='')
            swal('Please Enter a valid Complaint Mode !!') ; 

           else
           {
              var comp_nature = $('#comp_nature').val() ; 
             $.ajax({
                    type: 'POST',
                    url: base_url+'Master/addnature_save',
                    data: {
                           p_nature : comp_nature
                          
                          },
                  /* beforeSend: function(){
                              $('#image').prop("hidden",false);
                          },
                    complete: function(){
                              $('#image').prop("hidden",true);
                          },*/      
                    success: function(data) {
                            console.log(data) ; 

                            if(data==1){
                              swal("Complaint nature added Successfully") ; 
                              location.reload() ; 
                            }

                            else
                            {
                              swal("Complaint nature :-  "+comp_nature+" Addition Failed !") ; 
                            }

                          //location.reload() ;

                          //console.log(html3) ;  
                           // showIt() ;

                                           
                         // table3.destroy(); 
                                                                   
                          
                          
                                   
                        },
                    });


           }//end of else to process the ajax
}) ; //end of $('#addnature_save').click(function()



//add complaint Source addsrc_save

$('#addsrc_save').click(function(){ 
          if($('#comp_src').val()=='')
            swal('Please Enter a valid Complaint Mode !!') ; 

           else
           {
              var comp_source = $('#comp_src').val() ; 
             $.ajax({
                    type: 'POST',
                    url: base_url+'Master/addsource_save',
                    data: {
                           p_source : comp_source
                          
                          },
                  /* beforeSend: function(){
                              $('#image').prop("hidden",false);
                          },
                    complete: function(){
                              $('#image').prop("hidden",true);
                          },*/      
                    success: function(data) {
                            console.log(data) ; 

                            if(data==1){
                              swal("Complaint Source added Successfully") ; 
                              location.reload() ; 
                            }

                            else
                            {
                              swal("Complaint Source :-  "+comp_source+" Addition Failed !") ; 
                            }

                          //location.reload() ;

                          //console.log(html3) ;  
                           // showIt() ;

                                           
                         // table3.destroy(); 
                                                                   
                          
                          
                                   
                        },
                    });


           }//end of else to process the ajax
}) ; //end of $('#addsrc_save').click(function()

//add political party save button 

$('#addpolpt_save').click(function(){ 
          if($('#comp_polpt').val()=='')
            swal('Please Enter a valid Political Party !!') ; 

           else
           {
              var comp_polpt = $('#comp_polpt').val() ; 
             $.ajax({
                    type: 'POST',
                    url: base_url+'Master/addpolpt_save',
                    data: {
                           p_polpt : comp_polpt
                          
                          },
                  /* beforeSend: function(){
                              $('#image').prop("hidden",false);
                          },
                    complete: function(){
                              $('#image').prop("hidden",true);
                          },*/      
                    success: function(data) {
                            console.log(data) ; 

                            if(data==1){
                              swal("Political Party added Successfully") ; 
                              location.reload() ; 
                            }

                            else
                            {
                              swal("Political Party :-  "+comp_polpt+" Addition Failed !") ; 
                            }

                          //location.reload() ;

                          //console.log(html3) ;  
                           // showIt() ;

                                           
                         // table3.destroy(); 
                                                                   
                          
                          
                                   
                        },
                    });


           }//end of else to process the ajax
}) ; //end of $('#addpolpt_save').click(function()

}) ; //end of document ready
