$(document).ready(function() {

    var basepath = $('#basepath').val();

$(document).on('change','#sel_member_code',function(){
   
  var selectedCode = $('#sel_member_code').find('option:selected');
  $("#member_name").val(selectedCode.data('name'));
  console.log(selectedCode);
  

});

$(document).on('change','#actobedebited',function(){
   
  var selectedMode = $(this).find('option:selected').text();
		  if (selectedMode=='CHEQUE IN HAND') {
		  	$('#cheque_bank_dtl').show();
		  }else{
		  	$('#cheque_bank_dtl').hide();
		  }

});


$(document).on('input keyup','#receipt_dt',function(){

  var receipt_dt= $(this).val();
   
  console.log("receipt date :"+receipt_dt);
  
  $('#error_msg').text('');
  if (isDate(receipt_dt)) {
     console.log("receipt date is valid:");
    
     if(inputdatecheck(receipt_dt) == 0){   
        $('#error_msg').text('Enter Date Between Accounting Year');
      return false;
     }

  }else{
       $('#error_msg').text('Payment date is not valid');
  }

 // isDate(txtDate)


});


 $(document).on('click','#create_code',function(e){
		e.preventDefault();
   
         
		if(validateCreateCode())
		{
			 var member_category = $("#sel_member_category").val();
			 var first_name = $("#first_name").val();
			 var last_name = $("#last_name").val();
          
         
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberreceipt/generateCode';
         	//$("#create_code").attr('disabled', true);
            $.ajax({
                type: type,
                url: urlpath,
                data: {firstname:first_name,lastname:last_name,member_category:member_category},
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
				
				
					 resetMemberCodeDropdown(result.member_id);
					 $("#new_member_code").val(result.new_code);
					
                     //  $("#create_code").attr('disabled',false);
                      
					
                  
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });

		}

    });



 /* save member receipt data */

    $(document).on('submit','#memberreceiptForm',function(e){
		e.preventDefault();

      $("#error_msg").html('');
		if(validateMemberReceipt())
		{
       
          
            var formDataserialize = $("#memberreceiptForm").serialize();
            formDataserialize = decodeURI(formDataserialize);
            console.log(formDataserialize);

            var formData = { formDatas: formDataserialize };
            var type = "POST"; //for creating new resource
            var urlpath = basepath + 'memberreceipt/saveMemberReceiptData';
            $("#tennispaymentsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-table');

            $.ajax({
                type: type,
                url: urlpath,
                data: formData,
                dataType: 'json',
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                success: function(result) {
					if (result.msg_status == 1) {
						resetStudentCodeDropdown(result.student_code);
						  $('#tennisPaymentForm').trigger("reset");
              
						   $("#tennispaymentaftersavemodel").modal({
                            "backdrop": "static",
                            "keyboard": true,
                            "show": true
                        });
             
                        $('#codegeneration_modal').modal('hide');

                    } 
					else {
                      //  $("#album_response_msg").text(result.msg_data);
                    }
					
                  //  $("#loaderbtn").css('display', 'none');
					
                   
                },
                error: function(jqXHR, exception) {
                    var msg = '';
                }
            });
            
            
          
			
		}

    });


   


 }); // end of document ready


function numericFilter(txb) {
   txb.value = txb.value.replace(/[^\0-9]/ig, "");
}

function validateCreateCode(){

	 var sel_member_category = $("#sel_member_category").val();
	 var first_name = $("#first_name").val();
	 var last_name = $("#last_name").val();
	 $("#sel_member_categoryerr,#first_name,#last_name").removeClass("form_error");


	 console.log(first_name);


	 if (sel_member_category=='') {
	 	 $("#sel_member_categoryerr").addClass("form_error");
        
        return false;
	 }

	 if (first_name=='') {
	 	 $("#first_name").addClass("form_error");
        
        return false;
	 }

	 if (last_name=='') {
	 	 $("#last_name").addClass("form_error");
        
        return false;
	 }


	 return true;


}


function resetMemberCodeDropdown(memberid){

	  var basepath = $("#basepath").val();

	  $.ajax({
            type: "POST",
            url: basepath+'memberreceipt/resetMemberCodeList',
            dataType: "html",
            data: {memberid:memberid},
            success: function (result) {
         

              
             $("#resetmemberlist").html(result);

            // $('.select2').select2();
              var selectedCode = $('#sel_member_code').find('option:selected');
                console.log(selectedCode);
                $("#member_name").val(selectedCode.data('name'));
  					console.log(selectedCode);
         
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


function validateMemberReceipt(){

	 var receipt_dt = $("#receipt_dt").val();
	 var tran_type = $("#tran_type").val();
	 var sel_member_code = $("#sel_member_code").val();
	 var adm_fees = $("#adm_fees").val();
	 var total = $("#total").val();
	 var amount = $("#amount").val();
	 var actobedebited = $("#actobedebited").val();
	 var actobecredited = $("#actobecredited").val();
	 
	 $("#first_name").removeClass("form_error");
	 $('#error_msg').text('');


	  if (receipt_dt=='') {
	 	 $("#receipt_dt").addClass("form_error");
         $("#receipt_dt").focus();
         return false;
	 }

     if(inputdatecheck(receipt_dt) == 0){   
        $('#error_msg').text('Enter Date Between Accounting Year');
        return false;
     }


	 if (tran_type=='') {
	 	 $("#tran_typeerr").addClass("form_error");   
         return false;
	 }

	 if (sel_member_code=='') {
	 	 $("#sel_member_codeerr").addClass("form_error");   
         return false;
	 }

	 if (adm_fees=='') {
	 	 $("#adm_fees").addClass("form_error");  
	 	 $("#adm_fees").focus(); 
         return false;
	 }

	 if (total=='') {
	 	 $("#total").addClass("form_error");  
	 	 $("#total").focus(); 
         return false;
	 }


	 if (amount=='') {
	 	 $("#amount").addClass("form_error");  
	 	 $("#amount").focus(); 
         return false;
	 }

	 if (actobedebited=='') {
	 	 $("#actobedebitederr").addClass("form_error");  
	 	
         return false;
	 }


	  if (actobecredited=='') {
	 	 $("#actobecreditederr").addClass("form_error");  
	 	
         return false;
	 }






	 return true;
}
