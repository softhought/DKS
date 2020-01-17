$(document).ready(function(){


 var basepath = $("#basepath").val();


$('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

 $('.onlynumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');

  });



 $(".totalamt").keyup(function(){

  var qty = $("#quntity").val();
  var rate = $("#rate").val();

  var total = qty * rate;


  $("#amount").val(total.toFixed(2));


 });

 $('#resetgrpform').click(function(){
   
   $('#student_idcode').val('').change();
   

 })


 //form submit

$(document).on('submit','#hardcourtFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
          
        if(validateform())
        {   

            var formDataserialize = $("#hardcourtFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };

           
                    
            $("#hardcourtsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'hardcourt/hardcourt_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                     if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#hardcourtsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'hardcourt';
                         //showMsg();

                    	}else{

                         $("#errormsg").removeClass('errormsgcolor');
                    	 $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#hardcourtsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
	                      $('#hardcourt_date').val('');
          						  $('#student_idcode').val('').change();
          						  $('#quntity').val('');
          						  $('#rate').val('');
          						  $('#amount').val('');
                         //$("#hardcourtId").val(result.hardcourtId);
                         

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
        
        	

       }  // end master validation


   });   


})

function validateform(){

	var hardcourt_date = $('#hardcourt_date').val();
	var student_idcode = $('#student_idcode').val();
	var quntity = $('#quntity').val();
	var rate = $('#rate').val();
       $("#errormsg").removeClass('succmsg');
     $("#errormsg").addClass('errormsgcolor');
     $('#errormsg').text();

	if(hardcourt_date == ''){

	  $('#errormsg').text('Enter Transaction Date');
	  $("#hardcourt_date").focus();
	  return false;
	  

	}else if(inputdatecheck(hardcourt_date) == 0){
     
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
  }else if(student_idcode == ''){

      $('#errormsg').text('Select Student');
      $("#student_idcode").focus();
      return false;

	}else if(quntity == ''){
		$('#errormsg').text('Enter Quantity');
		$("#quntity").focus();
		return false;

	}else if(rate == ''){
		$('#errormsg').text('Enter Rate');
		$("#rate").focus();
		return false;

	}

	return true;
}