$(document).ready(function(){

var basepath =$("#basepath").val();

$('#resetpaymentmodeform').click(function(){
  $("#dracccountid").val('').change();
	$("#cracccountid").val('').change();
});





//form submit

$(document).on('submit','#categoryFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(valiadteCategory())
        {   

            var formDataserialize = $("#categoryFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#categorysavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'tennisbillingac/category_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#categorysavebtn").css('display', 'block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'tennisbillingac';
                         //showMsg();

                    	}else{

                    	 $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#paymentmodesavebtn").css('display', 'block');
                         $("#loaderbtn").css('display', 'none');
                         $('#paymentmode').val('');                    
                         $('#acccountid').val('').change();                    
                        

                    	}
                                            
                  
                    } 
                    else {
                     
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

function valiadteCategory(){


  var dracccountid = $('#dracccountid').val();
	var cracccountid = $('#cracccountid').val();
	
 $("#errormsg").removeClass('succmsg');
 $("#errormsg").addClass('errormsgcolor');
  $('#errormsg').text();

	 if(dracccountid == ''){

      $('#errormsg').text('Select Dr Account Name');
      $("#dracccountid").focus();
      return false;

	}

 if(cracccountid == ''){

      $('#errormsg').text('Select Cr Account Name');
      $("#cracccountid").focus();
      return false;

  }

	return true;
}