$(document).ready(function(){

var basepath = $("#basepath").val();


$('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });


//form submit

$(document).on('submit','#facilityRateFrom',function(event)
    {
        event.preventDefault();
                   
          
        if(validateform())
        {   

            var formDataserialize = $("#facilityRateFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
      
            $("#facilityratebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'memeberfacilityrate/facilityrate_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                     if (result.msg_status == 1) {

                    	
                    	 $("#facilityratebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'memeberfacilityrate';
                         //showMsg();

                    	
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
        
        	

       }  // end master validation


   }); 




})

function validateform(){

	

  var is_rate = $("#is_rate").val();
  var rate = $("#rate").val();
  var is_gst = $("#is_gst").val();
  var cgst = $("#cgst").val();
  var sgst = $("#sgst").val();

  $('#errormsg').text('');
	if(is_rate == 'Y'){

		if(rate == '' || rate == 0){

		$('#errormsg').text('Please Enter Rate');
		$('#rate').focus();
		return false;
	   }
	}
	 if(is_gst == 'Y'){
       
		if(cgst == 0){

		   $('#errormsg').text('Select CGST Rate');
		   $('#cgst').focus();
		   return false;	
		}else if(sgst == 0){
			$('#errormsg').text('Select SGST Rate');
		    $('#sgst').focus();
		    return false;
		}
       
	}


 return true;

}