$(document).ready(function(){

    var basepath = $("#basepath").val();

    $(document).on('keyup','#designation_name',function(e){

        e.preventDefault();
        $("#designationsavebtn").attr('disabled',false);   
        $("#errormsg").text('');
        var designation_name = $.trim($(this).val());
        var validdesig_name = $.trim($('#validdesig_name').val());
        var mode = $('#mode').val();
   
      
       $.ajax({
           type: "POST",
           url:basepath+'designationmaster/checkexistance',
           data:{designation_name:designation_name},
           dataType: 'json',
           success: function(result) {
   
            if(result.msg_status == 1){
                
                if(mode == 'ADD'){
   
                  $("#errormsg").text(result.msg_data);
                  $("#designationsavebtn").attr('disabled',true);	
                }else{
                    if(designation_name != validdesig_name){
   
                       $("#errormsg").text(result.msg_data);
                      $("#designationsavebtn").attr('disabled',true);		
   
                    }
                }
                
            }
           
             
           },
           error: function(jqXHR, exception) {
               $('#btnusersaveDiv').css('display','none');
               var msg = '';
               if (jqXHR.status === 0) {
                   msg = 'Not connect.\n Verify Network.';
               } else if (jqXHR.status == 404) {
                   msg = 'Requested page not found. [404]';
               } else if (jqXHR.status == 500) {
                   msg = 'Internal Server Error [500].';
               } else if (exception === 'parsererror') {
                   msg = 'Requested JSON parse failed.';
               } else if (exception === 'timeout') {
                   msg = 'Time out error.';
               } else if (exception === 'abort') {
                   msg = 'Ajax request aborted.';
               } else {
                   msg = 'Uncaught Error.\n' + jqXHR.responseText;
               }
               // alert(msg);  
           }
       }); /*end ajax call*/
   
   
   
    });



    //form submit

    $(document).on('submit','#designationmasterFrom',function(event)
        {
            event.preventDefault();
              $("#errormsg").text('');
              var mode = $("#mode").val();
              var designation_name = $.trim($("#designation_name").val());
            if(designation_name != '')
            {   
    
                var formDataserialize = $("#designationmasterFrom").serialize();
                formDataserialize = decodeURI(formDataserialize);
               
                var formData = { formDatas: formDataserialize };
                        
                 $("#designationsavebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'inline-block');
            
                   
            $.ajax({
                    type: "POST",
                    url: basepath+'designationmaster/addedit_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    success: function (result) {
                        if (result.msg_status == 1) {
    
                            if(mode == 'EDIT'){
                             $("#designationsavebtn").css('display', 'inline-block');
                             $("#loaderbtn").css('display', 'none');
                             window.location.href=basepath+'designationmaster';
                             
    
                            }else{
    
                             $("#errormsg").removeClass('errormsgcolor');
                             $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                             $("#designationsavebtn").css('display', 'inline-block');
                             $("#loaderbtn").css('display', 'none');
                             $('#designation_name').val('');                    
                             
    
                            }
                       
                      
                        } 
                        
                       
                    }, 
                    error: function (jqXHR, exception) {
                      var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                       // alert(msg);  
                    }
                }); /*end ajax call*/
    
            
                
    
            }else{
                $("#errormsg").removeClass('succmsg');
                $("#errormsg").addClass('errormsgcolor');
                $("#errormsg").text('Error: Enter Designation Name');
                $("#designation_name").focus();

            }
    
    
            
        });



})