$(document).ready(function(){

var basepath =$('#basepath').val();

$("#resetaccountform").click(function(){
   
   //$("#accountname").val('').change();
   $("#acccountgrpid").val('').change();
   $("#groupname").val('');

   

 });

$("#acccountgrpid").change(function(){

	var value = $(this).children("option:selected").text();
	
	$("#groupname").val(value);
})


//form submit

$(document).on('submit','#acountmasterFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(valiadteaccinfo())
        {   

            var formDataserialize = $("#acountmasterFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
            $("#accmastersavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'accountmaster/accountmaster_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#accmastersavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'accountmaster';
                         //showMsg();

                    	}else{

                    	   $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#accmastersavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         $('#groupname').val('');                    
                         $('#accountname').val('');                    
                         $('#acccountgrpid').val('').change();                    
                        

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
        
        	

        }   // end master validation


        
    });

});


function valiadteaccinfo(){

	var accountname = $('#accountname').val();
	var acccountgrpid = $('#acccountgrpid').val();
	
  $("#errormsg").removeClass('succmsg');
  $("#errormsg").addClass('errormsgcolor');
  $('#errormsg').text();

	if(accountname == ''){

	  $('#errormsg').text('Enter Account Name');
	  $("#accountname").focus();
	  return false;
	  

	}else if(acccountgrpid == ''){

      $('#errormsg').text('Select Group Name');
      $("#acccountgrpid").focus();
      return false;

	}

	return true;
}