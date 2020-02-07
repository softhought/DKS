$(document).ready(function(){

    var basepath = $("#basepath").val();

    $(document).on('keyup','#dept_name',function(e){

        e.preventDefault();
        $("#departmentsavebtn").attr('disabled',false);   
        $("#errormsg").text('');
        var dept_name = $.trim($(this).val());
        var validdept_name = $.trim($('#validdept_name').val());
        var mode = $('#mode').val();
   
      
       $.ajax({
           type: "POST",
           url:basepath+'departmentmaster/checkexistance',
           data:{dept_name:dept_name},
           dataType: 'json',
           success: function(result) {
   
            if(result.msg_status == 1){
                
                if(mode == 'ADD'){
   
                  $("#errormsg").text(result.msg_data);
                  $("#departmentsavebtn").attr('disabled',true);	
                }else{
                    if(dept_name.toUpperCase() != validdept_name.toUpperCase()){
   
                       $("#errormsg").text(result.msg_data);
                      $("#departmentsavebtn").attr('disabled',true);		
   
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

    $(document).on('submit','#departmentmasterFrom',function(event)
        {
            event.preventDefault();
              $("#errormsg").text('');
              var mode = $("#mode").val();
              var dept_name = $("#dept_name").val();
            if(dept_name != '')
            {   
    
                var formDataserialize = $("#departmentmasterFrom").serialize();
                formDataserialize = decodeURI(formDataserialize);
               
                var formData = { formDatas: formDataserialize };
                        
                 $("#departmentsavebtn").css('display', 'none');
                $("#loaderbtn").css('display', 'inline-block');
            
                   
            $.ajax({
                    type: "POST",
                    url: basepath+'departmentmaster/addedit_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    success: function (result) {
                        if (result.msg_status == 1) {
    
                            if(mode == 'EDIT'){
                             $("#departmentsavebtn").css('display', 'inline-block');
                             $("#loaderbtn").css('display', 'none');
                             window.location.href=basepath+'departmentmaster';
                             
    
                            }else{
    
                             $("#errormsg").removeClass('errormsgcolor');
                             $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                             $("#departmentsavebtn").css('display', 'inline-block');
                             $("#loaderbtn").css('display', 'none');
                             $('#dept_name').val('');                    
                             
    
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
                $("#errormsg").text('Error: Enter Department Name');
                $("#dept_name").focus();

            }
    
    
            
        });



})