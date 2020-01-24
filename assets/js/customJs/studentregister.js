$(document).ready(function(){

var basepath = $("#basepath").val();

 $('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

 $('.onlynumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');

  });

$("#bill_style").change(function(){

 var value = $(this).val();

  if(value == 'M'){

    $("#billstytext").text('Monthly');
  }else{
     $("#billstytext").text('Quarterly');
  }
 
});

//form submit

$(document).on('submit','#stdentregisterForm',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          
        if(validateform())
        {   

            // var formDataserialize = $("#stdentregisterForm").serialize();
            // formDataserialize = decodeURI(formDataserialize);
           
            // var formData = { formDatas: formDataserialize };

            var formData = new FormData($(this)[0]);
                    
            $("#studregsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'studentregister/registration_action',
                dataType: "json",
                processData: false,
                contentType: false,
                data: formData,
                
                success: function (result) {

                    
                    if (result.msg_status == 1) {

                    
                    	 $("#studregsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'studentregister';
                         
                      
                  
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

function readURL(input){

  $("#isImage").val('Y');

   if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#showimage')
                    .attr('src', e.target.result)
                    .width(120)
                    .height(125);
            };

            reader.readAsDataURL(input.files[0]);
        }
 
  
}

function validateform(){
	
	var studtitle = $('#studtitle').val();
	var studname = $('#studname').val();
    var studdob = $('#studdob').val();
	var father_title = $('#father_title').val();
	var fathername = $('#fathername').val();
	var mobile_no = $('#mobile_no').val();
	var city = $('#city').val();
	var pincode = $('#pincode').val();
	var admission_dt = $('#admission_dt').val();
    var status = $('#status').val();
	var category = $('#category').val();
	var bill_style = $('#bill_style').val();
    var admission_dt = $('#admission_dt').val();
    var exit_dt = $('#exit_dt').val();


	$("#studnameerr,#fathernameerr,#mobilenoerr,#citynameerr,#pincodeerr,#admissiondterr,#statuserr,#cateerr,#billstyleerr,#doberr,#exitdterr").text('').removeClass('perrmsg');
    
	if(studtitle == ''){

     $("#studnameerr").text('Select Student Title').addClass('perrmsg');
     $("#studtitle").focus();
     return false;		

	}else if(studname == ''){

     $("#studnameerr").text('Enter Student Name').addClass('perrmsg');
      $("#studname").focus();
     return false;		

	}else if(studdob != '' && isDate(studdob) == false){

     $("#doberr").text('Enter Correct DOB').addClass('perrmsg');
      $("#studdob").focus();
     return false;      

    }else if(father_title == ''){

     $("#fathernameerr").text("Select Father's/Mother's Title").addClass('perrmsg');
      $("#father_title").focus();
     return false;		

	}
	else if(fathername == ''){

     $("#fathernameerr").text("Enter Father's/Mother's Name").addClass('perrmsg');
     $("#fathername").focus();
     return false;		

	}
	else if(mobile_no == ''){

     $("#mobilenoerr").text('Enter Mobile No.').addClass('perrmsg');
     $("#mobile_no").focus();
     return false;		

	}
	else if(city == ''){

     $("#citynameerr").text('Enter City Name').addClass('perrmsg');
      $("#city").focus();
     return false;		

	}
	else if(pincode == ''){

     $("#pincodeerr").text('Enter Pincode').addClass('perrmsg');
      $("#pincode").focus();
     return false;		

	}
	else if(admission_dt == ''){

     $("#admissiondterr").text('Enter Admission Date').addClass('perrmsg');
      $("#admission_dt").focus();
     return false;		

	}else if(admission_dt != '' && isDate(admission_dt) == false){

     $("#admissiondterr").text('Enter Correct Admission Date').addClass('perrmsg');
      $("#admission_dt").focus();
     return false;      

    }else if(category == ''){

     $("#cateerr").text('Select Category').addClass('perrmsg');
      $("#category").focus();
     return false;      

    }
    else if(status == ''){

     $("#statuserr").text('Select Status').addClass('perrmsg');
      $("#status").focus();
     return false;      

    }else if(exit_dt != '' && isDate(exit_dt) == false){

     $("#exitdterr").text('Enter Correct Exit Date').addClass('perrmsg');
      $("#exit_dt").focus();
     return false;      

    }
	
	else if(bill_style == ''){

     $("#billstyleerr").text('Select Billing Style').addClass('perrmsg');
     $("#bill_style").focus();
     return false;		

	}
	

 return true;	

  
}