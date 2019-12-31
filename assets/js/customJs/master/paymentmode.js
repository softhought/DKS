$(document).ready(function(){

var basepath =$("#basepath").val();

$('#resetpaymentmodeform').click(function(){

	$("#acccountid").val('').change();
});


$(document).on('keyup','#paymentmode',function(e){

 	e.preventDefault();
   $("#errormsg").text('');
   $("#paymentmodesavebtn").attr('disabled',false);
  var paymentmode = $(this).val();
  var validpaymentmode = $("#validpaymentmode").val();
  var mode = $("#mode").val();
  
   
    $.ajax({
        type: "POST",
        url:basepath+'paymentmode/checkduplicatpaymentmode',
        data:{paymentmode:paymentmode},
        dataType: 'json',
        success: function(result) {

         if(result.msg_status == 1){
           
           if(mode == 'ADD'){
              $("#errormsg").text(result.msg_data);
              $("#paymentmodesavebtn").attr('disabled',true);

           }else{
             if(paymentmode.toUpperCase() != validpaymentmode){
               $("#errormsg").text(result.msg_data);
              $("#paymentmodesavebtn").attr('disabled',true);
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

$(document).on('submit','#paymentmodeFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(valiadtePaymentinfo())
        {   

            var formDataserialize = $("#paymentmodeFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#paymentmodesavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'paymentmode/paymentmode_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#paymentmodesavebtn").css('display', 'block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'paymentmode';
                         //showMsg();

                    	}else{

                    	 $("#errormsg").text(result.msg_data).css('color','#e80f89'); 
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

function valiadtePaymentinfo(){

	var paymentmode = $('#paymentmode').val();
	var acccountid = $('#acccountid').val();
	

  $('#errormsg').text();

	if(paymentmode == ''){

	  $('#errormsg').text('Enter Payment Mode');
	  $("#paymentmode").focus();
	  return false;
	  

	}else if(acccountid == ''){

      $('#errormsg').text('Select Account Name');
      $("#acccountid").focus();
      return false;

	}

	return true;
}