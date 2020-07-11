$(document).ready(function(){

  var basepath = $("#basepath").val();

  $('.number_only').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

//form submit

$(document).on('submit','#waitermasterFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateform())
        {   

            var formDataserialize = $("#waitermasterFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
            $("#waitersavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
            $.ajax({
                    type: "POST",
                    url: basepath+'waitermaster/waitermaster_action',
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    data: formData,
                    
                    success: function (result) {
                        
                        if (result.msg_status == 1) {
                            if(mode == 'EDIT'){
                            $("#waitersavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            window.location.href=basepath+'waitermaster';
                            //showMsg();

                            }else{

                            $("#errormsg").removeClass('errormsgcolor');
                            $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                            $("#waitersavebtn").css('display', 'inline-block');
                            $("#loaderbtn").css('display', 'none');
                            $('#waiter_name').val('');                    
                            $('#address_one').val('');                    
                            $("#address_two").val('');
                            $("#address_three").val('');
                            $("#mobile_no").val('');

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

function validateform (){

    var waiter_name = $('#waiter_name').val();
    var mobile_no = $('#mobile_no').val();

    $("#errormsg").removeClass('succmsg');
    $("#errormsg").addClass('errormsgcolor');
    $('#errormsg').text();

	if(waiter_name == ''){

	  $('#errormsg').text('Enter Waiter Name');
	  $("#waiter_name").focus();
	  return false;	  

	}else if(mobile_no != '' && mobile_no.length < 10){

        $('#errormsg').text('Enter 10 Digit Mobile No.');
        $("#mobile_no").focus();
        return false;	  
  
      }

	return true;
}