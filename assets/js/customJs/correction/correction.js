$(document).ready(function(){

var basepath = $("#basepath").val();
var startDate = new Date($("#acstartDate").val());
var endDate = new Date($("#acendDate").val());
 
  $('.datepicker').datepicker({
    format: 'dd/mm/yyyy',
    startDate: startDate,
    endDate: endDate
    
 });

$('.numberwithdecimal').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9\.]/g, '');

  });

 $('.onlynumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');

  });

$('#student').change(function(){

 var studentid = $(this).val().split('_');
 //alert(studentid[0]);

   $.ajax({
                type: "POST",
                url: basepath+'correction/getstudentdtl',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {studentid:studentid[0]},
                
                success: function (result) {

                    
                     if (result.msg_status == 1) {

                    	$('#name').val(result.name);
                    	$('#bill_style').val(result.bill_style);

                    	
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


});


//form submit

$(document).on('submit','#correctionFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
          
        if(validateform())
        {   

            var formDataserialize = $("#correctionFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };

           
                    
            $("#correctionsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'correction/correction_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {

                    
                     if (result.msg_status == 1) {

                    	if(mode == 'EDIT'){


                    	 $("#correctionsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
                         window.location.href=basepath+'correction';
                         //showMsg();

                    	}else{

                         Swal.fire('Transaction No : '+result.correctionNo);	

                         $("#errormsg").removeClass('errormsgcolor');
                    	 $("#errormsg").text(result.msg_data).addClass('succmsg'); 
                         $("#correctionsavebtn").css('display', 'inline-block');
                         $("#loaderbtn").css('display', 'none');
	                      $('#correction_dt').val('');
						  $('#student').val('').change();
						  $('#correction_acc_id').val('').change();
						  $('#name').val('');
						  $('#bill_style').val('');
						  $('#amount').val('');
						  $('#narration').val('');
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

// show correction list using from and to date

$('#correctionshowbtn').click(function(){

 var from_dt = $("#from_dt").val();
 var to_date = $("#to_date").val();
 var student_id = $("#student_code").val();

  if(validatecode()){

   $.ajax({
                type: "POST",
                url: basepath+'correction/getallcorrectionbydate',
                dataType: "html",
                data: {from_dt:from_dt,to_date:to_date,student_id:student_id},
                
                success: function (result) {

                    
                     $("#correctionlist").html(result);
                     $(".dataTable").DataTable();
                   
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

  }

});



})


function deletetennisopening(id) {

  var basepath = $("#basepath").val();
  
      Swal.fire({
      title: 'Are you sure?',
      // text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
  
         $.ajax({
                type: "POST",
                url: basepath+'correction/deletecorrection',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: {id:id},
                
                success: function (result) {

                    window.location.href=basepath+'correction';
                                    
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

                // Swal.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
      }
    })

}  






function validatecode(){


 var from_dt = $("#from_dt").val();
 var to_date = $("#to_date").val();
 var student_id = $("#student_code").val();

  $("#fromdaterr,#todateerr,#studenterr").text('').removeClass('perrmsg');

  if(student_id == ''){

     if(from_dt == ''){

       $("#fromdaterr").text('Enter From Date').addClass('perrmsg');
       $("#from_dt").focus();
       return false;
     }   

    else if(to_date == ''){

       $("#todateerr").text('Enter To Date').addClass('perrmsg');
       $("#to_date").focus();
       return false;
  	 } 
  } 

  
  return true;


}

function validateform(){


 var correction_dt = $("#correction_dt").val();
 var student = $("#student").val();
 var correction_acc_id = $("#correction_acc_id").val();
 var amount = $("#amount").val();
 
  $("#amounterr,#studentcoderr,#correctionerr,#correctionaccounterr").text('').removeClass('perrmsg');;

  
    if(correction_dt == ''){

       $("#correctionerr").text('Enter Correction Date').addClass('perrmsg');
       $("#correction_dt").focus();
       return false;
     }else if(inputdatecheck(correction_dt) == 0){
     
        $('#correctionerr').text('Enter Date Between Accounting Year').addClass('perrmsg');
  	 	return false;
  	 }
  

     else if(student == ''){

       $("#studentcoderr").text('Select Student Code').addClass('perrmsg');
       $("#student").focus();
       return false;
  	 } 
  	 else if(correction_acc_id == ''){

       $("#correctionaccounterr").text('Select Correction Account').addClass('perrmsg');
       $("#correction_acc_id").focus();
       return false;
  	 }
  	 else if(amount == ''){

       $("#amounterr").text('Enter Correction Amount').addClass('perrmsg');
       $("#amount").focus();
       return false;
  	 }

  
  return true;


}