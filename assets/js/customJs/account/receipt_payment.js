$(document).ready(function() {

  var basepath = $('#basepath').val();
  var startDate = new Date($("#acstartDate").val());
  var endDate = new Date($("#acendDate").val());
    // $('.timeEntry').timeEntry({ampmPrefix: ' '});

    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        startDate: startDate,
        endDate: endDate

    });

$(document).on('input keyup','#voucher_dt',function(){

  var voucher_dt= $(this).val();
   
  console.log("voucher date :"+voucher_dt);
  
  $('#errormsg').text('');
  if (isDate(voucher_dt)) {
     console.log("payment date is valid:");
    
     if(inputdatecheck(voucher_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }

  }else{
       $('#errormsg').text('Payment date is not valid');
  }

 // isDate(txtDate)


});


$(document).on('keyup input','.listamounted',function(){

     resetDrCrAmount();
});

 $(document).on('change','#entry_mode',function(){

    var entry_mode= $("#entry_mode").val();

    	if(entry_mode=='PAY') {

    		$("#dr_br_text").text('Debited');

    	}else if(entry_mode=='REC'){
    		$("#dr_br_text").text('Credited');

    	}else{
    		$("#dr_br_text").text('Debited');
    	}
  
 		$("#detail_itemamt table tbody").html('');


});


   var mode= $("#mode").val();

   if (mode=='EDIT') {
     $('#entry_mode').attr("disabled", true); 
   }







 $(document).on('click','.addAmount',function(e){
           e.preventDefault();

          var rowno= $("#rowno").val(); 
          var account_id=$("#account_id").val();
          var account_name = $("#account_id option:selected").text();
          var amount= $("#amount").val();
        

        console.log(basepath);
        if(validateDetails()) {

        rowno++;
        $.ajax({
            type: "POST",
            url: basepath+'receiptpayment/addAmountDetail',
            dataType: "html",
            data: {
            		rowNo:rowno,
            		account_id:account_id,
            		account_name:account_name,
            		amount:amount,
            
	            },
            success: function (result) {
                $("#rowno").val(rowno);
                $("#detail_itemamt table").show(); 
                $("#detail_itemamt table tbody").append(result);   
               

                $('#amount').val('');
                $('#account_id').val('').change();
           
                resetDrCrAmount();
                resetSerial();
           
         
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

        }else{
            $("#selmens_medicine").focus();
            $("#selmens_medicineerr").addClass("bordererror");
           
        }
  
    }); // End Visiting Details



    //edit member children details2
    $(document).on('click', '.editchilddetails', function(e) {


 				 e.preventDefault();			
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
        var editcheck = $("#editbtncheck_" + rowDtlNo[1]).val();

        $(".showdata_" + rowDtlNo[1]).hide();
        $(".showdata2_" + rowDtlNo[1]).hide();
        $(".dispblock_" + rowDtlNo[1]).css('display', 'block');
        $('.select2').select2();
    });



        $(document).on('click','.delDetails',function(){
        
        var currRowID = $(this).attr('id');
        var rowDtlNo = currRowID.split('_');
       // console.log(rowDtlNo[1]);
        console.log(currRowID);

        //$("tr#rowDocument_"+rowDtlNo[1]+"_"+rowDtlNo[2]).remove();
        $("tr#rowItemdetails_"+rowDtlNo[1]).remove();
       resetDrCrAmount();
       resetSerial();
    });


$(document).on('submit','#receiptPaymentFrom',function(event)
    {
        event.preventDefault();
          $("#errormsg").text('');
          var mode = $("#mode").val();
        if(validateMasterData())
        {     $('#entry_mode').attr("disabled", false); 

            var formDataserialize = $("#receiptPaymentFrom").serialize();
            formDataserialize = decodeURI(formDataserialize);
           
            var formData = { formDatas: formDataserialize };
                    
             $("#patrecsavebtn").css('display', 'none');
            $("#loaderbtn").css('display', 'inline-block');
        
               
        $.ajax({
                type: "POST",
                url: basepath+'receiptpayment/receipt_payment_action',
                dataType: "json",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                data: formData,
                
                success: function (result) {
                    $("#loaderbtn").css('display', 'none');

                    if (result.msg_status == 1) {

                   // window.location.replace(basepath+'receiptpayment');
                        if (mode=='ADD') {
                           $("#voucher_no").val(result.voucher_no);
                           $("#response_msg").text(result.msg_data);
                           $("#voucher_no").focus();
                        }else{
                           window.location.replace(basepath+'receiptpayment');
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


    $(document).on('click', "#receiptpaymentshowbtn", function(e) {
        e.preventDefault();


        var from_dt = $("#from_dt").val();
        var to_date = $("#to_date").val();
     

        if (1) {
            $('#recpay_list_data').html('');
            $("#loader").show();

            $.ajax({
                type: "POST",
                url: basepath + 'receiptpayment/getReceiptPaymentByDate',
                dataType: "html",
                data: { from_dt: from_dt, to_date: to_date},

                success: function(result) {
                    $("#loader").hide();
                    $("#recpay_list_data").html(result);
                    $('.dataTable').DataTable();
                   
                },
                error: function(jqXHR, exception) {
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









});  // end of document ready


function validateDetails(){

     var account_id=$("#account_id").val();
     var amount= $("#amount").val();
        

   	 $("#account_iderr,#amount").removeClass("form_error");
	 $('#error_msg').text('');

	 if (account_id=='') {
	 	 $("#account_iderr").addClass("form_error");
         $("#account_iderr").focus();
         return false;
	 }

	 if (amount=='') {
	 	 $("#amount").addClass("form_error");
         $("#amount").focus();
         return false;
	 }



	return true;
}


function validateMasterData(){

     var voucher_dt=$("#voucher_dt").val();
     var entry_mode= $("#entry_mode").val();
     var cash_bank_ac= $("#cash_bank_ac").val();
        

   	 $("#voucher_dt,#entry_modeerr").removeClass("form_error");
	 $('#error_msg').text('');
	 $('#errormsg').text('');

	 if (voucher_dt=='') {
	 	 $("#voucher_dt").addClass("form_error");
       
         return false;
	 }

    if(inputdatecheck(voucher_dt) == 0){   
        $('#errormsg').text('Enter Date Between Accounting Year');
      return false;
     }


	 if (entry_mode=='') {
	 	 $("#entry_modeerr").addClass("form_error");
       
         return false;
	 }

	 if (cash_bank_ac=='') {
	 	 $("#cash_bank_acerr").addClass("form_error");
         return false;
	 }

	     var accountlist=0;

   $(".listamount").each(function(){
   
        accountlist = accountlist + 1;
    });


     if(accountlist==0){

       $('#errormsg').text('Add account head list');


   }








	return true;
}





 function resetDrCrAmount(){

	var total_amt=0;

	$(".listamounted").each(function(){
		total_amt+=parseFloat($(this).val());
    });

	$("#total_dr").val(total_amt);
	$("#total_cr").val(total_amt);
}

function numericFilter(txb) {
    txb.value = txb.value.replace(/[^\0-9]/ig, "");
}



function resetSerial(){
    var n=1;

  $(".listamount").each(function(){
      var currRowID = $(this).attr('id');
      var rowDtlNo = currRowID.split('_');
        console.log("-> "+n); 
      $("#serial_"+rowDtlNo[1]).text(n++);
    
   });

}
