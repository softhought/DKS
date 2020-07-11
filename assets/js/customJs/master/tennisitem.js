$(document).ready(function(){

	var basepath = $("#basepath").val();

$('.number_only').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });


//form submit

$(document).on('submit','#tennisitemFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');

          var mode = $("#mode").val();

        if(validateform())
        {   

            var formDataserialize = $("#tennisitemFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#tennisitemsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'tennisitem/tennisitem_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#tennisitemsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'tennisitem';
                         //showMsg();

                    	}else{

                    	   $("#errormsg").removeClass('errormsgcolor');
                         $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#tennisitemsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         $('#tennisitem').val('');                    
                         $('#hsn_no').val('');                    
                         $('#rate').val('');                    
                         

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

function validateform(){

	var tennisitem = $('#tennisitem').val();
	var hsn_no = $('#hsn_no').val();
	var rate = $('#rate').val();
	
 $("#errormsg").removeClass('succmsg');
 $("#errormsg").addClass('errormsgcolor');
  $('#errormsg').text();

	if(tennisitem == ''){

	  $('#errormsg').text('Enter Tennis Item');
	  $("#tennisitem").focus();
	  return false;
	  

	}else if(hsn_no == ''){

      $('#errormsg').text('Enter HSN No.');
      $("#hsn_no").focus();
      return false;

	}else if(rate == ''){
		$('#errormsg').text('Enter Rate');
		$("#rate").focus();
		return false;
	}
	return true;
}